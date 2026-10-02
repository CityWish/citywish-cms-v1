<?php
require_once '../../bdd.php';

$month = $_GET['month'];
$year = $_GET['year'];
$key = $_GET['key'];

if(empty($key) || $key !== 'JS17122020CWDevKey'){
    header('Location: ' . citywishBaseUrl());
    exit();
}

$ranking = $bdd->prepare('SELECT id_discord FROM ranking_discord WHERE ranking = :ranking AND month = :dmonth AND year = :dyear');
$ranking->execute(['ranking' => 1, 'dmonth' => $month, 'dyear' => $year]);
if ($ranking->rowCount() > 0) {
    $sql = $bdd->prepare('SELECT id_discord,points,month,year FROM ranking_discord WHERE month = :dmonth AND year = :dyear AND ranking = :ranking AND points > :points ORDER BY points DESC');
    $sql->execute(['dmonth' => $month, 'dyear' => $year, 'ranking' => 0, 'points' => 0]);
    if ($sql->rowCount() > 0) {
        echo json_encode(['correct' => true, 'messageid' => $ranking->fetch(PDO::FETCH_OBJ)->id_discord, 'response' => $sql->fetchAll(PDO::FETCH_OBJ)], JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        echo json_encode(['correct' => false, 'messageid' => $ranking->fetch(PDO::FETCH_OBJ)->id_discord]);
        exit();
    }
} else {
    echo json_encode(['correct' => false, 'addranking' => true]);
    exit();
}
?>