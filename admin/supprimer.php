<?php
  require 'inc/data.php';
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $suppr_id = htmlspecialchars($_GET['id']);
   $suppr = $bdd->prepare('UPDATE news SET supprimer = ? WHERE id = ?');
   $suppr->execute(array(1,$suppr_id));
   header('Location: https://citywish.fr/admin/liste.php');
}
?>
