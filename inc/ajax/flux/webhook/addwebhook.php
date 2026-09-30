<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../../bdd.php';

if (isset($bdd)) {
    if (!empty($_SESSION['username'])) {
        if (isset($_POST['link'], $_POST['name'], $_POST['avatar'], $_POST['role'])) {
            $link = str_replace(' ', '', $_POST['link']);
            $verifLink = explode('/', $link);
            $name = str_replace(' ', '', $_POST['name']);
            $avatar = str_replace(' ', '', $_POST['avatar']);
            $roleId = str_replace(' ', '', $_POST['role']);
            $onoff = (int)$_POST['onoff'];

            if ($onoff !== 0 && $onoff !== 1) {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois choisir si ton Webhook doit être activé ou désactivé.'];
                echo json_encode($response);
                exit();
            }

            /*if (empty($link) || empty($verifLink) || count($verifLink) !== 7 || (strlen($link) !== 127 && strlen($link) !== 120) || $verifLink[0] !== 'https:' || ($verifLink[2] !== 'canary.discord.com' && $verifLink[2] !== 'discord.com') || $verifLink[3] !== 'api' || $verifLink[4] !== 'webhooks' || !is_numeric($verifLink[5]) || strlen($verifLink[6]) !== 68) {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Le lien de ton Webhook est invalide.'];
                echo json_encode($response);
                exit();
            } else {
                $link = str_replace('canary.', '', $link);
            }*/

            if ($name === '') {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois entrer le nom du serveur Discord du Webhook.'];
                echo json_encode($response);
                exit();
            }

            if ($avatar === '') {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois entrer le lien du logo du serveur Discord du Webhook.'];
                echo json_encode($response);
                exit();
            } else {
                $file_headers = @get_headers($avatar, 1);
                if (strpos($file_headers['Content-Type'], 'image/') !== 0) {
                    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Le lien du logo ne correspond pas à une image.'];
                    echo json_encode($response);
                    exit();
                }
            }

            if ($roleId !== '') {
                if (strlen($roleId) !== 18 || !is_numeric($roleId)) {
                    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'L\'identifiant du rôle à mentionner est invalide.'];
                    echo json_encode($response);
                    exit();
                }
            }

            $userverif = $bdd->prepare('SELECT id FROM members WHERE name = :username');
            $userverif->execute(['username' => $_SESSION['username']]);
            if ($userverif->rowCount() > 0) {
                $jr = $userverif->fetch(PDO::FETCH_OBJ);
                $webhooks = $bdd->prepare('SELECT id_user FROM flux_webhook WHERE id_user = :iduser');
                $webhooks->execute(['iduser' => $jr->id]);
                if ($webhooks->rowCount() < 3) {
                    $linkverif = $bdd->prepare('SELECT link FROM flux_webhook WHERE link = :link');
                    $linkverif->execute(['link' => $link]);
                    if ($linkverif->rowCount() === 0) {
                        $addWebhook = $bdd->prepare('INSERT INTO flux_webhook(id_user,link,name,avatar,role,onoff) VALUES (?,?,?,?,?,?)');
                        $addWebhook->execute([$jr->id, $link, $name, $avatar, $roleId, $onoff]);
                        $response = ['type' => 'success', 'title' => 'Succès', 'reason' => 'Ton Webhook a bien été ajouté.'];
                        echo json_encode($response);
                        exit();
                    } else {
                        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Le Webhook que tu essayes d\'ajouter est déjà connecté.'];
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu ne peux pas avoir plus de 3 Webhooks connectés à ton compte.'];
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à trouver ton compte.'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous avons rencontré un problème lors de l\'envoie des données.'];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois être connecté pour pouvoir ajouter ton Webhook.'];
        echo json_encode($response);
        exit();
    }
} else {
    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à nous connecter à la base de données.'];
    echo json_encode($response);
    exit();
}