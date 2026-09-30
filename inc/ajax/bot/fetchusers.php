<?php
require_once '../../bdd.php';

header('Content-Type: application/json');

if ($_GET['username'] && !empty($_GET['username'])) {
    $username = htmlspecialchars($_GET['username']);

    $users = $bdd->prepare('SELECT name FROM members WHERE name LIKE ? LIMIT 25');
    $users->execute([$username.'%']);

    $users = $users->fetchAll(PDO::FETCH_OBJ);
    $users = array_map(function($user) {
        return $user->name;
    }, $users);

    echo json_encode(['users' => $users]);
} else {
    echo json_encode(['users' => []]);
}