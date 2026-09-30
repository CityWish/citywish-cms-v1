<?php 
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once('../../../bdd.php');

if(isset($_SESSION['username'])){
  $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
  $user->execute([$_SESSION['username']]);
  if($user->rowCount() !== 0) {
    $pseudo = $_SESSION['username'];
    $jr = $user->fetch(PDO::FETCH_OBJ);
      $date =  date('d-m-Y');
      $limit_looks = $bdd->prepare('SELECT id FROM looks WHERE id_user = ?');
      $limit_looks->execute([$jr->id]);
      if($limit_looks->rowCount() < 999) {
        /// API CHECK if($api){} else {}
        $add_look = $bdd->prepare('INSERT INTO looks(id_user,pseudo,date) VALUES(?,?,?)');
        $add_look->execute([$jr->id, $pseudo, $date]);

        $select_look = $bdd->prepare('SELECT id FROM looks WHERE id_user = ? AND pseudo = ? AND date = ? ORDER BY id DESC LIMIT 1');
        $select_look->execute([$jr->id, $pseudo, $date]);
        $id_look = $select_look->fetch(PDO::FETCH_OBJ)->id;

        $front_look = 'https://avatar.citywish.fr/?username='.$pseudo.'&direction=2&head_direction=2&gesture=std';
        $back_look = 'https://avatar.citywish.fr/?username='.$pseudo.'&direction=7&head_direction=7&gesture=std'; 
        $name = $id_look.'_'.$pseudo;

        $looks = $bdd->prepare('SELECT id,pseudo FROM looks WHERE id_user = ?');
        $looks->execute([$jr->id]);
        $compare = $looks->fetchAll(PDO::FETCH_OBJ);
        foreach($compare as $look) {
          if(md5_file('../../../../tools/looks/'.$look->id.'_'.$look->pseudo.'_front.png') === md5_file($front_look) && md5_file('../../../../tools/looks/'.$look->id.'_'.$look->pseudo.'_back.png') === md5_file($back_look)) {
            $delete_look = $bdd->prepare('DELETE FROM looks WHERE id = ?');
            $delete_look->execute([$id_look]);
            echo json_encode(['type' => 'success', 'reason' => 'Un look identique a déjà été enregistré.']);
            exit();
          }
        }

        file_put_contents('../../../../tools/looks/'.$name.'_front.png', file_get_contents($front_look));
        file_put_contents('../../../../tools/looks/'.$name.'_back.png', file_get_contents($back_look));
          
        if(file_exists('../../../../tools/looks/'.$name.'_front.png') && file_exists('../../../../tools/looks/'.$name.'_back.png')){
          echo json_encode(['type' => 'success', 'reason' => 'Ton look a bien été sauvegardé.']);
          exit();
        } else {
          echo json_encode(['type' => 'error', 'reason' => 'Nous avons rencontré un problème lors du téléchargement de ton look. Réessaye.']);
          exit();
        }
      } else {
        echo json_encode(['type' => 'error', 'reason' => 'Tu as déjà atteint la limite maximale de look qui est de 3 looks par compte. Supprime-en un et réessaye.']);
        exit();
      }
  } else {
    echo json_encode(['type' => 'error', 'reason' => 'Nous avons rencontré un problème avec ton compte. Réessaye.']);
    exit();
  }
} else {
  echo json_encode(['type' => 'error', 'reason' => 'Il faut être connecté pour pouvoir sauvegarder un look.']);
  exit();
}