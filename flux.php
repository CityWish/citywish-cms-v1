<?php
require_once 'inc/core.php';
$_GET['page'] = 0;
$nav_en_cours = 'Flux';
?>
<!DOCTYPE html>
<html lang="fr">

<head profile='https://gmpg.org/xfn/11'>
    <!--[if lt IE 9]>
    <script src="https://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
    <![endif]-->

    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width"/>
    <meta name="theme-color" content="#258dc0"/>
    <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity"/>
    <meta name="description" content="<?php echo $Configs['Desc']; ?>"/>
    <meta name="identifier-url" content="<?= $Configs['Url'] ?>"/>
    <meta name="language" content="fr-FR"/>
    <meta name="category" content="Website">
    <meta name="reply-to" content="contact@citywish.fr">
    <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="<?= $Configs['Url'] ?>rss.php"/>

    <meta name="title" content="CityWish - Vos souhaits réalisés"/>
    <meta name="author" lang="fr" content="Cold"/>
    <meta name="subject" content="HabboCity"/>
    <meta name="rating" content="general"/>
    <meta name="distribution" content="global"/>
    <meta name="country" content="France"/>
    <meta name="geography" content="France"/>
    <meta name="hreflang" content="fr-FR"/>

    <meta property="og:title" content="CITYWISH - Flux HabboCity"/>
    <meta property="og:type" content="website"/>
    <meta name='og:description' content="<?php echo $Configs['Desc']; ?>">
    <meta property="og:url" content="<?= $Configs['Url'] ?>"/>
    <meta property='og:image:url' content='<?= $Configs['Url'] ?>assets/imgs/meta.png'>
    <meta property="og:image:alt" content="CityWish"/>
    <meta property="og:image:height" content="1024"/>
    <meta property="og:image:width" content="1024"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta property="og:site_name" content="CITYWISH"/>

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@CityWish_FR"/>
    <meta name="twitter:title" content="CITYWISH - Flux"/>
    <meta name="twitter:description" content="<?php echo $Configs['Desc']; ?>"/>
    <meta name="twitter:creator" content="@Cold_FR"/>
    <meta name="twitter:image:src" content="<?= $Configs['Url'] ?>assets/imgs/meta.png"/>
    <meta name="twitter:image:alt" content="CityWish"/>
    <meta name="twitter:domain" content="<?= $Configs['Url'] ?>"/>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?= $Configs['Url'] ?>fav/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?= $Configs['Url'] ?>fav/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="<?= $Configs['Url'] ?>fav/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="<?= $Configs['Url'] ?>fav/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-128.png" sizes="128x128"/>

    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css?v=<?= VERSION ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/flux.css?v=<?= VERSION ?>"/>
    <link type="text/css" rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=<?= VERSION ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css?v=<?= VERSION ?>"/>
    <link type="text/css" rel='stylesheet'
          href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet"
          href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

    <title><?php echo $Configs['Nom']; ?> : Flux HabboCity</title>
</head>

<body>
<?php include_once("assets/templates/header.php"); ?>

<?php include_once("assets/templates/overlay.php"); ?>

<?php include_once("assets/templates/loader.php"); ?>

<?php include_once("assets/templates/top-bottom.php"); ?>

<?php include_once("assets/templates/announcement.php"); ?>

<?php if (isset($_SESSION['username'])) {
	if($jr->rang >= 9 || $jr->flux === 1) { ?>
<div class="drag-flux" id="send-flux">
	<div class="top">Ajouter un flux</div>
	<div class="content">
		<form id="sendflux-form">
			<div id="sendflux-avatar"></div>
			<input type="text" name="username" placeholder="Pseudonyme..." id="sendflux-pseudo" />
			<input type="text" name="poste" placeholder="Poste..." id="sendflux-poste" />
			<input type="text" name="new-poste" placeholder="Nouveau poste (Si changement)..." id="sendflux-oldposte"
				style="display:none;" />
			<input type="text" style="display:none;" name="where" value="hc" disabled />
			<input type="date" name="date" id="sendflux-date" min="2019-08-01"/>
			<select name="type" id="sendflux-type">
				<option value="1">Arrivée</option>
				<option value="2">Départ</option>
				<option value="3">Changement de poste</option>
			</select>
			<select name="pole">
				<optgroup label="Gestion et Communication">
					<option value="1">Direction</option>
					<option value="5">Communication</option>
					<option value="2">Organisation</option>
				</optgroup>
				<optgroup label="Sécurité et Assistance">
					<option value="11">Sécurité</option>
					<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Assistance">
						<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;Assistance Hôtel</option>
						<option value="13">&nbsp;&nbsp;&nbsp;&nbsp;Assistance Forum</option>
						<option value="14">&nbsp;&nbsp;&nbsp;&nbsp;Assistance Discord</option>
					</optgroup>
				</optgroup>
				<optgroup label="Animation et Événementiel">
					<option value="6">Casino</option>
					<option value="8">Animation</option>
					<option value="9">Wired</option>
					<option value="7">Événementiel</option>
					<option value="10">Architecture</option>
				</optgroup>
				<optgroup label="Création et Développement">
					<option value="4">Créations visuelles</option>
					<option value="3">Développement</option>
				</optgroup>
			</select>
			<div id="sendflux-alert"></div>
			<input type="submit" style="width:100%;" />
		</form>
	</div>
</div>
<script></script>
<?php } }?>

<div id="container">
    <?php include_once("assets/templates/alerte.php"); ?>

    <div class="dedi">
        <div id="left" style="width: 100px;">
            <div class="title">
                dédicaces
            </div>
        </div>

        <div id="right" style="width: 87.5%;padding: 11px  8px  8px  8px;height: 40px;">

            <marquee id="scroller" scrollamount="7" direction="left" onmouseover="javascript:scroller.stop()"
                     onmouseout="javascript:scroller.start()">
                <?php
                $sql = $bdd->prepare("SELECT * FROM dedi ORDER by id DESC LIMIT 20");
                $sql->execute();
                while ($dedi = $sql->fetch(PDO::FETCH_OBJ)) {
                    ?>

                    <div class="msg">
                        <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') === FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') === FALSE) { ?>
                        <div class="avat-dedi"
                             style="background-image: url(https://avatar.citywish.fr/?username=<?php echo $dedi->par; ?>&headonly=1&direction=2&head_direction=2&size=s)">
                            </div><?php } ?>
                        <b><?= $dedi->par; ?></b> :
                        <i><?php $dediencode = $dedi->msg;
                            $dedib = html_entity_decode($dediencode);
                            echo $dedib; ?></i>
                    </div>
                <?php } ?>
            </marquee>
        </div>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        $errorv = $_SESSION['error'];
        unset($_SESSION['error']);
        echo $errorv;
    } ?>

    <?php if (isset($_SESSION['username'], $jr) && $jr->rang >= 10) { ?>
        <div class="box-flux" id="webhooks">
            <div class="top">
                <div class="title">Mes Webhooks</div>
            </div>
            <div class="bottom" id="form-webhooks">

                <div class="error-v" style="background-color:#FFC107;margin-top:0;">
                    <b>AVERTISSEMENT :</b> L'URL de votre Webhook doit rester secrète. Ne la donnez pas à n'importe qui.
                </div>
                <?php
                $webhooks = $bdd->prepare('SELECT id,link,name,avatar,role,onoff FROM flux_webhook WHERE id_user = ?');
                $webhooks->execute([$jr->id]);
                if ($webhooks->rowCount() < 3) {
                    ?>
                    <div class="error-v open" id="open-flux-webhook"
                         style="background-color:#1976d2;margin-top:0;<?php if ($webhooks->rowCount() === 0) {
                             echo 'margin-bottom:0;';
                         } ?>">
                        Clique-ici pour
                        connecter ton Webhook Discord au flux de CityWish.
                    </div>
                    <?php
                }
                ?>
                <div>
                    <?php
                while ($webhook = $webhooks->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <form class="list-webhooks">
                        <div class="webname"><?= $webhook->name ?></div>
                        <div class="webhook">
                            <input type="text" style="display: none;" name="id" value="<?= $webhook->id ?>"/>
                            <div class="field">
                                <label>Nom du Webhook :</label>
                                <input type="text" name="name" placeholder="Le nom du Webhook..."
                                       value="<?= $webhook->name ?>"/>
                            </div>
                            <div class="field" style="margin-right: 0;">
                                <label>Lien de l'avatar du Webhook :</label>
                                <input type="text" name="avatar" placeholder="Le lien de l'avatar du Webhook..."
                                       value="<?= $webhook->avatar ?>"/>
                            </div>
                            <div class="field">
                                <label>Lien du Webhook :</label>
                                <input type="text" name="link" placeholder="Le lien du Webhook..."
                                       value="<?= $webhook->link ?>"/>
                            </div>
                            <div class="field" style="margin-right: 0;">
                                <label>Identifiant du rôle à mentionner :</label>
                                <input type="text" name="role" placeholder="L'identifiant du rôle à mentionner..."
                                       value="<?= $webhook->role ?>"/>
                            </div>
                            <div class="field">
                                <label style="display: block;width: 100%;">Statut du Webhook :</label>
                                <select name="onoff">
                                    <option value="1" <?php if($webhook->onoff === 1) { echo 'selected'; }?>>Activé</option>
                                    <option value="0" <?php if($webhook->onoff === 0) { echo 'selected'; }?>>Désactivé</option>
                                </select>
                            </div>
                            <button type="submit" class="submit-btn" value="edit">Enregistrer les modifications</button>
                            <button type="submit" class="submit-btn" value="delete">Supprimer le Webhook</button>
                        </div>
                    </form>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="box-flux" id="flux">
        <div class="top">
            <div class="title">Flux HabboCity</div>
        </div>
        <div class="bottom">
            <div class="subtitle">
                <form id="form-search-flux-hc">
                    <input type="text" name="value-search" class="search" id="search-hc"
                           placeholder="Pseudo à rechercher..."/>
                    <select name="dates" id="search-dates-hc">
                        <option value="0">Toutes les dates</option>
												<optgroup label="2023">
                            <option value="0/2023">2023</option>
                            <option value="01/2023">Janvier 2023</option>
                            <option value="02/2023">Février 2023</option>
                        </optgroup>
												<optgroup label="2022">
                            <option value="0/2022">2022</option>
                            <option value="01/2022">Janvier 2022</option>
                            <option value="02/2022">Février 2022</option>
                            <option value="03/2022">Mars 2022</option>
                            <option value="04/2022">Avril 2022</option>
                            <option value="05/2022">Mai 2022</option>
                            <option value="06/2022">Juin 2022</option>
                            <option value="07/2022">Juillet 2022</option>
                            <option value="08/2022">Août 2022</option>
                            <option value="09/2022">Septembre 2022</option>
                            <option value="10/2022">Octobre 2022</option>
                            <option value="11/2022">Novembre 2022</option>
                            <option value="12/2022">Décembre 2022</option>
                        </optgroup>
												<optgroup label="2021">
                            <option value="0/2021">2021</option>
                            <option value="01/2021">Janvier 2021</option>
                            <option value="02/2021">Février 2021</option>
                            <option value="03/2021">Mars 2021</option>
                            <option value="04/2021">Avril 2021</option>
                            <option value="05/2021">Mai 2021</option>
                            <option value="06/2021">Juin 2021</option>
                            <option value="07/2021">Juillet 2021</option>
                            <option value="08/2021">Août 2021</option>
                            <option value="09/2021">Septembre 2021</option>
                            <option value="10/2021">Octobre 2021</option>
                            <option value="11/2021">Novembre 2021</option>
                            <option value="12/2021">Décembre 2021</option>
                        </optgroup>
                        <optgroup label="2020">
                            <option value="0/2020">2020</option>
                            <option value="01/2020">Janvier 2020</option>
                            <option value="02/2020">Février 2020</option>
                            <option value="03/2020">Mars 2020</option>
                            <option value="04/2020">Avril 2020</option>
                            <option value="05/2020">Mai 2020</option>
                            <option value="06/2020">Juin 2020</option>
                            <option value="07/2020">Juillet 2020</option>
                            <option value="08/2020">Août 2020</option>
                            <option value="09/2020">Septembre 2020</option>
                            <option value="10/2020">Octobre 2020</option>
                            <option value="11/2020">Novembre 2020</option>
                            <option value="12/2020">Décembre 2020</option>
                        </optgroup>
                        <optgroup label="2019">
                            <option value="0/2019">2019</option>
                            <option value="08/2019">Août 2019</option>
                            <option value="09/2019">Septembre 2019</option>
                            <option value="10/2019">Octobre 2019</option>
                            <option value="11/2019">Novembre 2019</option>
                            <option value="12/2019">Décembre 2019</option>
                        </optgroup>
                    </select>
                    <select name="pole" id="search-pole-hc">
                        <option value="0">Tous les pôles</option>
                        <optgroup label="Gestion et Communication">
                            <option value="1">Direction</option>
														<option value="5">Communication</option>
                            <option value="2">Organisation</option>
                        </optgroup>
												<optgroup label="Sécurité et Assistance">
                            <option value="11">Sécurité</option>
                            <option value="12">Assistance</option>
                            <option value="13">Assistance Forum</option>
                            <option value="14">Assistance Discord</option>
                        </optgroup>
												<optgroup label="Animation et Événementiel">
                            <option value="6">Casino</option>
														<option value="8">Animation</option>
														<option value="9">Wired</option>
                            <option value="7">Événementiel</option>
                            <option value="10">Architecture</option>
                        </optgroup>
                        <optgroup label="Création et Développement">
														<option value="4">Créations visuelles</option>
                            <option value="3">Développement</option>
                        </optgroup>
                    </select>
                    <select name="typeflux" id="search-type-hc">
                        <option value="0">Tout</option>
                        <option value="1">Arrivées</option>
                        <option value="2">Départs</option>
                        <option value="3">Changements</option>
                    </select>
                </form>
                <button id="on-hc">Arrivées</button>
                <button id="change-hc">Changements</button>
                <button id="out-hc">Départs</button>
                <button id="all-hc">Tout</button>
            </div>
            <div class="fluxload" id="fluxload-hc">
                <?php
                $flux = $bdd->prepare('SELECT * FROM flux WHERE cw_hc = :hbc ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                $flux->execute(['hbc' => 'hc']);
                if ($flux->rowCount() < 1) {
                    echo '<div class="error-v">Oups, aucun flux n\'a été trouvé.</div>';
                } else {
                    $dateLine = '';
                    while ($fluxinfo = $flux->fetch(PDO::FETCH_OBJ)) {
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
                            if ($dateLine !== $fluxinfo->month . $fluxinfo->year) {
                                $dateLine = $fluxinfo->month . $fluxinfo->year;
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
                                echo '<div class="f-date">' . $months[$fluxinfo->month] . ' ' . $fluxinfo->year . '</div>';
                            }
                        }
                        ?>
                        <a href="https://habbocity.me/profil/<?php echo $pseudo; ?>" target="_blank">
                            <div class="f-user"
                                 style="background: url(https://avatar.citywish.fr/?username=<?php echo $pseudo; ?>&headonly=0) center 30px no-repeat #ededed;">
                                <div class="f-top"
                                     style="background-color:<?php if ($fluxinfo->in_out === 1) {
                                         echo '#2FD27B';
                                     }
                                     if ($fluxinfo->in_out === 2) {
                                         echo '#E74D3D';
                                     }
                                     if ($fluxinfo->in_out === 3) {
                                         echo '#FFC107';
                                     } ?>;">
                                    <?php
                                    if ($fluxinfo->in_out === 1) {
                                        echo 'Arrivée';
                                    }
                                    if ($fluxinfo->in_out === 2) {
                                        echo 'Départ';
                                    }
                                    if ($fluxinfo->in_out === 3) {
                                        echo 'Changement';
                                    }
                                    ?>
                                </div>
                                <div class="f-bottom">
                                    <div class="f-pseudo"><?php echo $pseudo; ?></div>
                                    <?php if ($fluxinfo->in_out === 3) { ?>
                                        <div class="f-oldposte"
                                             style="border-bottom: none;"><?= $fluxinfo->poste; ?></div>
                                        <div class="f-poste"
                                             style="background-color:#2FD27B;border-top:none;"><?= $fluxinfo->newposte; ?></div>
                                    <?php } else { ?>
                                        <div class="f-poste"
                                             style="background-color:<?php if ($fluxinfo->in_out === 1) {
                                                 echo '#2FD27B';
                                             }
                                             if ($fluxinfo->in_out === 2) {
                                                 echo '#E74D3D';
                                             } ?>;"><?= $fluxinfo->poste; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php include_once("assets/templates/footer.php"); ?>
</div>
<?php
if (date('M') === 'Dec') {
    ?>
    <script type="text/javascript" src="assets/js/snowstorm.js"></script>
<?php } ?>
<script type='text/javascript' src='assets/js/slide.js?v=<?= VERSION ?>'></script>
<script type='text/javascript' src='assets/js/flux.js?v=<?= VERSION ?>'></script>
<?php if (isset($erreur)) {
    echo $erreur;
} ?>
</body>

</html>