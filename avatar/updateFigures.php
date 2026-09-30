<?php
require_once './api.php';
require_once './bdd.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

if(!isset($_GET['key']) OR $_GET['key'] !== 'CWKey-11_08(2023') {
    exit;
}

$sql = $bdd->prepare('SELECT id,uniqueId,name FROM members WHERE uniqueId != 0 ORDER BY id DESC');
$sql->execute();

$members = $sql->fetchAll();
foreach ($members as $member) {
    $occurence = new ApiHabboCity($member['uniqueId'], $apiKey);
    if($occurence->getErreur() !== null) {
        echo $member['name'];
        echo '<br>';
    } else {
        $sql = $bdd->prepare('SELECT figure FROM members_figure WHERE id_user = ?');
        $sql->execute([$member['id']]);
        if($sql->rowCount() === 0) {
            $sql = $bdd->prepare('INSERT INTO members_figure(id_user, figure) VALUES (?,?)');
            $sql->execute([$member['id'],$occurence->getFigure()]);
        } elseif($sql->fetch()['figure'] !== $occurence->getFigure()) {
            $sql = $bdd->prepare('UPDATE members_figure SET figure = ? WHERE id_user = ?');
            $sql->execute([$occurence->getFigure(), $member['id']]);
        }
    }
}
