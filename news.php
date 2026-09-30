<?php
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ 
    $url = "https"; 
  }else{
    $url = "http"; 
  }
  $url .= "://"; 
  $url .= $_SERVER['HTTP_HOST']; 
  $url .= $_SERVER['REQUEST_URI']; 

    include('inc/core.php');
    $_GET['page'] = 0;
    $nav_en_cours = 'Articles';
    if(empty($_GET['id'])){
        header("Location: index.php");
    }elseif(isset($_GET['id'])){
    $sql = $bdd->prepare("SELECT * FROM news WHERE id = ? AND supprimer = ? AND valid = ?");
    $sql->execute(array(happySecu($_GET['id']),0,1));
    if($sql->rowCount() < 1){
        header("Location: index");
    }
    while($news = $sql->fetch(PDO::FETCH_OBJ)){

$sqla = $bdd->prepare("SELECT * FROM members WHERE id = :name LIMIT 1");
$sqla->execute(['name' => $news->par]);
if($sqla->rowCount() < 1){
    header("Location: index");
}
  while ($author = $sqla->fetch(PDO::FETCH_OBJ)){

SetView($news->id);

// Commentaire
if(isset($_GET['do']) && $_GET['do'] === 'comment') {
    if(isset($_SESSION['username'])){
        if(!empty($_POST['commentaire'])){
            $commentaire = happySecu($_POST['commentaire']);
            if(strlen($commentaire) >= 3){
                $verif = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = :id AND commentaire = :com AND par = :jr LIMIT 1');
                $verif->execute(['id' => $_GET['id'], 'com' => $commentaire, 'jr' => $jr->id]);
                if($verif->rowCount() < 1){
                    $sql = $bdd->prepare('INSERT INTO commentaires(id_article, commentaire, par, dates) VALUES (?,?,?,?)');
                    $sql->execute([$_GET['id'], $commentaire, $jr->id, date('d-m-Y')]);
                    $sqlcoins = $bdd->prepare('UPDATE members SET jetons = jetons + 3  WHERE id = :id');
                    $sqlcoins->execute(['id' => $jr->id]);
                    $_SESSION['error'] = '<div class="error-v" style="margin-bottom: 0;background-color: #28b463;">Ton commentaire a bien été posté.</div>';
                    header('Location: news.php?id='.$_GET['id']);
                    exit();
                } else {
                    $_SESSION['error'] = '<div class="error-v" style="margin-bottom: 0;">Le commentaire que tu essayes de poster est identique à l\'un de tes commentaires sur cet article.</div>';
                    header("Location: news.php?id=".$_GET['id']);
                    exit();    
                }
            } else {
                $_SESSION['error'] = '<div class="error-v" style="margin-bottom: 0;">Le commentaire que tu essayes de poster est trop court (minimum plus de 3 caractères requis).</div>';
                header("Location: news.php?id=".$_GET['id']);
                exit();    
            }
        } else {
            $_SESSION['error'] = '<div class="error-v" style="margin-bottom: 0;">Le commentaire que tu essayes de poster est vide.</div>';
            header("Location: news.php?id=".$_GET['id']);
            exit();    
        }
    } else {
        $_SESSION['error'] = '<div class="error-v" style="margin-bottom: 0;">Il faut être connecté pour pouvoir poster un commentaire.</div>';
        header("Location: news.php?id=".$_GET['id']);
        exit();    
    }
}

  /*  // Supprimer un commentaire
    if(isset($_SESSION['username'])){
        if($jr->rang > 5){
            if(isset($_GET['sup'])){
                $sql = $bdd->prepare("SELECT * FROM commentaires where id = ?");
                $sql->execute(array(happySecu($_GET['id'])));
                if($sql->rowCount() < 1){
                    header("Location: news.php);
                    exit();
                } else{
                  $logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
                  $logsql->execute(array("À supprimé le commentaire de $comment->par",$jr->name,date('d-m-Y H:i:s')));
                    $sql = $bdd->prepare("DELETE FROM commentaires where id = :id");
                    $sql->bindValue("id", happySecu($_GET['id']), PDO::PARAM_INT);
                    $sql->execute();
                    header("Location: news.php?id=".$_GET['id']);
                    exit();
                }
            }
        }
    }*/
?>
<!DOCTYPE html>
<html lang="fr">

<head profile='https://gmpg.org/xfn/11'>
    <!--[if lt IE 9]>
            <script src="https://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
        <![endif]-->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134156119-1"></script>

    <meta charset='UTF-8'>
    <meta name='viewport'
        content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
    <meta name="theme-color" content="#258dc0" />
    <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity" />
    <meta name="description"
        content="<?php $descpnewscode = $news->descp; $descpnewsb = html_entity_decode($descpnewscode);echo $descpnewsb; ?>" />
    <meta name="identifier-url" content="https://citywish.fr/" />
    <meta name="language" content="fr-FR" />
    <meta name="category" content="Website">
    <meta name="reply-to" content="contact@citywish.fr">
    <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="https://citywish.fr/rss.php" />

    <meta name="title"
        content="CityWish - <?php $newstitlecode = $news->titre; $ntitleb = html_entity_decode($newstitlecode);echo $ntitleb; ?>" />
    <meta name="author" lang="fr" content="Cold" />
    <meta name="subject" content="HabboCity" />
    <meta name="rating" content="general" />
    <meta name="distribution" content="global" />
    <meta name="country" content="France" />
    <meta name="geography" content="France" />
    <meta name="hreflang" content="fr-FR" />

    <?php 
      $title = html_entity_decode($news->categorie);
      $title .= ' : '.html_entity_decode($news->titre);
        ?>

    <meta property="og:title" content="<?= $title;?>" />
    <meta property="og:type" content="website" />
    <meta property='og:description' content="<?= html_entity_decode($news->descp);?>" />
    <meta property="og:url" content="<?= $url;?>" />
    <meta property='og:image' content='<?= $news->background;?>' />
    <meta property="og:image:secure_url" content="<?= $news->background;?>" />
    <meta property="og:image:alt" content="<?= $title;?>" />
    <meta property="og:image:height" content="200" />
    <meta property="og:image:width" content="520" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="CITYWISH" />
    <meta property="og:type" content="article" />
    <meta property="article:publisher" content="https://twitter.com/CityWish_FR" />
    <meta property="article:author" content="https://citywish.fr/profil/<?= $author->name;?>" />
    <meta property="article:published_time" content="2020-04-08T13:00:41+02:00" />
    <meta property="article:section" content="HabboCity" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@CityWish_FR" />
    <meta name="twitter:title" content="<?= $title;?>" />
    <meta name="twitter:description" content="<?= html_entity_decode($news->descp);?>" />
    <meta name="twitter:creator" content="@CityWish_FR" />
    <meta name="twitter:image:src" content="<?= $news->background;?>" />
    <meta name="twitter:image:alt" content="<?= $title;?>" />
    <meta name="twitter:domain" content="https://citywish.fr/" />
    <meta name="twitter:dnt" content="on" />

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

    <link type="text/css" rel="stylesheet"
        href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css?v=<?= VERSION ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css?v=<?= VERSION ?>" />
    <link type="text/css" rel='stylesheet'
        href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>'>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="./assets/js/jquery-ui/jquery-ui.js"></script>

    <title><?php echo $Configs['Nom']; ?> :
        <?php $newstitlecode = $news->titre; $ntitleb = html_entity_decode($newstitlecode);echo $ntitleb; ?></title>
</head>

<body>

    <?php include_once("assets/templates/header.php"); ?>

    <?php include_once("assets/templates/overlay.php"); ?>

    <?php include_once("assets/templates/loader.php"); ?>

    <?php include_once("assets/templates/top-bottom.php"); ?>

    <div id="container">
        <?php include_once("assets/templates/alerte.php"); ?>

        <?php 
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>

        <div class="box">
            <div class="news">
                <div class="une" style='background-image: url("<?= $news->background;?>");'>
                    <div id="fond">
                        <div class="views-news">
                            <i class="fa fa-eye" aria-hidden="true"></i> <?php echo NbViewNews($news->id);?>
                        </div>
                        <div class="coms">
                            <i class="fa fa-comments" aria-hidden="true"></i> <?php echo NbComment($news->id);?>
                        </div>
                        <div class="footer">
                            <div class="title">
                                <?= $news->categorie;?> :
                                <?php $newstitlecode = $news->titre; $ntitleb = html_entity_decode($newstitlecode);echo $ntitleb; ?>
                            </div>
                            <div class="descp">
                                <?php $descpnewscode = $news->descp; $descpnewsb = html_entity_decode($descpnewscode);echo $descpnewsb; ?>
                            </div>
                            <div class="par">
                                <?php 
                                $date = explode('-', date('d-m-Y', $news->dates), 3);
                                $months = [
                                '',
                                'janvier',
                                'février',
                                'mars',
                                'avril',
                                'mai',
                                'juin',
                                'juillet',
                                'août',
                                'septembre',
                                'octobre',
                                'novembre',
                                'décembre'
                                ];
                                if(intval($date[1]) < 10) {
                                    $month = intval(str_replace('0', '', $date[1]));
                                } else {
                                    $month = intval($date[1]);
                                }
                                $day = $date[0];
                                ?>
                                <i class="fa fa-history" aria-hidden="true"></i> Posté le <b><?= $day.' '.$months[$month].' '.$date[2]; ?></b> par
                                <a href="<?php echo $Configs['Url']; ?>profil/<?= $author->name;?>"
                                    style="color: white;"><b><?= $author->name;?></b></a> dans la catégorie
                                <b><?= $news->categorie;?></b>.
                            </div>
                        </div>
                    </div>
                </div>
                <?= $news->body;?>
                <div class="sign">
                    <div id="left">
                        <a href="<?php echo $Configs['Url']; ?>profil/<?= $author->name;?>">
                            <div class="pseudo">
                                <b><?= $author->name;?></b>
                            </div>
                        </a>
                        <div class="fonction">
                            <i>
                                <?php echo html_entity_decode($author->fonction);
                                if ($author->stats_staff != 0) { 
                                    if ($author->stats_staff != 1) { 
                                        echo "<b style='color:gray;'>[EN TEST]</b>";
                                        } 
                                        else{
                                            if($author->genre == 'M' OR $author->genre == null){
                                            echo " officiel";
                                            }elseif($author->genre == 'F'){
                                                echo " officielle";
                                            }
                                            } 
                                            } 
                                            ?>
                                de <?php echo $Configs['Nom']; ?>
                            </i>
                        </div>
                    </div>
                    <div id="right">
                        <?php
                            if($author->genre == 'M' OR $author->genre == null){
                                $color = '#1976d2';
                            }elseif($author->genre == 'F'){
                                $color = '#B11B5C';
                            } 
                            ?>
                        <div class="img"
                            style="background: url(https://avatar.citywish.fr/?username=<?php echo $author->name;?>&size=n&headonly=1&head_direction=4&gesture=sml) no-repeat center -5px;filter: drop-shadow(1px 0 0 <?php echo $color;?>) drop-shadow(-1px 0 0 <?php echo $color;?>) drop-shadow(0 1px 0 <?php echo $color;?>) drop-shadow(0 -1px 0 <?php echo $color;?>);">
                        </div>
                    </div>
                </div>
            </div>
            <?php }}} ?>
        </div>

        <div class="send-coms">
            <div class="top">Poster un commentaire</div>
            <div class="bottom">
                <?php if(!isset($_SESSION['username'])){?>
                <div class="error-v">Il faut être connecté pour pouvoir poster un commentaire.</div>
                <?php }elseif($_SESSION['username']){?>
                <form method="post" action="?id=<?= $_GET['id'];?>&do=comment">
                    <textarea name="commentaire" placeholder="Votre commentaire..."></textarea>
                    <input type="submit" value="Envoyer" />
                </form>
                <?php }?>
            </div>
        </div>
        <div class="box" style="padding-top:10px;">
            <?php
                    $sql2 = $bdd->prepare("SELECT * FROM commentaires WHERE id_article = :id_a ORDER BY id DESC");
                    $sql2->execute(['id_a' => $_GET['id']]);
                    while ($comment = $sql2->fetch(PDO::FETCH_OBJ)) {
                        $sql_a = $bdd->prepare('SELECT name, rang FROM members WHERE id = :id');
                        $sql_a->execute(['id' => $comment->par]);
                        while ($com_author = $sql_a->fetch(PDO::FETCH_OBJ)) {
                            ?>
            <a href="<?php echo $Configs['Url']; ?>profil.php?name=<?= $com_author->name; ?>" style="color: #444;">
                <div class="com">
                    <div id="left" style="width: 70%;">
                        <div class="avatar"
                            style="background-image: url(https://avatar.citywish.fr/?username=<?= $com_author->name; ?>&headonly=0&direction=2&head_direction=2&gesture=sml);">
                        </div>
                        <div class="pseudo">
                            <?= $com_author->name; ?>
                        </div>
                        <div class="msg">
                            <?php $comencode = $comment->commentaire;
                            $comb = html_entity_decode($comencode);
                            echo $comb; ?>
                        </div>
                    </div>
                    <div id="right">
                        <?php if ($com_author->rang === 11) { ?> <div class="badge" alt="Fondateur de CityWish"
                            style="background-image: url(<?php echo BadgeStaff('11');?>);"></div> <?php } ?>
                        <?php if ($com_author->rang === 10) { ?> <div class="badge" alt="Administrateur de CityWish"
                            style="background-image: url(<?php echo BadgeStaff('10');?>);"></div> <?php } ?>
                        <?php if ($com_author->rang === 9) { ?> <div class="badge" alt="Responsable de CityWish"
                            style="background-image: url(<?php echo BadgeStaff('9');?>);"></div> <?php } ?>
                        <?php if ($com_author->rang === 8) { ?> <div class="badge" alt="Staff de CityWish"
                            style="background-image: url(<?php echo BadgeStaff('8');?>);"></div> <?php } ?>
                        <?php if ($com_author->rang === 7) { ?> <div class="badge" alt="Staff de CityWish"
                            style="background-image: url(<?php echo BadgeStaff('7');?>);"></div> <?php } ?>
                    </div>
                </div>
            </a>
            <?php
                        }
                    } ?>
        </div>

        <?php include_once("assets/templates/footer.php"); ?>
    </div>

    <?php
    if(date('M') === 'Dec') {
        ?>
        <script type="text/javascript" src="assets/js/snowstorm.js"></script>
    <?php } ?>    <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
</body>

</html>