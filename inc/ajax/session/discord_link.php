<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

if (isset($bdd)) {
    if (!empty($_SESSION['username'])) {
        $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
        $user->execute([$_SESSION['username']]);
        $jr = $user->fetch(PDO::FETCH_OBJ);
        if (!empty($_GET['code'])) {
          $code = $_GET['code'];
          $curl = curl_init('http://185.142.53.116:3000/discord?code='.$code);
          curl_setopt_array($curl, [
              CURLOPT_USERAGENT => 'CityWish (+https://citywish.fr)',
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_FOLLOWLOCATION => true
          ]);
          $data = curl_exec($curl);
          if ($data === false ||curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
              $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur - Échec de l\'envoie', 'reason' => 'Nous n\'avons pas réussi à récolter les informations de ton compte Discord. Réessaye ou contacte Cold#0393 sur Discord.'];
              echo json_encode($response);
              curl_close($curl);
              exit();
          }
          $json = json_decode($data);
          if (!$json) {
              $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur - Échec de l\'envoie', 'reason' => 'Nous n\'avons pas réussi à récolter les informations de ton compte Discord. Réessaye ou contacte Cold#0393 sur Discord.'];
              echo json_encode($response);
              curl_close($curl);
              exit();
          }
          curl_close($curl);

          if($json->error === true) {
              $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => $json->reason];
              echo json_encode($response);
              exit();
          }

          $sql_tokens = $bdd->prepare('UPDATE members SET id_discord = :id, discord_tokens = :tokens WHERE id = :user');
          $sql_tokens->execute(['id' => $json->user->id, 'tokens' => $json->tokens, 'user' => $jr->id]);

          $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ton compte Discord est désormais lié à ton compte CityWish.'];
          echo json_encode($response);
          exit();
        }
    } else {
      $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les informations de ton compte sont éronées. <a href="#register" onclick="changeOverlay(\'connect\')">Reconnecte-toi</a> ou réessaye.'];
      echo json_encode($response);
      exit();
  }
}
