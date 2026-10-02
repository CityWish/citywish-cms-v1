<?php
require_once 'inc/core.php';
$_GET['page'] = 0;
$nav_en_cours = 'Profil';

$sql = $bdd->prepare('SELECT * FROM members WHERE name = :name');
$sql->execute(['name' => happySecu($_GET['name'])]);
if ($sql->rowCount() === 0) {
    if (isset($_SESSION['username'])) {
        $_SESSION['error'] = '<div class="error-v">Aucun compte ne correspond à ce pseudo. Nous t\'avons donc redirigé vers ton profil.</div>';
        header('Location: ' . $Configs['Url'] . 'profil/' . $_SESSION['username']);
        exit();
    } else {
        $_SESSION['error'] = '<div class="error-v">Aucun compte ne correspond à ce pseudo.</div>';
        header('Location: ' . $Configs['Url']);
        exit();
    }
}
$member = $sql->fetch(PDO::FETCH_OBJ);
$occurence = new ApiHabboCity($member->name, $apiKey);
if ($occurence->getErreur() !== null) {
}
if (isset($erreur)) {
    echo $erreur;
}
if ($member->hide === 1 && (!isset($_SESSION['username']) || $jr->name !== $member->name)) {
    $_SESSION['error'] = '<div class="error-v">Ce profil n\'est malheureusement pas accessible.</div>';
    header('Location: ' . $Configs['Url']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head profile='https://gmpg.org/xfn/11'>
    <!--[if lt IE 9]>
                <script src="https://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
            <![endif]-->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134156119-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date);
        gtag('config', 'UA-134156119-1');
    </script>

    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, width=device-width" />
    <meta name="theme-color" content="#258dc0" />
    <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity" />
    <meta name="description" content="<?= $Configs['Desc'] ?>" />
    <meta name="identifier-url" content="<?= $Configs['Url'] ?>" />
    <meta name="language" content="fr-FR" />
    <meta name="category" content="Website">
    <meta name="reply-to" content="contact@citywish.fr">
    <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="<?= $Configs['Url'] ?>rss.php" />

    <meta name="title" content="CityWish - Vos souhaits réalisés" />
    <meta name="author" lang="fr" content="Cold" />
    <meta name="subject" content="HabboCity" />
    <meta name="rating" content="general" />
    <meta name="distribution" content="global" />
    <meta name="country" content="France" />
    <meta name="geography" content="France" />
    <meta name="hreflang" content="fr-FR" />

    <meta property="og:title" content="CITYWISH" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $Configs['Desc']; ?>">
    <meta property="og:url" content="<?= $Configs['Url'] ?>" />
    <meta property='og:image:url' content='<?= $Configs['Url'] ?>assets/imgs/meta.png'>
    <meta property="og:image:alt" content="CityWish" />
    <meta property="og:image:height" content="1024" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="CITYWISH" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@CityWish_FR" />
    <meta name="twitter:title" content="CITYWISH" />
    <meta name="twitter:description" content="<?= $Configs['Desc']; ?>" />
    <meta name="twitter:creator" content="@Cold_FR" />
    <meta name="twitter:image:src" content="<?= $Configs['Url'] ?>assets/imgs/meta.png" />
    <meta name="twitter:image:alt" content="CityWish" />
    <meta name="twitter:domain" content="<?= $Configs['Url'] ?>" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-128.png" sizes="128x128" />

    <link rel="stylesheet" type="text/css" href="<?= $Configs['Web'] ?>style/global.css?v=<?= VERSION ?>" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $Configs['Web'] ?>style/header.css?v=<?= VERSION ?>" />
    <link rel="stylesheet" type="text/css" href="<?= $Configs['Web'] ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css" />

    <title><?= $Configs['Nom']; ?> : Profil : <?php if(isset($_SESSION['username'])){ if($_GET['name'] !== $_SESSION['username']){ echo $_GET['name'];}else{ echo 'Moi';}}else{ echo $_GET['name'];}?></title>

    <script src="<?= $Configs['Web'] ?>js/jquery-latest.js"></script>
    <script src="<?= $Configs['Web'] ?>js/jquery-ui/jquery-ui.js"></script>
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>
    <?php require_once 'assets/templates/overlay.php' ?>
    <?php require_once 'assets/templates/loader.php' ?>
    <?php require_once 'assets/templates/top-bottom.php' ?>
    <?php require_once 'assets/templates/announcement.php' ?>
    <div id="container">
        <?php require_once 'assets/templates/alerte.php' ?>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <div class="box">
            <div class="profil">
                <div id="left">
                    <div class="avatar">
                        <?php if ($occurence->getErreur() === null) { ?>
                            <div style="margin-top: 0px; margin-left: auto; margin-right: auto; background-image: url(https://avatar.citywish.fr/?username=<?= $member->name ?>&headonly=1&direction=2&head_direction=3&gesture=sml&size=l); background-repeat: no-repeat; background-position: 70% 30%; height: 165px; width: 120px; border-radius: 5px;<?php if ($member->genre === 'F') { ?>filter:drop-shadow(2px 0px 0 #B11B5C) drop-shadow(-2px 0px 0 #B11B5C) drop-shadow(0px -2px 0 #B11B5C) drop-shadow(0px 2px 0 #B11B5C);<?php } else { ?>filter:drop-shadow(2px 0px 0 #1976d2) drop-shadow(-2px 0px 0 #1976d2) drop-shadow(0px -2px 0 #1976d2) drop-shadow(0px 2px 0 #1976d2);<?php } ?>"></div>
                        <?php } elseif ($occurence->getErreur() !== null) { ?>
                            <img src="/assets/imgs/error.png" class="error" style="margin-left: 23px;margin-top: 13px;">
                        <?php } ?>
                    </div>
                    <div class="pseudo">
                        <?= $member->name ?>
                    </div>
                    <div class="fonction">
                        <?= html_entity_decode($member->fonction);?>
                        <?php if ($member->stats_staff !== 0 && $member->stats_staff !== 1) { ?>
                            <b style="color: whitesmoke;">[EN TEST]</b>
                        <?php } ?>
                    </div>
                    <div class="moto">
                        "<i><?= html_entity_decode(strip_tags($member->moto)) ?></i>"
                    </div>
                </div>
            </div>
            <div class="money">
                <li class="btn" style="background-color: #FFA000; border-radius: 0px 0px 0px 5px;">
                    <img src="/assets/imgs/coins.png" style="margin-left: -3px;margin-right: 5px;" /><b><?= $member->jetons ?></b> jetons
                </li>
                <li class="btn" style="background-color:#009688;">
                    <img src="/assets/imgs/trophy.png" style="margin-left: -2px;margin-right: 5px" /><b><?= $member->activ_p_s ?></b> points
                </li>
                <li class="btn" style="background-color: #F44336;border-radius: 0px 0px 5px 0px;">
                    <img src="/assets/imgs/hc.png" style="margin-left: -15px;margin-right: 5px" /><b>???</b> mois
                </li>
            </div>
            <div id="title" style="width: 50%; margin-top: 15px;">
                Les badges de <?= $member->name ?> <div id="right"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
            </div>
            <div class="box-content">
                <?php if ($occurence->getErreur() === null) {
                    foreach ((array) $occurence->getListBadge() as $badge) { ?>
                        <div class="badgep" data-toggle="tooltip" data-placement="top" title="<?= $badge['code'] ?>" style="margin-top: 7px;">
                            <img alt="<?= $badge['code'] ?>" style="height: auto; width: auto; padding: 7px;" src="https://swf.habbocity.me/c_images/album1584/<?= $badge['code'] ?>.gif" />
                        </div>
                    <?php } ?>
                <?php } elseif ($occurence->getErreur() !== null) { ?>
                    <div class="coo" style="margin-top: 10px; padding: 7px; text-align: center; border-radius: 5px; color: #fff; width: 50%;">
                        Erreur : API d\'HabboCity indisponible.
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if (isset($_SESSION['username']) && $jr->rang >= 6) { ?>
            <div class="action-history">
                <div class="ah-content">
                    <div class="top">Mon historique</div>
                    <div class="bottom">
                        <div class="mini-title">
                            Mes commentaires
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php require_once 'assets/templates/footer.php'; ?>
    </div>
    <?php
    if(date('M') === 'Dec') {
        ?>
        <script type="text/javascript" src="assets/js/snowstorm.js"></script>
    <?php } ?>
    <script type="text/javascript" src="../assets/js/slide.js?v=<?= VERSION ?>"></script>
</body>

</html>
