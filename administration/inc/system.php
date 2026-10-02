<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

define("VERSION", time());

require_once 'class/System.php';
require_once __DIR__ . '/../system/config/config.php';
require_once 'class/BddInit.php';
require_once 'class/UserInfo.php';

const system = new System();
const db = new BddInit();

if (!isset($_SESSION['username'])) {
    header('Location: ../', true, 307);
    exit();
}

if (!isset($_SESSION['admin']) || $_SESSION['admin'] === false) {
    header('Location: ' . citywishBaseUrl());
    exit();
}

$user = new UserInfo($_SESSION['username']);
if ($user->getError() !== null) {
    header('Location: ./', true, 307);
    exit();
}
$sql = db->connect()->prepare('SELECT id FROM members_perms WHERE id_member = ?');
$sql->execute([$user->getId()]);
if ($sql->rowCount() === 0) {
    header('Location: ../', true, 307);
    exit();
}

$url = str_replace('/administration/', '', str_replace('.php', '', $_SERVER['REQUEST_URI']));
if ($_SERVER['REQUEST_URI'] === '/administration/') {
    $url = 'index';
}
if (!$user->hasPermissions($url)) {
    header('Location: ./', true, 307);
    exit();
}
