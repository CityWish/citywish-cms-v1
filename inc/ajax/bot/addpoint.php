<?php
require_once '../../bdd.php';

$user = $_POST['id_discord'];
$points = $_POST['points'];
$key = $_POST['key'];

if(empty($key) || $key !== 'JS17122020CWDevKey'){
    $response = ['correct' => false, 'reason' => 'Vous n\'avez pas accès.'];
    echo json_encode($response);
    exit();
}

if(empty($user)){
    $response = ['correct' => false, 'reason' => 'Tu dois obligatoirement mentionner le joueur en premier.'];
    echo json_encode($response);
    exit();
}else{
    if(empty($points)){
        $response = ['correct' => false, 'reason' => 'Tu dois obligatoirement inscrire le nombre de points à ajouter en deuxième.'];
        echo json_encode($response);
        exit();        
    }else{
        if(!is_int($points)){
            $points = (int) $points;
        }
        $verifexist = $bdd->prepare('SELECT id_discord,month,year FROM ranking_discord WHERE id_discord = :name AND month = :month AND year = :year');
        $verifexist->execute(['name' => $user, 'month' => date('m'), 'year' => date('Y')]);
        if($verifexist->rowCount() === 0){
            $addpoints = $bdd->prepare('INSERT INTO ranking_discord (id_discord, points, month, year) VALUES(?,?,?,?)');
            $addpoints->execute([$user, $points, date('m'), date('Y')]);
            $response = ['correct' => true, 'month' => date('m'), 'year' => date('Y'), 'insertinto' => true];
            echo json_encode($response);
            exit();            
        }elseif($verifexist->rowCount() === 1){
            $updatepoints = $bdd->prepare('UPDATE ranking_discord SET points = points + :number WHERE id_discord = :name AND month = :month AND year = :year');
            $updatepoints->execute(['number' => $points, 'name' => $user, 'month' => date('m'), 'year' => date('Y')]);
            $response = ['correct' => true, 'month' => date('m'), 'year' => date('Y'), 'update' => true];
            echo json_encode($response);
            exit();             
        }
      
        
        
        /*if($verifexist->rowCount() < 1){
            $addpoints = $bdd->prepare('INSERT INTO ranking_discord (pseudo, points, month, year) VALUES(?,?,?,?)');
            $addpoints->execute([$user, $points, date('m'), date('Y')]);
            $response = ['correct' => true, 'month' => date('m'), 'year' => date('Y'), 'insertinto' => true];
            echo json_encode($response);
            exit();
        }elseif($verifexist->rowCount() > 0){
            if($verifexist->fetch(PDO::FETCH_OBJ)->month !== date('m') && $verifexist->fetch(PDO::FETCH_OBJ)->year !== date('y')){
                $addpoints = $bdd->prepare('INSERT INTO ranking_discord (pseudo, points, month, year) VALUES(?,?,?,?)');
                $addpoints->execute([$user, $points, date('m'), date('Y')]);
                $response = ['correct' => true, 'month' => date('m'), 'year' => date('Y'), 'insertinto2' => true];
                echo json_encode($response);
                exit();
            }else{
                $addpoints = $bdd->prepare('UPDATE ranking_discord SET points = points + :number WHERE pseudo = :name');
                $addpoints->execute(['number' => $points, 'name' => $user]);
                $response = ['correct' => true, 'month' => date('m'), 'year' => date('Y'), 'update' => true];
                echo json_encode($response);
                exit();                
            }
        }  */
    }  
}  
?> 