<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';

require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

if (!empty($_SESSION['username'])) {
    $userverif = $bdd->prepare('SELECT rang FROM members WHERE name = :username');
    $userverif->execute(['username' => $_SESSION['username']]);
    if ($userverif->rowCount() > 0) {
        $jr = $userverif->fetch(PDO::FETCH_OBJ);
        if ($jr->rang >= 9) {
            $flux = $bdd->prepare('SELECT pseudo FROM flux WHERE uniqueId = :id');
            $flux->execute(['id' => '']);
            if($flux->rowCount() > 0){
                while($update = $flux->fetch(PDO::FETCH_OBJ)){
                    if ($update->uniqueId !== '') {
                        $occurence = new ApiHabboCity($update->uniqueId, $apiKey);
                        $pseudo = $update->pseudo;
                        if ($occurence->getErreur() == null) {
                            $pseudo = $occurence->getName();
                        }
                        $sqlupdate = $bdd->prepare('UPDATE flux SET pseudo = :id WHERE uniqueId = :id');
                        $sqlupdate->execute(['pseudo' => $pseudo, 'id' => $update->uniqueId]);
                        echo 'succès';
                    }
                }
            } else {
                echo '<div class="sendflux-error"><b>Erreur :</b> Tu n\'as pas la permission d\'envoyer des flux.</div>';
                exit();
            }
        } else {
            echo '<div class="sendflux-error"><b>Erreur :</b> Tu n\'as pas la permission d\'envoyer des flux.</div>';
            exit();
        }
    } else {
        echo '<div class="sendflux-error"><b>Erreur :</b> Une erreur inattendue s\'est produite avec ton compte.</div>';
        exit();
    }
} else {
    echo '<div class="sendflux-error"><b>Erreur : </b> Ta session a expirée. Tu dois te reconnecter.</div>';
    exit();
}
?>