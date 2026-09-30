<?php
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

function happyHash($password)
{
  return md5(sha1(md5(sha1($password))));
}

function isOldHash($hash)
{
    return preg_match('/^[a-f0-9]{32}$/', $hash);
}

if(!empty($_SESSION['username'])){
    if(!empty($_POST['pseudo-pass']) && !empty($_POST['pseudo'])){
        $pseudomdp = $bdd->prepare('SELECT * FROM members WHERE name = :username');
        $pseudomdp->execute(['username' => $_SESSION['username']]);
        $fetchpseudo = $pseudomdp->fetch(PDO::FETCH_OBJ);
        if(isOldHash($fetchpseudo->password)){
            $pass = happyHash($_POST['pseudo-pass']);
            if($pass === $fetchpseudo->password){
                $pseudo = str_replace(' ', '', happySecu($_POST['pseudo']));
                if(strlen($pseudo) <= 22){
                    $checkName = $bdd->prepare('SELECT name FROM members WHERE name = ?');
                    $checkName->execute([$pseudo]);
                    if($checkName->rowCount() === 0) {
                        $occurence = new ApiHabboCity($pseudo, $apiKey);
                        if($occurence->getErreur() == null){
                            if($occurence->getMission() === $code = $_POST['pseudo-code']){
                                $changepseudo = $bdd->prepare('UPDATE membres SET name = :pseudo WHERE name = :user');
                                $changepseudo->execute(['pseudo' => $pseudo, 'user' => $_SESSION['username']]);
                                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ton pseudo a été changé !'];
                                echo json_encode($response);
                                exit();
                            }else{
                                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le code n\'a pas été entré dans ton humeur.'];
                                echo json_encode($response);
                                exit();
                            }
                        }else {
                            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Un compte avec ce pseudo existe déjà sur CityWish.'];
                            echo json_encode($response);
                            exit();
                        }
                    }else{
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à nous connecter à l\'API d\'HabboCity.'];
                        echo json_encode($response);
                        exit();
                    }
                }else{
                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le pseudonyme saisi est trop long.'];
                    echo json_encode($response);
                    exit();
                }
            }else{
                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Ton mot de passe actuel est incorrect.'];
                echo json_encode($response);
                exit();
            }
        }else{
            if(password_verify($_POST['pseudo-pass'], $fetchpseudo->password)){
                $pseudo = str_replace(' ', '', $_POST['pseudo']);
                if(strlen($pseudo) <= 22){
                    $checkName = $bdd->prepare('SELECT name FROM members WHERE name = ?');
                    $checkName->execute([$pseudo]);
                    if($checkName->rowCount() === 0) {
                        $occurence = new ApiHabboCity($pseudo, $apiKey);
                        if ($occurence->getErreur() == null) {
                            $code = $_POST['pseudo-code'];
                            if ($occurence->getMission() === $code) {
                                $changepseudo = $bdd->prepare('UPDATE members SET name = :pseudo WHERE name = :user');
                                $changepseudo->execute(['pseudo' => $pseudo, 'user' => $_SESSION['username']]);
                                $_SESSION['username'] = $pseudo;
                                $response = ['correct' => true, 'type' => 'success', 'title' => 'Succès', 'reason' => 'Ton pseudo a été changé !'];
                                echo json_encode($response);
                                exit();
                            } else {
                                $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le code n\'a pas été entré dans ton humeur.'];
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Nous n\'avons pas réussi à nous connecter à l\'API d\'HabboCity.'];
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Un compte avec ce pseudo existe déjà sur CityWish.'];
                        echo json_encode($response);
                        exit();
                    }
                }else{
                    $response = ['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le pseudonyme saisi est trop long.'];
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