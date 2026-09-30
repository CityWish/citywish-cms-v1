<?php 
require_once '../../bdd.php';

/*require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);*/

if(isset($_GET['hc'])){
    if(isset($_GET['in'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :in AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['in' => 1, 'hcw' => 'hc']);
    }
    if(isset($_GET['out'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :out AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['out' => 2, 'hcw' => 'hc']);
    }
    if(isset($_GET['change'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :change AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['change' => 3, 'hcw' => 'hc']);
    }
    if(isset($_GET['all'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['hcw' => 'hc']);
    }    
}elseif(isset($_GET['cw'])){
    if(isset($_GET['in'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :in AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['in' => 1, 'hcw' => 'cw']);
    }
    if (isset($_GET['out'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :out AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['out' => 2, 'hcw' => 'cw']);
    }
    if(isset($_GET['change'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE in_out = :change AND cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['change' => 3, 'hcw' => 'cw']);
    }
    if(isset($_GET['all'])){
        $flux = $bdd->prepare('SELECT * FROM flux WHERE cw_hc = :hcw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
        $flux->execute(['hcw' => 'cw']);
    }    
}

if($flux->rowCount() < 1){
    echo '<div class="error-v">Oups, aucun flux n\'a été trouvé.</div>';
}else{
    $dateLine = '';
    while($fluxinfo = $flux->fetch(PDO::FETCH_OBJ)){
        /*if ($fluxinfo->uniqueId != '') {
            $occurence = new ApiHabboCity($fluxinfo->pseudo, $apiKey);
            if ($occurence->getErreur() == null || $occurence->getErreur() === 'Utilisateur introuvable') {
                $occurence = new ApiHabboCity($fluxinfo->uniqueId, $apiKey);
                $pseudo = $occurence->getName();
            } else {
                $pseudo = $fluxinfo->pseudo;
            }
        } else {
            $pseudo = $fluxinfo->pseudo;
        }*/
        $pseudo = $fluxinfo->pseudo;

        if ($fluxinfo->month !== 0) {
            if ($dateLine !== $fluxinfo->month.$fluxinfo->year) {
                $dateLine = $fluxinfo->month.$fluxinfo->year;
                $months = [
                '',
                'Janvier',
                'Février',
                'Mars',
                'Avril',
                'Mai',
                'Juin',
                'Juillet',
                'Août',
                'Septembre',
                'Octobre',
                'Novembre',
                'Décembre'
            ];
                echo '<div class="f-date">'.$months[$fluxinfo->month].' '.$fluxinfo->year.'</div>';
            }
        }
?>
<a href="<?php if($fluxinfo->cw_hc == 'cw'){echo '/profil/'.$pseudo.'';}else{echo 'https://habbocity.me/profil/'.$pseudo.'';}?>" target="_blank">
    <div class="f-user" style="background: url(https://avatar.citywish.fr/?username=<?php echo $fluxinfo->pseudo;?>&headonly=0) center 30px no-repeat #ededed;">
        <div class="f-top" style="background-color:<?php if($fluxinfo->in_out === 1){echo '#2FD27B';}if($fluxinfo->in_out === 2){echo '#E74D3D';}if($fluxinfo->in_out === 3){echo '#FFC107';}?>;">
            <?php 
            if($fluxinfo->in_out === 1){
                echo 'Arrivée';
            }
            if($fluxinfo->in_out === 2){
                echo 'Départ';
            }
            if($fluxinfo->in_out === 3){
                echo 'Changement';
            }
            ?>
        </div>
        <div class="f-bottom">
            <div class="f-pseudo"><?php echo $pseudo; ?>
            </div>                   
            <?php if($fluxinfo->in_out === 3){?>
            <div class="f-oldposte" style="border-bottom: none;"><?= $fluxinfo->poste;?></div>
            <div class="f-poste" style="background-color:#2FD27B;border-top:none;"><?= $fluxinfo->newposte;?></div>
            <?php } else {?>
            <div class="f-poste" style="background-color:<?php if ($fluxinfo->in_out === 1) {
                echo '#2FD27B';
            } if ($fluxinfo->in_out === 2) {
                echo '#E74D3D';
            }?>;"><?= $fluxinfo->poste;?></div>
            <?php }?>
        </div>
    </div>
</a>
<?php 
    }
}
?>