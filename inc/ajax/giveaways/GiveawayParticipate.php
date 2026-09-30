<?php
require_once '../../bdd.php';
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

function response($status = 'error', $msg = 'Il y a eu un problème lors de la participation. Réessaye.', $participate = true) {
  $title = $status === 'success' ? 'Succès' : 'Erreur';
  echo json_encode(['type' => $status, 'title' => $title, 'reason' => $msg, 'participate' => $participate]);
  exit;
}

$id = $_POST['id'];

if(!is_numeric($id) or !isset($id)) {
  response('error', 'L\'identifiant du tirage au sort est invalide. Réessaye.');
}

if(!isset($_SESSION['username'])) {
  response('error', 'Tu dois être connecté pour pouvoir participer à un tirage au sort.');
}

$sql = $bdd->prepare('SELECT timestamp,nb_winners FROM giveaways WHERE id = ?');
$sql->execute([$id]);
if($sql->rowCount() === 0) {
  response('error', 'Le tirage au sort auquel tu essayes de participer n\'existe pas.');
}

$giveaway = $sql->fetch();
if(time() >= $giveaway['timestamp']) {
  response('error', 'Le tirage au sort auquel tu essayes de participer est déjà terminé.');
}

$sql = $bdd->prepare('SELECT id FROM members WHERE name = ?');
$sql->execute([$_SESSION['username']]);
$user = $sql->fetch();

$sql = $bdd->prepare('SELECT id FROM giveaways_participants WHERE id_giveaway = ? AND id_user = ?');
$sql->execute([$id, $user['id']]);
$message = 'Ta participation a bien été comptabilisé.';
$participate = true;
if($sql->rowCount() > 0) {
  $participant = $sql->fetch();
  $sql = $bdd->prepare('DELETE FROM giveaways_participants WHERE id = ?');
  $sql->execute([$participant['id']]);
  $message = 'Ta participation a bien été retiré.';
  $participate = false;
} else {
  $sql = $bdd->prepare('INSERT INTO giveaways_participants(id_user,id_giveaway) VALUES(?,?)');
  $sql->execute([$user['id'], $id]);
}

$sql = $bdd->prepare('SELECT COUNT(id) AS participants FROM giveaways_participants WHERE id_giveaway = ?');
$sql->execute([$id]);
$participants = $sql->fetch();

$winner = null;
if($participants['participants'] !== 0) {
  if($giveaway['nb_winners'] !== 1 && $participants['participants'] !== 1) {
    $winners = [];
    for ($i=0; $i < $giveaway['nb_winners']; $i++) {
      $value = mt_rand(1, $participants['participants']);      
      do {   
        $value = mt_rand(1, $participants['participants']);
      } while(in_array($value, $winners));
      $winners[] = $value;
    }
    $winner = implode(',', $winners);
  } else {
    $winner = mt_rand(1, $participants['participants']);
  }
}

$sql = $bdd->prepare('UPDATE giveaways SET winner = ? WHERE id = ?');
$sql->execute([$winner, $id]);

response('success', $message, $participate);
exit;
?>