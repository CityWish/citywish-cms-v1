<?php
    include('inc/core.php');
    $_GET['page'] = 0;
    $nav_en_cours = 'Security';
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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
 
  gtag('config', 'UA-134156119-1');
</script>

        <meta charset='UTF-8'>
        <meta name='viewport' content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
        <meta name="theme-color" content="#258dc0" />
        <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity" />
        <meta name="description" content="<?php echo $Configs['Desc']; ?>" />
        <meta name="identifier-url" content="https://citywish.fr/" />
        <meta name="language" content="fr-FR" />
        <meta name="category" content="Website">
        <meta name="reply-to" content="contact@citywish.fr">
        <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="https://citywish.fr/rss.php" />

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
        <meta name='og:description' content="<?php echo $Configs['Desc']; ?>">
        <meta property="og:url" content="https://citywish.fr/" />
        <meta property='og:image:url' content='https://citywish.fr/assets/imgs/meta.png'>
        <meta property="og:image:alt" content="CityWish" />
        <meta property="og:image:height" content="1024" />
        <meta property="og:image:width" content="1024" />
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:site_name" content="CITYWISH" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@CityWish_FR" />
        <meta name="twitter:title" content="CITYWISH" />
        <meta name="twitter:description" content="<?php echo $Configs['Desc']; ?>" />
        <meta name="twitter:creator" content="@Cold_FR" />
        <meta name="twitter:image:src" content="https://citywish.fr/assets/imgs/meta.png" />
        <meta name="twitter:image:alt" content="CityWish" />
        <meta name="twitter:domain" content="https://citywish.fr/" />

            <link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://citywish.fr/fav/apple-touch-icon-57x57.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://citywish.fr/fav/apple-touch-icon-114x114.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://citywish.fr/fav/apple-touch-icon-72x72.png" />
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://citywish.fr/fav/apple-touch-icon-144x144.png" />
            <link rel="apple-touch-icon-precomposed" sizes="60x60" href="https://citywish.fr/fav/apple-touch-icon-60x60.png" />
            <link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://citywish.fr/fav/apple-touch-icon-120x120.png" />
            <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://citywish.fr/fav/apple-touch-icon-76x76.png" />
            <link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://citywish.fr/fav/apple-touch-icon-152x152.png" />
            <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-196x196.png" sizes="196x196" />
            <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-96x96.png" sizes="96x96" />
            <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-32x32.png" sizes="32x32" />
            <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-16x16.png" sizes="16x16" />
            <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-128.png" sizes="128x128" />

            <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css?v=<?= VERSION ?>" />
            <link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=<?= VERSION ?>">
            <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css?v=<?= VERSION ?>" />
            <link type="text/css" rel='stylesheet' href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>'>
            <link  rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link type="text/css" rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>">

       <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
       <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

        <title><?php echo $Configs['Nom']; ?> : Sécurité</title>
    </head>
    <body>

        <?php include_once("assets/templates/header.php"); ?>

        <?php include_once("assets/templates/overlay.php"); ?>

        <?php include_once("assets/templates/loader.php"); ?>

        <?php include_once("assets/templates/top-bottom.php"); ?>

        <div id="container">
            <?php include_once("assets/templates/alerte.php"); ?>

            <div id="left" style="width: 390px;margin-right: 15px;">
                <div class="box">
                    <div id="title">PROTÈGE TES INFORMATIONS PERSONNELLES !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Tu ne sais jamais avec qui tu es vraiment en train de parler en ligne, donc ne donne jamais ton vrai nom, adresse, numéro de téléphone, photos ou nom de ton école. Partager ces informations personnelles peut te conduire à être victime d'une arnaque, d'intimidation ou de te mettre en danger.
                    </div>
                </div>
                <div class="box">
                    <div id="title">NE CÈDE PAS À LA PRESSION DES AUTRES !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Que tout le monde fasse quelque chose n'est pas une raison pour toi de le faire si tu n'es pas à l'aise avec cette idée.
                    </div>
                </div>
                <div class="box">
                    <div id="title">LAISSE TOMBER LES IMAGES !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Tu n'as aucun contrôle sur tes photos et images webcam une fois que tu les as partagées sur Internet, tu ne peux plus les récupérer. Elles peuvent être partagées avec n'importe qui, n'importe où et être utilisées pour t'intimider, te faire du chantage ou te menacer. Avant de publier une photo, demande-toi si tu es à l'aise pour que des gens que tu ne connais pas la voient.
                    </div>
                </div>
            </div>

            <div id="right" style="width:395px;">
                <div class="box">
                    <div id="title">N'AIES PAS PEUR DE DIRE LES CHOSES !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Si quelqu'un te met mal à l'aise ou te fait peur avec des menaces dans HabboCity, signale-le immédiatement à l'équipe de modération du rétro en utilisant le bouton d'alerte.
                    </div>
                </div>
                <div class="box">
                    <div id="title">GARDE TES COPAINS EN PIXELS !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Ne jamais rencontrer des personnes que tu connais uniquement via internet, les gens ne sont pas toujours ceux qu'ils prétendent être ! Si quelqu'un te demande de le/la rencontrer dans la vraie vie, il vaut mieux dire "Non merci !", cliquer sur "Ignorer" et en parler à tes parents ou un autre adulte de confiance.
                    </div>
                </div>
                <div class="box">
                    <div id="title">SOIS UN SURFEUR INTELLIGENT !</div>
                    <div class="box-content" style="margin-top: 15px;">
                        Les sites Web qui vous offrent des crédits gratuits, des mobis, ou qui font semblant d'être de nouveaux sites HabboCity Hôtel ou des pages du personnel HabboCity sont tous des escroqueries dans le but de voler ton mot de passe. Ne leur donne pas tes coordonnées et ne télécharge jamais des fichiers depuis ces sites, car ils pourraient être des logiciels espions ou des virus
                        <i>(les seuls sites envers qui vous pouvez faire confiance, ce sont les fansites, de préférence officiel, d'HabboCity, même si par prudence ne mettez jamais le même mot de passe que votre compte HabboCity sur ces sites) !
                    </div>
                </div>
            </div>

            <?php include_once("assets/templates/footer.php"); ?>
        </div>
        <?php
        if(date('M') === 'Dec') {
            ?>
            <script type="text/javascript" src="assets/js/snowstorm.js"></script>
        <?php } ?>        <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
    </body>
</html>
