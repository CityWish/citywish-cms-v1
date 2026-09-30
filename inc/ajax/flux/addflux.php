<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../bdd.php';
require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

if (!empty($_SESSION['username']) || isset($_GET['key'])) {
    if (!empty($_POST['username']) && !empty($_POST['poste'])) {
        $pseudo = str_replace(' ', '', $_POST['username']);
        $fonction = $_POST['poste'];
        $where = 'hc';
        $type = $_POST['type'];
        $newposte = $_POST['new-poste'];
        $pole = $_POST['pole'];
				$month = isset($_POST['date']) ? date('m', strtotime($_POST['date'])) : date('m');
				$year = isset($_POST['date']) ? date('Y', strtotime($_POST['date'])) : date('Y');
				if((intval($month) > intval(date('m')) &&  intval($year) === intval(date('Y'))) || intval($year) > intval(date('Y')) || intval($year) < 2019) {
					echo '<div class="sendflux-error"><b>Erreur :</b> La date inscrite est incorrecte.</div>';
					exit();
				}
        if ($type === '3') {
            if (empty($newposte)) {
                echo '<div class="sendflux-error"><b>Erreur :</b> Tous les champs n\'ont pas été complétés.</div>';
                exit();
            }
        }
        $userverif = $bdd->prepare('SELECT rang FROM members WHERE name = :username');
        $userverif->execute(['username' => $_SESSION['username']]);
        if ($userverif->rowCount() > 0 || $_GET['key'] === 'key11022022FluxDiscord') {
            $jr = $userverif->fetch(PDO::FETCH_OBJ);
            if ($jr->rang >= 7 || $jr->flux === 1 || $_GET['key'] === 'key11022022FluxDiscord') {
                $occurence = new ApiHabboCity($pseudo, $apiKey);
                $uniqueId = '';
                if($occurence->getErreur() == null){
                    $uniqueId = $occurence->getId();
                }
                $sql = $bdd->prepare('INSERT INTO flux(pseudo,uniqueId,cw_hc,poste,newposte,pole,in_out,month,year) VALUES(?,?,?,?,?,?,?,?,?)');
                $sql->execute([$pseudo, $uniqueId, $where, $fonction, $newposte, $pole, $type, $month, $year]);
                echo '<div class="sendflux-success"><b>Succès :</b> Le flux a bien été ajouté !</div>';
                exit();
            } else {
                echo '<div class="sendflux-error"><b>Erreur :</b> Tu n\'as pas la permission d\'envoyer des flux.</div>';
                exit();
            }
        } else {
            echo '<div class="sendflux-error"><b>Erreur :</b> Une erreur inattendue s\'est produite avec ton compte.</div>';
            exit();
        }
    } else {
        echo '<div class="sendflux-error"><b>Erreur :</b> Tous les champs n\'ont pas été complétés.</div>';
        exit();
    }
} else {
    echo '<div class="sendflux-error"><b>Erreur : </b> Ta session a expirée. Tu dois te reconnecter.</div>';
    exit();
}
?>