<?php

class Redaction {

  private $pdo;
  private $data;
  private $error = true;
  private $message = 'Nous avons rencontré une erreur lors de l\'envoie de vos données.';
  private $missing = [];
  private $title;
  private $descp;
  private $content;
  private $category;
  private $banner;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  private function prepareData()
  {
    $data = $this->data;

    foreach($data as $key => $value) {
      if(empty($value)) {
        $this->message = 'Tous les champs n\'ont pas été complété.';
        $this->missing[] = $key;
      } else {
        $this->$key = db->htmlEntities($value);
      }
    }
  }

  private function checkBanner()
  {
    if(!str_starts_with($this->banner, 'https://citywish.fr/uploads/') OR !str_ends_with($this->banner, '.png')) {
      $this->message = 'La bannière n\'est pas dans un format correct.';
      $this->missing[] = 'banner';
    }
  }

  private function checkTitle()
  {
    if(strlen($this->title) > 150) {
      $this->message = 'Le titre est trop long.';
      $this->missing[] = 'title';
    }
  }

  private function checkDescp()
  {
    if(strlen($this->descp) > 150) {
      $this->message = 'La description est trop longue.';
      $this->missing[] = 'descp';
    }
  }

  private function checkContent()
  {
    if(empty($this->content)) {
      $this->message = 'Le contenu n\'a pas été complété.';
      $this->missing[] = 'content';
    }
  }

  private function checkCategory() 
  {
    if(strtoupper($this->category) !== 'CITYWISH' && strtoupper($this->category) !== 'HABBOCITY' && strtoupper($this->category) !== 'CULTURE' && strtoupper($this->category) !== 'DIVERS') {
      $this->message = 'La catégorie n\'est pas correcte.';
      $this->missing[] = 'category';
    }
  }

  private function checkData(bool $edit = false, bool $correct = false)
  {
    $this->checkDescp();
    $this->checkContent();
    $this->checkTitle();
    if(!$correct) {
      $this->checkBanner();
      $this->checkCategory();
    }
  }

  public function sendData(string $method, UserInfo $user, bool $edit = false, bool $correct = false, array $article = []) {
    $this->prepareData();
    if(count($this->missing) === 0) {
      $this->checkData($edit, $correct);
      if(count($this->missing) === 0) {
        $method = $method;
        $this->$method($user, $article);
      }
    }
  }

  private function sendToCorrect(UserInfo $user)
  {
    $date = date('d-m-Y');
    $sql = db->connect()->prepare('INSERT INTO articles(title, descp, body, author, dates, category, background) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $sql->execute([$this->title, $this->descp, $this->content, $user->getId(), $date, $this->category, $this->banner]);

    return $this->error = false;
  }

  private function sendCorrectToValid(UserInfo $user, array $article) {
    $date = date('d-m-Y');
    $sql_correct = db->connect()->prepare('INSERT INTO articles_correct(title, descp, body, author, dates, id_article) VALUES (?, ?, ?, ?, ?, ?)');
    $sql_correct->execute([$this->title, $this->descp, $this->content, $user->getId(), $date, $article['id']]);

    return $this->error = false;
  }

  private function validCorrection(UserInfo $user, array $article) {
    $user = new UserInfo($article['author']);
    $date = $article['dates'];
    $sql_valid = db->connect()->prepare('UPDATE articles SET title = ?, descp = ?, body = ?, corrector = ?, dates_correction = ?, category = ?, background = ?, corrected = ? WHERE id = ?');
    $sql_valid->execute([$this->title, $this->descp, $this->content, $user->getId(), $date, $this->category, $this->banner, 1, $article['id']]);

    $delete = db->connect()->prepare('DELETE FROM articles_correct WHERE id = ?');
    $delete->execute([$article['id']]);

    return $this->error = false;
  }

  private function validArticle(UserInfo $user, array $article) {
    $date = date('d-m-Y');
    $sql_valid = db->connect()->prepare('UPDATE articles SET title = ?, descp = ?, body = ?, dates = ?, category = ?, background = ?, valid = ? WHERE id = ?');
    $sql_valid->execute([$this->title, $this->descp, $this->content, $date, $this->category, $this->banner, 1, $article['id']]);

    return $this->error = false;
  }

  private function sendToEdit(UserInfo $user, array $article) {
    $date = date('d-m-Y');
    $sql_correct = db->connect()->prepare('INSERT INTO articles_edit(title, descp, body, author, dates, category, background, id_article) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $sql_correct->execute([$this->title, $this->descp, $this->content, $user->getId(), $date, $this->category, $this->banner, $article['id']]);

    return $this->error = false;
  }

  private function validEdit(UserInfo $user, array $article) {
    $user = new UserInfo($article['author']);
    $date = $article['dates'];
    $sql_valid = db->connect()->prepare('UPDATE articles SET title = ?, descp = ?, body = ?, dates_editing = ?, category = ?, background = ? WHERE id = ?');
    $sql_valid->execute([$this->title, $this->descp, $this->content, $date, $this->category, $this->banner, $article['id_article']]);

    $delete = db->connect()->prepare('DELETE FROM articles_edit WHERE id = ?');
    $delete->execute([$article['id']]);

    return $this->error = false;
  }

  private function sendToDraft(UserInfo $user)
  {
    $date = date('d-m-Y');
    $sql = db->connect()->prepare('INSERT INTO articles(title, descp, body, author, dates, category, background, draft) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $sql->execute([$this->title, $this->descp, $this->content, $user->getId(), $date, $this->category, $this->banner, 1]);

    return $this->error = false;
  }

  private function editDraft(UserInfo $user, array $article)
  {
    $sql = db->connect()->prepare('UPDATE articles SET title = ?, descp = ?, body = ?, category = ?, background = ? WHERE id = ?');
    $sql->execute([$this->title, $this->descp, $this->content, $this->category, $this->banner, $article['id']]);

    return $this->error = false;
  }

  private function validDraft(UserInfo $user, array $article)
  {
    $sql = db->connect()->prepare('UPDATE articles SET title = ?, descp = ?, body = ?, category = ?, background = ?, draft = ? WHERE id = ?');
    $sql->execute([$this->title, $this->descp, $this->content, $this->category, $this->banner, 0, $article['id']]);

    return $this->error = false;
  }

  public function getArticle(int $id, string $table = null) {
    if($table !== null) {
      $table = 'articles_'.$table;
    } else {
      $table = 'articles';
    }
    $sql = db->connect()->prepare('SELECT * FROM '.$table.' WHERE id = ?');
    $sql->execute([$id]);
    $array = $sql->fetch();
    return $array;
  }

  public function getError() 
  {
    return $this->error;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function getMissing()
  {
    return $this->missing;
  }
}