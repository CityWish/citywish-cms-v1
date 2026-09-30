<?php
require_once '../../bdd.php';

require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

if (!empty($_POST['username'])) {
    $pseudo = str_replace(' ', '', $_POST['username']);
    $occurence = new ApiHabboCity($pseudo, $apiKey);
    if ($occurence->getErreur() != null) {
        if ($occurence->getErreur() === 'Utilisateur introuvable') {
            echo '<div class="sendflux-warn"><b>Avertissement :</b> Le pseudonyme entré n\'est lié à aucun compte sur HabboCity.</div>';
            exit();
        } else {
            echo '<div class="sendflux-warn"><b>Avertissement :</b> Nous avons rencontré un problème lors de la connexion à l\'API de HabboCity. La vérification de l\'existence du pseudonyme entré sur HabboCity est donc impossible.</div>';
            exit();
        }
    }
}
?>