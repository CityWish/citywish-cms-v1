<?php
require_once '../../system.php';
require_once '../../class/Redaction.php';

$response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous avons rencontré un problème lors de l\'envoie des données.'];

$write = new Redaction($_POST, $bdd);

$method = null;
if($_GET['type'] === 'final'){
  $method = 'sendCorrectToValid';
} elseif($_GET['type'] === 'draft'){
  $method = 'sendToDraft';
}

if($method !== null) {
  $write->sendData($method, $user, false, true, $write->getArticle($_GET['id']));
  if($write->getError()) {
    if(count($write->getMissing()) > 0) {
      $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => $write->getMessage(), 'missing' => $write->getMissing()];
    }
  } else {
    $response = ['type' => 'success', 'title' => 'Succès', 'reason' => 'Votre correction a bien été envoyé en validation.'];
  }
}


echo json_encode($response);
exit();