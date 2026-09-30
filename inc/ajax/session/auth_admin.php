<?php
ini_set('session.cookie_domain', '.citywish.fr');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

if (isset($bdd)) {
    if(!empty($_SESSION['username'])) {
      $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
      $user->execute([$_SESSION['username']]);
      $jr = $user->fetch(PDO::FETCH_OBJ);
        if (!empty($_POST['code'])) {
          $code = str_replace(' ', '', $_POST['code']);
            $sql = $bdd->prepare('SELECT code FROM auth2factor WHERE id_user = :user');
            $sql->execute(['user' => $jr->id]);
            if ($sql->rowCount() > 0) {
              if($sql->fetch(PDO::FETCH_OBJ)->code === $code) {
                $delete_code = $bdd->prepare('DELETE FROM auth2factor WHERE id_user = :user AND code = :code');
                $delete_code->execute(['user' => $jr->id, 'code' => $code]);
                $_SESSION['admin'] = true;
                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès - Code valide', 'reason' => 'Le code entré est valide. Tu seras redirigé dans quelques instants.'];
                echo json_encode($response);
                exit();
              } else {
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur - Code incorrect', 'reason' => 'Le code entré est invalide. Réessaye ou appuie sur le bouton "M\'envoyer un code" pour recevoir un nouveau code.'];
                echo json_encode($response);
                exit();
              }
            } else {
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les informations de ton compte sont éronées. <a href="#register" onclick="changeOverlay(\'connect\')">Reconnecte-toi</a> ou réessaye.'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois entrer le code d\'accès temporaire que tu as reçu via message privé Discord.'];
            echo json_encode($response);
            exit();
        }
    } else {
      $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les informations de ton compte sont éronées. <a href="#register" onclick="changeOverlay(\'connect\')">Reconnecte-toi</a> ou réessaye.'];
      echo json_encode($response);
      exit();
  }
}
