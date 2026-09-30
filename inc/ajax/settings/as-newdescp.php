<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

function happySecu($var)
{
    return htmlspecialchars(htmlentities(trim($var)));
}

function newHash($password)
{
    return password_hash($password, PASSWORD_ARGON2I);
}

function happyHash($password)
{
  return md5(sha1(md5(sha1($password))));
}

function isOldHash($hash)
{
    return preg_match('/^[a-f0-9]{32}$/', $hash);
}

if(!empty($_SESSION['username'])){
    if(!empty($_POST['descp-pass']) && !empty($_POST['descp'])){
        $descpmdp = $bdd->prepare('SELECT * FROM members WHERE name = :username');
        $descpmdp->execute(['username' => $_SESSION['username']]);
        $fetchdescp = $descpmdp->fetch(PDO::FETCH_OBJ);
        if(isOldHash($fetchdescp->password)){
            $pass = happyHash($_POST['descp-pass']);
            if($pass === $fetchdescp->password){
                $descp = happySecu($_POST['descp']);
                $changedescp = $bdd->prepare('UPDATE members SET moto = :descp WHERE name = :user');
                $changedescp->execute(['descp' => $descp, 'user' => $_SESSION['username']]);
                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ta description a été changée !'];
                echo json_encode($response);
                exit();
            }else{
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                echo json_encode($response);
                exit();
            }
        }else{
            if(password_verify($_POST['descp-pass'], $fetchdescp->password)){
                $descp = happySecu($_POST['descp']);
                $changedescp = $bdd->prepare('UPDATE members SET moto = :descp WHERE name = :user');
                $changedescp->execute(['descp' => $descp, 'user' => $_SESSION['username']]);
                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ta description a été changée !'];
                echo json_encode($response);
                exit();
            }else{
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                echo json_encode($response);
                exit();
            } 
        }
    }else{
        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tous les champs n\'ont pas été complétés.'];
        echo json_encode($response);
        exit();
    }
}else{
    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Il faut être connecté pour changer ses paramètres.'];
    echo json_encode($response);
    exit();
}
