<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

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
    if(!empty($_POST['img-pass'])){
        $imgmdp = $bdd->prepare('SELECT * FROM members WHERE name = :username');
        $imgmdp->execute(['username' => $_SESSION['username']]);
        $fetchimg = $imgmdp->fetch(PDO::FETCH_OBJ);
        if(isOldHash($fetchimg->password)){
            $pass = happyHash($_POST['img-pass']);
            if($pass === $fetchimg->password){           
            }else{
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                echo json_encode($response);
                exit();
            }
        }else{
            if(password_verify($_POST['img-pass'], $fetchimg->password)){
                
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
?>