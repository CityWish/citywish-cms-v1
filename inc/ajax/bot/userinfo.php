<?php
require_once '../../bdd.php';

$user = $_GET['user'];
$key = $_GET['key'];

if(empty($key) && $key !== 'JS17122020CWDevKey'){
    $response = ['correct' => false, 'reason' => 'Vous n\'avez pas accès.'];
    echo json_encode($response);
    exit();
}

if(!empty($user)){
$sql = $bdd->prepare('SELECT id,moto,genre,certif,fonction,vote FROM members WHERE name = :user');
$sql->execute(['user' => $user]);
if($sql->rowCount() > 0){
    $result = $sql->fetch(PDO::FETCH_OBJ);

    /* Genres */
    if($result->genre !== null){
        if($result->genre === 'M'){
            $genre = 'Homme';
        }elseif($result->genre === 'F'){
            $genre = 'Femme';
        }
    }elseif($result->genre === null){
        $genre = 'Non spécifié';
    }

    /* Certification */
    if($result->certif === 0){
        $certif = 'Compte non certifié';
    }elseif($result->certif === 1){
        $certif = 'Compte certifié';
    }

    /* Votes */
    if($result->vote > 1){
        $vote = $result->vote.' votes';
    }elseif($result->vote <= 1){
        $vote = $result->vote.' vote';
    }

    /* Avatar */
    $avatar = 'https://avatar.citywish.fr/?username='.$user.'&headonly=0&size=n&head_direction=3&direction=2&gesture=sml&action=wav';
    $avatar_link = 'https://avatar.citywish.fr/?username='.$user.'&headonly=0&size=l&head_direction=2&direction=2&gesture=std';

    $response = ['error' => null, 'id' => $result->id, 'username' => $user, 'moto' => $result->moto, 'genre' => $genre, 'certif' => $certif, 'fonction' => $result->fonction, 'vote' => $vote, 'avatar' => $avatar, 'avatar_link' => $avatar_link];
    echo json_encode($response,JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);
    exit();
}else{
    $response = ['error' => 'Aucun compte ne possède ce nom d\'utilisateur sur https://citywish.fr.'];
    echo json_encode($response);
    exit();
}
}
?>
