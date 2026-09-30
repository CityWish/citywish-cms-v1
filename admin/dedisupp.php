<?php
include("inc/data.php");

if(isset($_GET['id'])){
   $suppr_id = htmlspecialchars($_GET['id']);
   $suppr = $bdd->prepare('DELETE FROM dedi WHERE id = ?');
   $suppr->execute(array($suppr_id));
   header('Location: dediliste.php');
   exit();
}

if(empty($_GET['id'])){
    header('Location: dediliste.php');
    exit();
}

?>
