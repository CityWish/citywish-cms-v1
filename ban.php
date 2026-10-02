<?php

  require_once './inc/bdd.php';

  $nobanip = $bdd->prepare('SELECT * FROM banip WHERE ip = :ip');
  $nobanip->execute(['ip' => $_SERVER['REMOTE_ADDR']]);
  if($nobanip->rowCount() < 1){
      header('Location: index');
      exit();
  }

  if(isset($_SESSION['username'])){
      $nobanid = $bdd->prepare('SELECT * FROM banip WHERE id = :id');
      $info = $bdd->prepare('SELECT * FROM members WHERE name = :username');
      $info->execute(['name' => $_SESSION['username']]);
      if($info->rowCount() < 0){
      $jr = $info->fetch(PDO::FETCH_OBJ);
      $nobanid->execute(['id' => $jr->id]);
      if($nobanid->rowCount() < 1){
          header('Location: index');
          exit();
      }
    }
      $nobanpseudo = $bdd->prepare('SELECT * FROM banip WHERE pseudo = :pseudo');
      $nobanpseudo->execute(['pseudo' => $_SESSION['username']]);
      if($nobanpseudo->rowCount() < 1){
          header('Location: index');
          exit();
      }
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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134156119-1');
</script>

        <meta charset='UTF-8'>
        <meta name='viewport' content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
        <meta name="theme-color" content="#258dc0" />
        <meta name="language" content="fr-FR" />
        <meta name="reply-to" content="contact@citywish.fr">
        <meta name="author" lang="fr" content="Cold" />
        <meta name="country" content="France" />
        <meta name="geography" content="France" />
        <meta name="hreflang" content="fr-FR" />
        <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="<?= $Configs['Url'] ?>rss.php" />


        <meta property="og:title" content="CITYWISH" />
        <meta property="og:type" content="website" />
        <meta name='og:description' content="CITYWISH est un site-fan officiel du rétro-serveur HabboCity ! Tu pourras y retrouver toute l'actualité d'HabboCity, ainsi que des jeux, des tutoriels et des concours inédits !">
        <meta property="og:url" content="<?= $Configs['Url'] ?>" />
        <meta property='og:image:url' content='<?= $Configs['Url'] ?>assets/imgs/meta.png'>
        <meta property="og:image:alt" content="CityWish" />
        <meta property="og:image:height" content="1024" />
        <meta property="og:image:width" content="1024" />
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:site_name" content="CITYWISH" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@CityWish_FR" />
        <meta name="twitter:title" content="CITYWISH" />
        <meta name="twitter:description" content="CITYWISH est un site-fan officiel du rétro-serveur HabboCity ! Tu pourras y retrouver toute l'actualité d'HabboCity, ainsi que des jeux, des tutoriels et des concours inédits !" />
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

            <link type="text/css" rel="stylesheet" href="<?= $Configs['Url'] ?>assets/style/global.css?v=<?= VERSION ?>" />
            <link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=<?= VERSION ?>">
            <link type="text/css" rel="stylesheet" href="<?= $Configs['Url'] ?>assets/style/header.css?v=<?= VERSION ?>" />
            <link type="text/css" rel='stylesheet' href='<?= $Configs['Url'] ?>assets/icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>'>
            <link  rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link type="text/css" rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>">

       <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
       <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

        <title>CITYWISH : Banni(e)</title>
    </head>
    <body>

    <?php include_once("assets/templates/loader.php"); ?>

        <div id="container" style="padding: auto;">

            <div class="box">

                <div id="title" style="text-align:center;">
                Tu es banni(e)
                </div>

            <div id="box-content" style="text-align:center;">
            <?php 
            if(isset($_SESSION['username'])){
            $why = $bdd->prepare('SELECT * FROM banip WHERE pseudo = :pseudo');
            $why->execute(['pseudo' => $_SESSION['username']]);
            if($why->rowCount() > 0){
                $reason = $why->fetch(PDO::FETCH_OBJ);
                if($reason->why !== ""){
                echo $reason->why;
                }else{
                    echo 'Aucune raison n\'a été spécifiée.';
                }            
            }
            }else{
                $why = $bdd->prepare('SELECT * FROM banip WHERE ip = :ip');
                $why->execute(['ip' => $_SERVER['REMOTE_ADDR']]);
                if($why->rowCount() > 0){
                    $reason = $why->fetch(PDO::FETCH_OBJ);
                    if($reason->why !== ""){
                    echo $reason->why;
                    }else{
                        echo 'Aucune raison n\'a été spécifiée.';
                    }
                }    
            }
            ?>
            </div>


            </div>


        </div>
    <?php
    if(date('M') === 'Dec') {
        ?>
        <script type="text/javascript" src="assets/js/snowstorm.js"></script>
    <?php } ?>
    <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
    </body>
</html>
