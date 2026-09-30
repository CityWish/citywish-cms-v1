<?php
require_once '../../bdd.php';

$id = $_GET['id'];
$sql = $bdd->prepare('SELECT * FROM giveaways WHERE id = ? ORDER BY timestamp ASC LIMIT 5');
$sql->execute([$id]);
$item = $sql->fetch();

$sql = $bdd->prepare('SELECT id_user FROM giveaways_participants WHERE id_giveaway = ?');
$sql->execute([$id]);
$participants = $sql->fetchAll();
$winner = 'Aucun gagnant';
if($item['winner'] !== null) {
    if($item['nb_winners'] > 1) {
        $winners = explode(',', $item['winner']);
        foreach ($winners as $key => $value) {
            $sql = $bdd->prepare('SELECT name FROM members WHERE id = ?');
            $sql->execute([$participants[$value-1]['id_user']]);
            $winner_fetch = $sql->fetch();
            if($key === 0) {
                $winner = 'Gagnant(s) : '.$winner_fetch['name'] ;
            } else {
                $winner = $winner.', '.$winner_fetch['name'];
            }
        }
    } else {
        $sql = $bdd->prepare('SELECT name FROM members WHERE id = ?');
        $sql->execute([$participants[$item['winner']-1]['id_user']]);
        $winner_fetch = $sql->fetch();
        $winner = 'Gagnant(e) : '.$winner_fetch['name'];
    }
}
?>
<div class="item-winners"><?= $winner; ?></div>