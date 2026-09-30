<?php 
require_once 'inc/bdd.php';


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
       <meta name="theme-color" content="#1976d2" />
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

           <link rel="stylesheet" type="text/css" href="./assets/style/maintenance.css?v=<?= VERSION ?>"/>

       <title>CITYWISH : Maintenance</title>
   </head>
   <body>
       <?php include './assets/templates/loader.php'; ?>

       <div id="logo-a"></div>
       <div class="container">
           <div class="box">
               <div class="top">Maintenance</div>
               <div class="content">
                   Notre site internet est actuellement en maintenance. Notre équipe de développeur travaille d'arrache-pied dans l'objectif de rendre votre expérience sur notre site internet la meilleure possible. Nous revenons très vite !          
               </div>
           </div>
           <footer>
               <div class="title"><b>CITYWISH</b> - V.1.2 © 2017 - <?= date('Y') ?> </div>
               <div class="content-f">
                   <b>CITYWISH</b> est un projet indépendant, à but <b>non-lucratif</b>, anciennement par <b>LOXI-</b> repris par <b>Cold</b>.
                   CMS réalisé par <b>Neal</b> et <b>Cold</b>, <b>copie interdite</b> !
               </div>
           </footer>
       </div>

   <script src="./assets/js/maintenance.js?v=<?= VERSION ?>" type="text/javascript"></script>
   </body>
</html>
