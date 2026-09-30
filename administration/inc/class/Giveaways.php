<?php
class Giveaways
{
    private $id;
    private $title;
    private $timestamp;
    private $author;
    private $winner;
    private $nb_winners;
    private $error = null;

    public function __construct(bool $creation = true, int $identifiant = null)
    {
        if($creation === false) {
          if(!is_numeric($identifiant)) {
            $this->error = 'Identifiant incorrecte';
          } else {
            $sql = db->connect()->prepare('SELECT id FROM giveaways WHERE id = ?');
            $sql->execute([$identifiant]);
            if($sql->rowCount() > 0) {
              $this->id = $identifiant;
              $this->getInfo();
            } else {
              $this->error = 'Giveaways introuvable';
            }
          }
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function getTimestamp(): int
    {
      return $this->timestamp;
    }

    public function getAuthor()
    {
      return $this->author;
    }

    public function getWinner()
    {
      return $this->winner;
    }

    public function getNbWinners() {
        return $this->nb_winners;
    }

    public function getError()
    {
      return $this->error;
    }

    public function setTitle(string $title)
    {
      return $this->title = $title;
    }

    public function setTimestamp(int $timestamp)
    {
      return $this->timestamp = $timestamp;
    }

    public function setAuthor(int $author)
    {
      return $this->author = $author;
    }

    public function setWinner(int $winner)
    {
      return $this->winner = $winner;
    }

    public function setNbWinners(int $nb_winners) {
        return $this->nb_winners = $nb_winners;
    }

    public function createGiveaways()
    {
      $sql = db->connect()->prepare('INSERT INTO giveaways(title,timestamp,author,nb_winners) VALUES(?,?,?,?)');
      $sql->execute([$this->getTitle(), $this->getTimestamp(), $this->getAuthor(), $this->getNbWinners()]);
    }

    public function updateGiveaways()
    {
      $sql = db->connect()->prepare('UPDATE giveaways SET title = ?, nb_winners = ? WHERE id = ?');
      $sql->execute([$this->getTitle(), $this->getNbWinners(), $this->getId()]);
    }

    public function deleteGiveaways()
    {
        $sql = db->connect()->prepare('DELETE FROM giveaways WHERE id = ?');
        $sql->execute([$this->getId()]);
    }

    private function getInfo()
    {
        $sql = db->connect()->prepare('SELECT * FROM giveaways WHERE id = ?');
        $sql->execute([$this->getId()]);
        if ($sql->rowCount() > 0) {
            $giveaways = $sql->fetch();
            foreach ($giveaways as $column => $value) {
                $this->{$column} = $value;
            }
        } else {
            $this->error = 'Giveaways introuvable';
        }
    }
}