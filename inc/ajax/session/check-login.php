<?php
ini_set('session.cookie_domain', '.citywish.fr');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
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
