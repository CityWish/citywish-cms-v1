<?php
include('inc/core.php');
$_GET['page'] = 0;
$nav_en_cours = 'Articles';
?>
<!DOCTYPE html>
<html lang="fr">
<head profile='http://gmpg.org/xfn/11'>
    <!--[if lt IE 9]>
    <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
    <![endif]-->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134156119-1"></script>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
    <meta name="theme-color" content="#258dc0"/>
    <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity"/>
    <meta name="description" content="<?php echo $Configs['Desc']; ?>"/>
    <meta name="identifier-url" content="https://citywish.fr/"/>
    <meta name="language" content="fr-FR"/>
    <meta name="category" content="Website">
    <meta name="reply-to" content="contact@citywish.fr">
    <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="https://citywish.fr/rss.php"/>

    <meta name="title" content="CityWish - Vos souhaits réalisés"/>
    <meta name="author" lang="fr" content="Cold"/>
    <meta name="subject" content="HabboCity"/>
    <meta name="rating" content="general"/>
    <meta name="distribution" content="global"/>
    <meta name="country" content="France"/>
    <meta name="geography" content="France"/>
    <meta name="hreflang" content="fr-FR"/>


    <meta property="og:title" content="CITYWISH"/>
    <meta property="og:type" content="website"/>
    <meta name='og:description' content="<?php echo $Configs['Desc']; ?>">
    <meta property="og:url" content="https://citywish.fr/"/>
    <meta property='og:image:url' content='https://citywish.fr/assets/imgs/meta.png'>
    <meta property="og:image:alt" content="CityWish"/>
    <meta property="og:image:height" content="1024"/>
    <meta property="og:image:width" content="1024"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta property="og:site_name" content="CITYWISH"/>

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@CityWish_FR"/>
    <meta name="twitter:title" content="CITYWISH"/>
    <meta name="twitter:description" content="<?php echo $Configs['Desc']; ?>"/>
    <meta name="twitter:creator" content="@Cold_FR"/>
    <meta name="twitter:image:src" content="https://citywish.fr/assets/imgs/meta.png"/>
    <meta name="twitter:image:alt" content="CityWish"/>
    <meta name="twitter:domain" content="https://citywish.fr/"/>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://citywish.fr/fav/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="https://citywish.fr/fav/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://citywish.fr/fav/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="https://citywish.fr/fav/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="https://citywish.fr/fav/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="https://citywish.fr/fav/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://citywish.fr/fav/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="https://citywish.fr/fav/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-128.png" sizes="128x128"/>

    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css?v=<?= VERSION; ?>"/>
    <link type="text/css" rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=<?= VERSION; ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css?v=<?= VERSION ?>"/>
    <link type="text/css" rel='stylesheet'
          href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION; ?>'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet"
          href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION; ?>">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

    <title><?php echo $Configs['Nom']; ?> : Articles</title>

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
            <marquee id="scroller" scrollamount="7" direction="left" onmouseover="javascript:scroller.stop()"
                     onmouseout="javascript:scroller.start()">
                <?php
                $sql = $bdd->prepare("SELECT * FROM dedi ORDER by id DESC LIMIT 20");
                $sql->execute();
                while ($dedi = $sql->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <div class="msg">
                        <!-- <div class="avat-dedi" style="background-image: url(https://avatar.citywish.fr/?username=Cold&headonly=1&direction=2&head_direction=2)"></div>-->
                        <b><?= $dedi->par; ?></b> : <i><?php $dediencode = $dedi->msg;
                            $dedib = html_entity_decode($dediencode);
                            echo $dedib; ?></i></i>

                    </div>
                <?php } ?>
            </marquee>
        </div>
    </div>

    <div id="left" style="width: 520px;margin-right: 15px;">
        <?php
        $sql = $bdd->prepare('SELECT id,titre,descp,categorie,background FROM news WHERE supprimer = 0 AND valid = 1 ORDER BY dates DESC LIMIT 20');
        $sql->execute();

        while ($news = $sql->fetch(PDO::FETCH_OBJ)) {
        ?>
        <a href="news?id=<?= $news->id; ?>">
            <div class="article" style='background-image: url("<?= $news->background; ?>");'>
                <div id="fond">
                    <div class="views-news">
                        <i class="fa fa-eye" aria-hidden="true"></i> <?php echo NbViewNews($news->id); ?>
                    </div>
                    <div class="coms">
                        <i class="fa fa-comments" aria-hidden="true"></i> <?php echo NbComment($news->id); ?>
                    </div>
                    <div class="footer">
                        <div class="title">
                            <?= $news->categorie; ?> : <?php $newstitlecode = $news->titre;
                            $ntitleb = html_entity_decode($newstitlecode);
                            echo $ntitleb; ?>
                        </div>
                        <div class="descp">
                            <?php $descpnewscode = $news->descp;
                            $descpnewsb = html_entity_decode($descpnewscode);
                            echo $descpnewsb; ?>
                        </div>
                        <div class="suite">
                            Lire la suite
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <?php }?>
    </div>
    <div id="right" style="margin-top: 15px;width: 265px;">
        <div class="fb">
            <a href="https://discord.gg/DN2AKUm" target="_blank" rel="external noopener nofollow">
                <div id="fond">
                    REJOINS
                    -
                    NOUS
                    <br/>
                    <br/>
                    SUR NOTRE
                    <br/>
                    <br/>
                    SERVEUR DISCORD
                </div>
            </a>
        </div>
    </div>

    <?php include_once("assets/templates/footer.php"); ?>
</div>
<?php
if(date('M') === 'Dec') {
?>
<script type="text/javascript" src="assets/js/snowstorm.js"></script>
<?php } ?>
<script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION; ?>"></script>
<script type="text/javascript" src="assets/js/articles.js?v=<?= VERSION; ?>"></script>
</body>
</html>
