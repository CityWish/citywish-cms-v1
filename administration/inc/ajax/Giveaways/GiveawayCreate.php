<?php
require_once '../../system.php';
require_once '../../class/Giveaways.php';
require_once '../../../../inc/webhook/Client.php';
require_once '../../../../inc/webhook/Embed.php';
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

function response($status = 'error', $msg = 'Il y a eu un problème lors de l\'envoie. Réessaye.') {
  $title = $status === 'success' ? 'Succès' : 'Erreur';
  echo json_encode(['type' => $status, 'title' => $title, 'reason' => $msg]);
  exit;
}

$id = $_POST['id'];
$title = $_POST['title'];
$nb_winners = $_POST['nb-winners'];
$date = $_POST['date'];

if(!isset($id, $title, $nb_winners, $date)) {
  response('error', 'Un des champs n\'est pas complété.');
}
if(strlen($title) > 30 OR strlen($title) < 5) {
  response('error', 'Le titre doit être compris entre 5 et 30 caractères.');
}
if(!is_numeric($nb_winners)) {
  response('error', 'Le nombre de gagnants est invalide.');
}
if($nb_winners > 10 OR $nb_winners < 1) {
  response('error', 'Le nombre de gagnants doit se trouver entre 1 et 10 inclus.');
}

if(is_numeric($id)) {
  $giveaways = new Giveaways(false, $id);
  if($giveaways->getError() !== null) {
    response('error', 'Le giveaways sélectionné est introuvable.');
  }
  if($giveaways->getTimestamp() < time()) {
    response('error', 'Le giveaways sélectionné est déjà terminé.');
  } 

  $giveaways->setTitle($title);
  $giveaways->setNbWinners($nb_winners);
  $giveaways->updateGiveaways();  

  response('success', 'Le giveaways a bien été modifié.');
} else if ($id === 'create') {
  $giveaways = new Giveaways(true);
  if(strtotime($date) < time() + 86400) {
    response('error', 'La durée d\'un giveaways est de minimum 24 heures.');
  }

  $giveaways->setAuthor($user->getId());
  $giveaways->setTitle($title);
  $giveaways->setTimestamp(strtotime($date));
  $giveaways->setNbWinners($nb_winners);
  $giveaways->createGiveaways();

  $client = new Client(citywishEnv('CITYWISH_GIVEAWAY_DISCORD_WEBHOOK', CITYWISH_GIVEAWAY_DISCORD_WEBHOOK));
  $client->avatar('https://citywish.fr/assets/imgs/meta.png');

  $author = new UserInfo($giveaways->getAuthor());

  $embed = new Embed();
  $embed->url('https://citywish.fr/');
  $embed->color('#1976d2');
  $embed->author($author->getName().' - '.html_entity_decode(html_entity_decode($author->getFonction())), 'https://citywish.fr/profil/'.$author->getName(), 'https://citywish.fr/assets/imgs/meta.png');
  $embed->title('__**Nouveau Giveaways sur CityWish.fr**__');
  $embed->description('Un __**[nouveau giveaways](https://citywish.fr/)**__ lancé par __**['.$author->getName().'](https://citywish.fr/profil/'.$author->getName().' "'.html_entity_decode(html_entity_decode($author->getFonction())).'")**__ est apparu sur notre site internet CityWish.fr !');
  $embed->field('Lots du giveaways :', '__'.$giveaways->getTitle().'__', true);
  $embed->field('Nombre de gagnants :', '__'.$giveaways->getNbWinners().'__', true);
  $embed->field('Date de fin du giveaways :', '__'.date('d-m-Y', $giveaways->getTimestamp()).'__', true);
  $embed->thumbnail('https://citywish.fr/assets/imgs/meta.png');
  $embed->footer('Liste des articles de notre site : https://citywish.fr/articles');
  $embed->timestamp(date('c'));
  $client->embed($embed)->message('<@&564520652145557534>')->send();

  response('success', 'Le giveaways a bien été créé.');
}