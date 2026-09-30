<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../../bdd.php';

if (isset($bdd)) {
    if (!empty($_SESSION['username'])) {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            if ($_POST['action'] === 'edit') {
                if (isset($_POST['id'], $_POST['link'], $_POST['name'], $_POST['avatar'], $_POST['role'])) {
                    $id = $_POST['id'];
                    $link = str_replace(' ', '', $_POST['link']);
                    $verifLink = explode('/', $link);
                    $name = str_replace(' ', '', $_POST['name']);
                    $avatar = str_replace(' ', '', $_POST['avatar']);
                    $roleId = str_replace(' ', '', $_POST['role']);
                    $onoff = (int)$_POST['onoff'];

                    if ($onoff !== 0 && $onoff !== 1) {
                        $response = ['debug' => $onoff, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois choisir si ton Webhook doit être activé ou désactivé.'];
                        echo json_encode($response);
                        exit();
                    }

                    if (empty($link) || empty($verifLink) || count($verifLink) !== 7 || (strlen($link) !== 127 && strlen($link) !== 120) || $verifLink[0] !== 'https:' || ($verifLink[2] !== 'canary.discord.com' && $verifLink[2] !== 'discord.com') || $verifLink[3] !== 'api' || $verifLink[4] !== 'webhooks' || !is_numeric($verifLink[5]) || strlen($verifLink[6]) !== 68) {
                        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Le lien de ton Webhook est invalide.'];
                        echo json_encode($response);
                        exit();
                    } else {
                        $link = str_replace('canary.', '', $link);
                    }

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
                        $webhookverif = $bdd->prepare('SELECT id FROM flux_webhook WHERE id = :id AND id_user = :user');
                        $webhookverif->execute(['id' => $id, 'user' => $jr->id]);
                        if($webhookverif->rowCount() > 0) {
                            $linkverif = $bdd->prepare('SELECT link FROM flux_webhook WHERE link = :link AND id != :id');
                            $linkverif->execute(['link' => $link, 'id' => $id]);
                            if ($linkverif->rowCount() === 0) {
                                $updateWebhook = $bdd->prepare('UPDATE flux_webhook SET link = :link, name = :name, avatar = :avatar, role = :role, onoff = :onoff WHERE id = :id AND id_user = :user');
                                $updateWebhook->execute(['link' => $link, 'name' => $name, 'avatar' => $avatar, 'role' => $roleId, 'onoff' => $onoff, 'id' => $id, 'user' => $jr->id]);
                                $response = ['type' => 'success', 'title' => 'Succès', 'reason' => 'Ton Webhook a bien été modifié.'];
                                echo json_encode($response);
                                exit();
                            } else {
                                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Le Webhook que tu essayes d\'ajouter est déjà connecté.'];
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Ce Webhook ne t\'appartient pas.'];
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à trouver ton compte.'];
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = ['id' => $_POST['id'], 'type' => 'error', 'title' => 'Erreur', 'reason' => 'ANous avons rencontré un problème lors de la récupération des données.'];
                    echo json_encode($response);
                    exit();
                }
            } elseif ($_POST['action'] === 'delete') {
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $userverif = $bdd->prepare('SELECT id FROM members WHERE name = :username');
                    $userverif->execute(['username' => $_SESSION['username']]);
                    if ($userverif->rowCount() > 0) {
                        $jr = $userverif->fetch(PDO::FETCH_OBJ);
                        $webhookverif = $bdd->prepare('SELECT id FROM flux_webhook WHERE id = :id AND id_user = :user');
                        $webhookverif->execute(['id' => $id, 'user' => $jr->id]);
                        if($webhookverif->rowCount() > 0) {
                            $deleteWebhook = $bdd->prepare('DELETE FROM flux_webhook WHERE id = :id AND id_user = :user');
                            $deleteWebhook->execute(['id' => $id, 'user' => $jr->id]);
                            $response = ['type' => 'success', 'title' => 'Succès', 'reason' => 'Ton Webhook a bien été supprimé.'];
                            echo json_encode($response);
                            exit();
                        } else {
                            $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Ce Webhook ne t\'appartient pas.'];
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à trouver ton compte.'];
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'NAous avons rencontré un problème lors de la récupération des données.'];
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'BNous avons rencontré un problème lors de la récupération des données.'];
                echo json_encode($response);
                exit();
            }
        }
    } else {
        $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois être connecté pour pouvoir modifier ou supprimer ton Webhook.'];
        echo json_encode($response);
        exit();
    }
} else {
    $response = ['type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à nous connecter à la base de données.'];
    echo json_encode($response);
    exit();
}