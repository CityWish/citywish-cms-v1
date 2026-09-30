<?php
require_once '../../system.php';
require_once '../../class/Giveaways.php';

function response($msg) {
    echo $msg;
    exit;
}

$id = $_GET['id'];

if(!isset($id)) {
    response('error');
}

if(is_numeric($id)) {
    $giveaways = new Giveaways(false, $id);
    if($giveaways->getError() !== null) {
        response('error');
    }

    $players = '';
    $sql = db->connect()->prepare('SELECT id_user FROM giveaways_participants WHERE id_giveaway = ?');
    $sql->execute([$giveaways->getId()]);
    while ($item = $sql->fetch()) {
        $player = new UserInfo($item['id_user']);

        $players .= "<li>{$player->getName()}</li>";
    }

    echo $players;
}