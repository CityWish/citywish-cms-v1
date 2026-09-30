<?php
require_once '../../system.php';
require_once '../../class/Giveaways.php';

function response($status = 'error', $msg = 'Il y a eu un problème lors de l\'envoie. Réessaye.') {
    $title = $status === 'success' ? 'Succès' : 'Erreur';
    echo json_encode(['type' => $status, 'title' => $title, 'reason' => $msg]);
    exit;
}

$id = $_POST['id'];

if(!isset($id)) {
    response('error', 'Un des champs n\'est pas complété.');
}

if(!is_numeric($id)) {
    response('error', 'L\'identifiant est invalide.');
}

$giveaways = new Giveaways(false, $id);
if($giveaways->getError() !== null) {
    response('error', $giveaways->getError());
}

if($giveaways->getTimestamp() < time()) {
    response('error', 'Le giveaways sélectionné est déjà terminé.');
}

$giveaways->deleteGiveaways();

response('success', 'Le giveaways a bien été supprimé.');