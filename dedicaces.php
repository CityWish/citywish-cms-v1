<?php
    include('inc/core.php');
    $_GET['page'] = 0;
    $nav_en_cours = 'Dédicaces';
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

        <title><?php echo $Configs['Nom']; ?> :   Dédicaces</title>
    </head>
    <body>

        <?php include_once("assets/templates/header.php"); ?>

        <?php include_once("assets/templates/overlay.php"); ?>

        <?php include_once("assets/templates/loader.php"); ?>

        <?php include_once("assets/templates/top-bottom.php"); ?>

        <div id="container">

              <?php include_once("assets/templates/alerte.php"); ?>

            <div class="dedi">
                <div id="left" style="width: 100px;">
                    <div class="title">
                        dédicaces
                    </div>
                </div>
                <div id="right" style="width: 87.5%;padding: 11px  8px  8px  8px;height: 40px;">
                       <marquee id="scroller" scrollamount="7" direction="left" onmouseover="javascript:scroller.stop()" onmouseout="javascript:scroller.start()">
                        <?php
                        $sql = $bdd->prepare("SELECT * FROM dedi ORDER by id DESC LIMIT 20");
                        $sql->execute();
                        while($dedi = $sql->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <div class="msg">
 <!-- <div class="avat-dedi" style="background-image: url(https://avatar.citywish.fr/?username=Cold&headonly=1&direction=2&head_direction=2)"></div>-->
 <b><?= $dedi->par;?></b> : <i><?php $dediencode = $dedi->msg; $dedib = html_entity_decode($dediencode);echo $dedib; ?></i></i>

                        </div>
                        <?php } ?>
                    </marquee>
                </div>
                </div>

                <?php 
           if(isset($_SESSION['error'])){
             $errorv = $_SESSION['error'];
             unset($_SESSION['error']);
             echo $errorv;
             }?>

            <div class="box">
                <?php if(empty($_SESSION['username'])){?>
                    <div class="error-v" style="margin:0 auto;">
                        Il faut être connecté pour pouvoir envoyer une dédicace !
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['username'])){?>
                <div id="title" align="center"><b>Poster une dédicace</b></div>
              <div id="space" style="height: 20px;"></div>
              <?php if(isset($erreur)){ echo $erreur; } ?>
                <form method="post" action="?do=dedi">
                <label style="font-size: 1.3em;"><b>Ta dédicace :</b> </label> <div id="space" style="height: 5px;"></div><textarea name="dedimsg" placeholder="Message..." class="form-control" style="border-radius:5px;width: 100%;padding: 15px;"></textarea>
              <div id="space" style="height: 25px;"></div>
                <label>  <input type="submit" value="Envoie ta dédicace" style="color: white;width: 100%;padding: 10px;">
                </form>
  <?php } ?>
            </div>
<?php if(isset($_SESSION['username'])){?>
<div id="space" style="height: 15px;"></div>

<div id="right" style="width: 100%;">

            <div class="box">
                <div id="title" align="center">
                    <b>Y a-t-il des règles à respecter pour publier une dédidace</b> ?
                </div>
            <div id="box-content" style="font-size: 16px;color:gray;  line-height:22px;" align="center">Et bien oui, il faut rester respectueux, <b>pas d'insultes</b>, <b>pas de propos racistes</b>,<br /> <b>homophobes ou bien encore sexuels</b>.<br />
            <b>Le spam n'est pas autorisé</b> pour garder l'espace de dédicace <b>propre et fluide</b>.
            <br /> Les dédicaces sont destinées à saluer quelqu'un, il faut donc <b>rester courtois</b> envers cette personne.<br/>Il est aussi <b>interdit de pub</b>.
            <br/>Tout non respect de ces règles se verra <b>suppression<b/> de la dédicace et si répétition, <b>exclusion temporaire du compte concerné</b>.    </div>
            </div>

            </div>
  <?php } ?>
         <?php include_once("assets/templates/footer.php"); ?>
        <div id="clear"></div>
        <div id="space" style="height: 15px;"></div>
</div>

        <?php
        if(date('M') === 'Dec') {
            ?>
            <script type="text/javascript" src="assets/js/snowstorm.js"></script>
        <?php } ?>        <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
    </body>
</html>
