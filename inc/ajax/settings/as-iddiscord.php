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
    if(!empty($_POST['discord-pass'])){
        $pseudomdp = $bdd->prepare('SELECT password FROM members WHERE name = :username');
        $pseudomdp->execute(['username' => $_SESSION['username']]);
        $fetchpseudo = $pseudomdp->fetch(PDO::FETCH_OBJ);
        if(isOldHash($fetchpseudo->password)){
            $pass = happyHash($_POST['pseudo-pass']);
            if($pass === $fetchpseudo->password){
                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu seras redirigé vers Discord dans quelques instants.'];
                echo json_encode($response);
                exit();
            }else{
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                echo json_encode($response);
                exit();
            }
        }else{
            if(password_verify($_POST['discord-pass'], $fetchpseudo->password)){
                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Tu seras redirigé vers Discord dans quelques instants.'];
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
?>