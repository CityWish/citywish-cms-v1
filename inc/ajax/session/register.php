<?php
ini_set('session.cookie_domain', CITYWISH_COOKIE_DOMAIN);
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

function newHash($password)
{
    return password_hash($password, PASSWORD_ARGON2I);
}

function happySecu($var)
{
    return htmlspecialchars(htmlentities(trim($var)));
}

if (isset($bdd)) {
    if (empty($_SESSION['username'])) {
        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password-confirm'])) {
            $pseudo = str_replace(' ', '', happySecu($_POST['pseudo']));
            $mail = happySecu($_POST['email']);
            $mdp = $_POST['password'];
            $mdp2 = $_POST['password-confirm'];
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                if (strlen($mail) > 254) {
                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'L\'adresse e-mail entrée n\'est pas valide.'];
                    echo json_encode($response);
                    exit();
                } else {
                    $sql = $bdd->prepare('SELECT name FROM members WHERE name = :pseudo');
                    $sql->execute(['pseudo' => $pseudo]);
                    if ($sql->rowCount() > 0) {
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Il y a déjà un compte sous ce pseudonyme sur CityWish. <a href="#connect" onclick="changeOverlay(\'connect\')">Connecte-toi</a> ou contacte un administrateur si c\'est ton compte.'];
                        echo json_encode($response);
                        exit();
                    } else {
                        if (strlen($pseudo) > 22) {
                            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le pseudonyme entré est trop long.'];
                            echo json_encode($response);
                            exit();
                        } else {
                            if ($mdp !== $mdp2) {
                                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les deux mots de passe entrés ne correspondent pas.'];
                                echo json_encode($response);
                                exit();
                            } else {
                                $occurence = new ApiHabboCity($pseudo, $apiKey);
                                if ($occurence->getErreur() !== null) {
                                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le pseudonyme entré ne correspond à aucun compte sur HabboCity. <a href="https://habbocity.me" target="_blank">Inscris-toi sur HabboCity</a> ou réessaye.'];
                                    echo json_encode($response);
                                    exit();
                                } else {
                                    if ($occurence->getMission() === $code = $_POST['code']) {
                                        $mdpfinal = newHash($_POST['password']);
                                        $sql = $bdd->prepare('INSERT INTO members(name, uniqueId, mail, password, rang, moto, genre, certif, hide, point_staff, stats_staff, jetons, points, activ_p_s, fonction, vote, ip_adresse, ban) VALUES (:pseudo, :unique, :mail, :password, :rang, :moto, :genre, :certif, :hide, :pstaffs, :statss, :jetons, :points, :activ, :fonction, :vote, :ip, :ban)');
                                        $sql->execute(['pseudo' => $pseudo, 'unique' => $occurence->getId(), 'mail' => $mail, 'password' => $mdpfinal, 'rang' => 1, 'moto' => 'Bienvenue sur CityWish !', 'genre' => $occurence->getGender(), 'certif' => 1, 'hide' => 0, 'pstaffs' => 0, 'statss' => 0, 'jetons' => 20, 'points' => 0, 'activ' => 0, 'fonction' => 'Membre', 'vote' => 0, 'ip' => $_SERVER['REMOTE_ADDR'], 'ban' => 0]);
                                        $_SESSION['username'] = $pseudo;
                                        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu es inscrit et connecté !'];
                                        echo json_encode($response);
                                        exit();
                                    } else {
                                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'L\'humeur de ton compte HabboCity ne correspond pas au code.'];
                                        echo json_encode($response);
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'L\'adresse e-mail entrée n\'est pas valide.'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tous les champs n\'ont pas été complétés.'];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu es déjà connecté.'];
        echo json_encode($response);
        exit();
    }
}
