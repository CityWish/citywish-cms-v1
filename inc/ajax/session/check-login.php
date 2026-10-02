<?php
require_once '../../config.php';

ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
$host = explode(':', $_SERVER['HTTP_HOST'] ?? '', 2)[0];
if (!in_array($host, ['localhost', '127.0.0.1'], true)) {
    ini_set('session.cookie_domain', CITYWISH_COOKIE_DOMAIN);
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'strict');
session_start();

if (empty($_SESSION['username'])) {
    $response = ['correct' => true, 'type' => 'warning', 'title' => 'Avertissement', 'reason' => 'Tu n\'es plus connecté car ta session a expiré. <a id="checkLoginExtand">Appuie ici</a> pour te reconnecter.'];
    echo json_encode($response);
    exit();
} else {
    $response = ['correct' => false, 'session' => $_SESSION['username'], 'admin' => $_SESSION['admin']];
    echo json_encode($response);
    exit();
}
