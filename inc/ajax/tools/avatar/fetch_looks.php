<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../../bdd.php';

if(isset($_SESSION['username'])){
  $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
  $user->execute([$_SESSION['username']]);
  if($user->rowCount() !== 0) {
    $jr = $user->fetch(PDO::FETCH_OBJ);
    $fetch = $bdd->prepare('SELECT id,pseudo,path,date FROM looks WHERE id_user = ?');
    $fetch->execute([$jr->id]);
    echo json_encode(['type' => 'success', 'reason' => '', 'looks' => $fetch->fetchAll()]);
    exit();
  } else {
    echo json_encode([]);
    exit();
  }
} else {
  echo json_encode(['type' => 'error', 'reason' => 'Il faut être connecté pour pouvoir accéder à ses looks sauvegardés.']);
  exit();
}

