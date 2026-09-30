<?php
ini_set('session.cookie_domain', '.citywish.fr');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

function happyCertif($length = 10, $prefix, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
{
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }
  return (!is_null($prefix) ? mb_strtoupper($prefix) . '-' : '') . $code;
}

if (isset($bdd)) {
    if(!empty($_SESSION['username'])) {
        $user = $bdd->prepare('SELECT id,id_discord FROM members WHERE name = ?');
        $user->execute([$_SESSION['username']]);
        $jr = $user->fetch(PDO::FETCH_OBJ);

        if($jr->id_discord === 'none') {
          $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton compte n\'est lié à aucun compte Discord. Lies-en un via tes <a href="#settings-oy" onclick="changeOverlay(\'settings-oy\')">Paramètres</a>.'];
          echo json_encode($response);
          exit();
        }

        $code_check = $bdd->prepare('SELECT code FROM auth2factor WHERE id_user = ?');
        $code_check->execute([$jr->id]);
        if($code_check->rowCount() > 0) {
            $code_delete = $bdd->prepare('DELETE FROM auth2factor WHERE id_user = ?');
            $code_delete->execute([$jr->id]);
        }
        
        $token = happyCertif(20, null);
        $code = happyCertif(6, null, '0123456789');
        $code_add = $bdd->prepare('INSERT INTO auth2factor(token,code,id_user) VALUES(?,?,?)');
        $code_add->execute([$token,$code,$jr->id]);

        $curl = curl_init('http://185.142.53.116:3000/a2f?token='.$token.'&userid='.$jr->id);
        curl_setopt_array($curl, [
            CURLOPT_USERAGENT => 'CityWish (+https://citywish.fr)',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true
        ]);
        $data = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur - Échec de l\'envoie', 'reason' => 'Nous n\'avons pas réussi à t\'envoyer le code via message privé sur Discord. Réessaye ou contacte Cold#0393 sur Discord.'];
            echo json_encode($response);
            curl_close($curl);
            exit();
        }

        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Le code t\'a été envoyé via message privé sur Discord.'];
        echo json_encode($response);
        curl_close($curl);
        exit();
    } else {
      $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les informations de ton compte sont éronées. <a href="#register" onclick="changeOverlay(\'connect\')">Reconnecte-toi</a> ou réessaye.'];
      echo json_encode($response);
      exit();
  }
}
