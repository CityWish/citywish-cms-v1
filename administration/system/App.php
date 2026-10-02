<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

include '/var/www/citywish/beta/system/App.php';

if (!sessionManager->isOnline()) {
    var_dump($_SESSION);
    exit();
}

if (!isset($_SESSION['admin']) || $_SESSION['admin'] === false) {
    var_dump($_SESSION);
    exit();
}

$sql = db->connect()->prepare('SELECT id FROM cw_staffs WHERE id = ?');
$sql->execute([player->getId()]);
if ($sql->rowCount() === 0) {
    header('Location: ' . citywishBaseUrl(), true, 307);
    exit();
}

$url = str_replace('/administration/', '', str_replace('.php', '', $_SERVER['REQUEST_URI']));
if ($_SERVER['REQUEST_URI'] === '/administration/') {
    $url = 'index';
}
if (!player->hasPermissions($url)) {
    header('Location: ' . citywishBaseUrl(), true, 307);
    exit();
}
