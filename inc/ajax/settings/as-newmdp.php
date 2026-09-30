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
    if(!empty($_POST['oldmdp']) && !empty($_POST['newmdp']) && !empty($_POST['confirm-newmdp'])){
        $checkmdp = $bdd->prepare('SELECT * FROM members WHERE name = :username');
        $checkmdp->execute(['username' => $_SESSION['username']]);
            $fetchcheck = $checkmdp->fetch(PDO::FETCH_OBJ);
            if(isOldHash($fetchcheck->password)){
                $oldmdp = happyHash($_POST['oldmdp']);
                if($oldmdp === $fetchcheck->password){
                    $newmdp = $_POST['newmdp'];
                    $confirm_newmdp = $_POST['confirm-newmdp'];
                    if($newmdp == $confirm_newmdp){
                        $newmdp_hash = password_hash($newmdp, PASSWORD_ARGON2I);
                        $changemdp = $bdd->prepare('UPDATE members SET password = :newpswrd WHERE name = :username');
                        $changemdp->execute(['newpswrd' => $newmdp_hash, 'username' => $_SESSION['username']]);
                        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ton mot de passe a été modifié !'];
                        echo json_encode($response);
                        exit();
                    }else{
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les mots de passe saisis ne correspondent pas'];
                        echo json_encode($response);
                        exit();
                    }
                }else{
                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                    echo json_encode($response);
                    exit();
                }
            }else{
                if(password_verify($_POST['oldmdp'], $fetchcheck->password)){
                    $newmdp = $_POST['newmdp'];
                    $confirm_newmdp = $_POST['confirm-newmdp'];
                    if($newmdp == $confirm_newmdp){
                        $newmdp_hash = password_hash($newmdp, PASSWORD_ARGON2I);
                        $changemdp = $bdd->prepare('UPDATE members SET password = :newpswrd WHERE name = :username');
                        $changemdp->execute(['newpswrd' => $newmdp_hash, 'username' => $_SESSION['username']]);
                        $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ton mot de passe a été modifié !'];
                        echo json_encode($response);
                        exit();
                    }else{
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Les mots de passe saisis ne correspondent pas.'];
                        echo json_encode($response);
                        exit();
                    }                    
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