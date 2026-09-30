<?php
include 'inc/core.php';
$_GET['page'] = 0;
$nav_en_cours = 'Vote';
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

        gtag('js', new Date());

        gtag('config', 'UA-134156119-1');
    </script>

    <meta charset='UTF-8'>
    <meta name='viewport'
        content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
    <meta name="theme-color" content="#258dc0" />
    <meta name="keywords"
        content="HabboCity, CityWish, fansite, fansite habbocity, habbocity, habbo, citywish, hcity, habbocity fansite" />
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


    <meta property="og:title" content="CITYWISH - Vote" />
    <meta property="og:type" content="website" />
    <meta name='og:description'
        content="Inscris-toi sur notre site, et participe aux votes hebdomadaires pour déterminer le membre/staff du mois !">
    <meta property="og:url" content="https://citywish.fr/" />
    <meta property='og:image:url' content='https://citywish.fr/assets/imgs/meta.png'>
    <meta property="og:image:alt" content="CityWish" />
    <meta property="og:image:height" content="1024" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="CITYWISH" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@CityWish_FR" />
    <meta name="twitter:title" content="CITYWISH - Vote" />
    <meta name="twitter:description"
        content="Inscris-toi sur notre site, et participe aux votes hebdomadaires pour déterminer le membre/staff du mois !" />
    <meta name="twitter:creator" content="@Cold_FR" />
    <meta name="twitter:image:src" content="https://citywish.fr/assets/imgs/meta.png" />
    <meta name="twitter:image:alt" content="CityWish" />
    <meta name="twitter:domain" content="https://citywish.fr/" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://citywish.fr/fav/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="https://citywish.fr/fav/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://citywish.fr/fav/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="https://citywish.fr/fav/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="https://citywish.fr/fav/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="https://citywish.fr/fav/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://citywish.fr/fav/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="https://citywish.fr/fav/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-128.png" sizes="128x128" />

    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css?v=<?= VERSION ?>" />
    <link type="text/css" rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=<?= VERSION ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css?v=<?= VERSION ?>" />
    <link type="text/css" rel='stylesheet'
        href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet"
        href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

    <title><?php echo $Configs['Nom']; ?> : Votes du mois</title>
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

        <!-- MEMBRES -->
        <div id="vote">
            <div class="members">
                <div class="top" style="background-color:#00BFA5;">
                    <span>Membre du mois</span>
                </div>
                <div class="bottom">
                    <form id="form-search-member">
                        <input type="text" name="value-search" class="search" id="search-member"
                            placeholder="Pseudo à rechercher..." /><br />
                    </form>
                    <div class="alert-vote" id="alert-member"></div>
                    <div class="content-vote" id="content-member">
                        <?php
                    $votesql = $bdd->prepare('SELECT id,name,rang,vote FROM members WHERE rang < :rang AND certif = :certif ORDER BY vote DESC, name ASC LIMIT 24');
                    $votesql->execute(['rang' => 7, 'certif' => 1]);
                    while ($users = $votesql->fetch(PDO::FETCH_OBJ)) {
                        if ($users->vote > 1) {
                            $vote_s = $users->vote . ' votes';
                        } elseif ($users->vote < 2) {
                            $vote_s = $users->vote . ' vote';
                        }
                        ?>
                        <div class="user-v member"
                            style="background-image: url(https://avatar.citywish.fr/?username=<?= $users->name; ?>&headonly=0&direction=3&head_direction=3&gesture=sml)">
                            <div class="header" style="background-color: #00BFA5;">Membre</div>
                            <?php
                            if(isset($_SESSION['username'], $jr)){
                                $stylev = $bdd->prepare('SELECT id_users,id_whovote FROM vote WHERE id_users = ? AND id_whovote = ?');
                                $stylev->execute([$users->id, $jr->id]);
                                if ($stylev->rowCount() < 1) {
                            ?>
                            <div class="footer h-vote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="check-v"></div>
                            </div>
                            <?php
                                } elseif ($stylev->rowCount() > 0) {
                                ?>
                            <div class="footer h-unvote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="uncheck-v"></div>
                            </div>
                            <?php
                                }
                            } else { ?>
                            <div class="footer h-vote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="check-v"></div>
                            </div>
                            <?php }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>

            <!-- STAFFS -->
            <div class="members">
                <div class="top" style="background-color:#FF5252;">
                    <span>Staff du mois</span>
                </div>
                <div class="bottom">
                    <form id="form-search-staff">
                        <input type="text" name="value-search" class="search" id="search-staff"
                            placeholder="Pseudo à rechercher..." /><br />
                    </form>
                    <div class="alert-vote" id="alert-staff"></div>
                    <div class="content-vote" id="content-staff">
                        <?php
                    $votesql = $bdd->prepare('SELECT id,name,rang,vote FROM members WHERE rang > :rang AND certif = :certif ORDER BY vote DESC, name ASC');
                    $votesql->execute(['rang' => 6, 'certif' => 1]);
                    while ($users = $votesql->fetch(PDO::FETCH_OBJ)) {
                        if ($users->vote > 1) {
                            $vote_s = $users->vote . ' votes';
                        } elseif ($users->vote < 2) {
                            $vote_s = $users->vote . ' vote';
                        }
                        ?>
                        <div class="user-v staff"
                            style="background-image: url(https://avatar.citywish.fr/?username=<?= $users->name; ?>&headonly=0&direction=3&head_direction=3&gesture=sml)">
                            <div class="header" style="background-color: #DE2222;">Staff</div>
                            <?php
                            if(isset($_SESSION['username'], $jr)){
                            $stylev = $bdd->prepare('SELECT id_users,id_whovote FROM vote WHERE id_users = ? AND id_whovote = ?');
                            $stylev->execute([$users->id, $jr->id]);
                            if ($stylev->rowCount() < 1) {
                                ?>
                            <div class="footer h-vote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="check-v"></div>
                            </div>
                            <?php
                            } elseif ($stylev->rowCount() > 0) {
                                ?>
                            <div class="footer h-unvote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="uncheck-v"></div>
                            </div>
                            <?php
                            }
                        } else { ?>
                            <div class="footer h-vote">
                                <div class="pseudo"><?= $users->name; ?></div>
                                <div class="votes"><?= $vote_s; ?></div>
                                <div class="check-v"></div>
                            </div>
                            <?php }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['username'], $jr) && $jr->rang === 11) { ?>
        <div class="box" style="margin-top:0;">
            <div id="title">RÉINITIALISER LES VOTES</div>
            <div class="box-content">
                <br>
                <center>
                    <form method="post" action="?do=resetvote">
                        <input type="submit" value="RÉINITIALISER"
                            style="background-color: #FF5252;margin-left:-25px;padding-top:10px;text-align: center;text-transform: uppercase;font-weight: bold;font-size: 12px;color: white;width: 30%;">
                    </form>
                </center>
            </div>
        </div>
        <div class="box">
            <div id="title">METTRE À JOUR LE PSEUDO</div>
            <div class="box-content">
                <br>
                <center>
                    <form method="post" action="?do=setpseudo">
                        <input type="text" name="pseudo-vote" placeholder="Pseudo du membre/staff du mois...">
                        <input type="submit" value="CHANGER"
                            style="margin-top:10px;background-color: #FF5252;margin-left:-25px;padding-top:10px;text-align: center;text-transform: uppercase;font-weight: bold;font-size: 12px;color: white;width: 30%;">
                    </form>
                </center>
            </div>
        </div>
        <?php } ?>
        <?php include_once("assets/templates/footer.php"); ?>
    </div>

    <script src="./assets/js/vote.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <?php
if (date('M') === 'Dec') {
    ?>
    <script type="text/javascript" src="assets/js/snowstorm.js"></script>
    <?php } ?>
    <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
</body>

</html>