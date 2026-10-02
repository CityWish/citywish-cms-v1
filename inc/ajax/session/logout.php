<?php
require_once '../../config.php';

ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
if (CITYWISH_COOKIE_DOMAIN !== '') {
    ini_set('session.cookie_domain', CITYWISH_COOKIE_DOMAIN);
}
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'strict');
session_start();

if (!empty($_SESSION['username'])) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION = [];
        session_destroy();
        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu es déconnecté !'];
        echo json_encode($response);
        exit();
    }
}
