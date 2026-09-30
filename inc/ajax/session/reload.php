<?php
ini_set('session.cookie_domain', '.citywish.fr');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

if (empty($_SESSION['username']) && isset($_GET['session'])) {
    $session = str_replace(' ', '', $_GET['session']);
    if (isset($bdd)) {
        $bddSession = $bdd->prepare('SELECT id,name FROM members WHERE name = :session');
        $bddSession->execute(['session' => $session]);
        $userSession = $bddSession->fetch(PDO::FETCH_OBJ);
        if ($bddSession->rowCount() > 0) {
            $_SESSION['username'] = $session;
            $_SESSION['userId'] = $userSession->id;
            if(isset($_GET['admin'])) {
                $_SESSION['admin'] = $_GET['admin'];
            }
            $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu es reconnecté !'];
            echo json_encode($response);
            exit();
        } else {
            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ta session est invalide. Reconnecte-toi sur une autre page.'];
            echo json_encode($response);
            exit();
        }
    }
} else {
    if(!empty($_SESSION['username'])){
        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu es déjà connecté.'];
        echo json_encode($response);
        exit();
    }
    $response = ['correct' => false];
    echo json_encode($response);
    exit();
}
