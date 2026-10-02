<?php
ini_set('session.cookie_domain', CITYWISH_COOKIE_DOMAIN);
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

function isOldHash($hash)
{
    return preg_match('/^[a-f0-9]{32}$/', $hash);
}

function happyHash($var)
{
    return happySecu(md5(sha1(md5(sha1($var)))));
}

function newHash($password)
{
    return password_hash($password, PASSWORD_ARGON2I);
}

if (isset($bdd)) {
    if(empty($_SESSION['username'])) {
        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
            $sql = $bdd->prepare('SELECT * FROM members WHERE name = :user');
            $sql->execute(['user' => str_replace(' ', '', $_POST['pseudo'])]);
            if ($sql->rowCount() > 0) {
                $jr = $sql->fetch(PDO::FETCH_OBJ);
                $hash = $jr->password;
                if ($hash !== null) {
                    if (isOldHash($hash)) {
                        if (happyHash($_POST['password']) === $hash) {
                            $_SESSION['username'] = str_replace(' ', '', $_POST['pseudo']);
                            $_SESSION['userId'] = $jr->id;
                            $_SESSION['admin'] = false;
                            $changemdp = $bdd->prepare('UPDATE members SET password = :pass WHERE name = :username');
                            $changemdp->execute(['pass' => newHash($_POST['password']), 'username' => $_SESSION['username']]);
                            $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu es connecté !'];
                            echo json_encode($response);
                            exit();
                        } else {
                            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le mot de passe saisi est incorrect.'];
                            echo json_encode($response);
                            exit();
                        }
                    } else if (password_verify($_POST['password'], $hash)) {
                        $_SESSION['username'] = str_replace(' ', '', $_POST['pseudo']);
                        $_SESSION['userId'] = $jr->id;
                        $_SESSION['admin'] = false;
                        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu es connecté !'];
                        echo json_encode($response);

                        if($jr->discord_tokens !== 'none') {
                            $curl = curl_init('http://185.142.53.116:3000/discord?refresh='.explode(',', $jr->discord_tokens)[1]);
                            curl_setopt_array($curl, [
                                CURLOPT_USERAGENT => 'CityWish (+' . citywishBaseUrl() . ')',
                                CURLOPT_SSL_VERIFYHOST => false,
                                CURLOPT_SSL_VERIFYPEER => false,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_FOLLOWLOCATION => true
                            ]);
                            $data = curl_exec($curl);
                            if ($data === false ||curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
                                curl_close($curl);
                            }
                            $json = json_decode($data);
                            if (!$json) {
                                curl_close($curl);
                            }
                            curl_close($curl);
                        
                            $sql_tokens = $bdd->prepare('UPDATE members SET discord_tokens = :tokens WHERE id = :user');
                            $sql_tokens->execute(['tokens' => $json->tokens, 'user' => $jr->id]);
                        }
                        exit();
                    } else {
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le mot de passe saisi est incorrect.'];
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Il y a une erreur avec ton mot de passe. Contacte un administrateur.'];
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le pseudonyme entré ne correspond à aucun compte. <a href="#register" onclick="changeOverlay(\'register\')">Inscris-toi</a> ou réessaye.'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tous les champs n\'ont pas été complétés.'];
            echo json_encode($response);
            exit();
        }
    }
}
