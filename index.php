<?php
require_once 'inc/core.php';
$_GET['page'] = 0;
$nav_en_cours = 'Accueil';
if (isset($_SESSION['username'])) {
    $pseudo = $jr->name;
    $occurence = new ApiHabboCity($pseudo, $apiKey);
    if ($occurence->getErreur() != null) {
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134156119-1"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-134156119-1');
  </script>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width" />
  <meta name="theme-color" content="#258dc0" />
  <meta name="keywords" content="HabboCity, CityWish, fansite, fansite habbocity" />
  <meta name="description" content="<?= $Configs['Desc'] ?>" />
  <meta name="reply-to" content="contact@citywish.fr">
  <meta name="author" lang="fr" content="Cold" />

  <meta property="og:title" content="CITYWISH" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="<?= $Configs['Desc'] ?>">
  <meta property="og:url" content="<?= $Configs['Url'] ?>" />
  <meta property="og:image:url" content="<?= $Configs['Url'] ?>assets/imgs/meta.png" />
  <meta property="og:image:alt" content="CityWish" />
  <meta property="og:image:height" content="1024" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:type" content="image/png" />
  <meta property="og:locale" content="fr_FR" />
  <meta property="og:site_name" content="CITYWISH" />

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@CityWish_FR" />
  <meta name="twitter:title" content="CITYWISH" />
  <meta name="twitter:description" content="<?= $Configs['Desc'] ?>" />
  <meta name="twitter:creator" content="@Cold_FR" />
  <meta name="twitter:image:src" content="<?= $Configs['Url'] ?>assets/imgs/meta.png" />
  <meta name="twitter:image:alt" content="CityWish" />
  <meta name="twitter:domain" content="<?= $Configs['Url'] ?>" />

  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="<?= $Configs['Url'] ?>fav/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="<?= $Configs['Url'] ?>fav/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120"
    href="<?= $Configs['Url'] ?>fav/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= $Configs['Url'] ?>fav/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152"
    href="<?= $Configs['Url'] ?>fav/apple-touch-icon-152x152.png" />

  <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?= $Configs['Url'] ?>fav/favicon-128.png" sizes="128x128" />

  <link rel="stylesheet" type="text/css" href="<?= $Configs['Web'] ?>style/global.css?v=<?= VERSION ?>" />
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= $Configs['Web'] ?>style/header.css?v=<?= VERSION ?>" />
  <link rel="stylesheet" type="text/css"
    href="<?= $Configs['Web'] ?>icones/font Awesome/css/font-awesome.css?v=<?= VERSION ?>" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" type="text/css"
    href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css?v=<?= VERSION ?>" />

  <link rel="alternate" type="application/rss+xml" title="CITYWISH" href="<?= $Configs['Url'] ?>rss.php" />

  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script src="./assets/js/jquery-ui/jquery-ui.js"></script>

  <title><?= $Configs['Nom'] ?> : Accueil</title>
</head>

<body>
  <?php require_once 'assets/templates/header.php'; ?>

  <?php require_once 'assets/templates/overlay.php'; ?>

  <?php require_once 'assets/templates/loader.php'; ?>

  <?php require_once 'assets/templates/top-bottom.php'; ?>

  <?php require_once 'assets/templates/announcement.php'; ?>

  <div id="container">
    <?php require_once 'assets/templates/alerte.php'; ?>

    <div class="dedi">
      <div id="left" style="width: 100px;">
        <div class="title">
          dédicaces
        </div>
      </div>
      <div id="right" style="width: 87.5%;padding: 11px  8px  8px  8px;height: 40px;">

        <marquee id="scroller" scrollamount="7" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
          <?php
                    $sql = $bdd->prepare("SELECT * FROM dedi ORDER by id DESC LIMIT 20");
                    $sql->execute();
                    while($dedi = $sql->fetch(PDO::FETCH_OBJ)){
                    ?>

          <div class="msg">
            <div class="avat-dedi"
              style="background-image: url(https://avatar.citywish.fr/?username=<?= $dedi->par ?>&headonly=1&direction=2&head_direction=2&size=s)">
            </div>
            <b><?= $dedi->par;?></b> :
            <i><?= html_entity_decode($dedi->msg) ?></i>
          </div>
          <?php } ?>
        </marquee>
      </div>
    </div>

    <?php 
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>

    <?php if (isset($_SESSION['username'])) { ?>
    <div class="users">
      <div id="fond" <?php if ($jr->genre === 'F') { echo 'style="border: 3px solid #B11B5C;"'; } ?>>
        <div id="left">
          <div class="avatar"
            style="background-image: url(https://avatar.citywish.fr/?username=<?= $jr->name;?>&headonly=0&direction=2&head_direction=3&size=l); <?php if($jr->genre == 'F'){?>filter:drop-shadow(1px 0px 0 #B11B5C) drop-shadow(-1px 0px 0 #B11B5C) drop-shadow(1px -1px 0 #B11B5C) drop-shadow(-1px -1px 0 #B11B5C);<?php }else{?>filter:drop-shadow(1px 0px 0 #1976d2) drop-shadow(-1px 0px 0 #1976d2) drop-shadow(1px -1px 0 #1976d2) drop-shadow(-1px -1px 0 #1976d2);<?php }?>">
          </div>
          <div class="pseudo">
            <a style="color: white;" href="<?= $Configs['Url'] ?>profil/<?= $jr->name ?>">
              <div class="name"><?= $jr->name ?></div>
            </a>
            <?php if ($jr->certif === 1) { ?>
            <div class="certif" title="Tu es certifié !"><i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <?php } else { ?>
            <div class="certif-no" title="Tu n'es pas certifié"><i class="fa fa-times" aria-hidden="true"></i></div>
            <?php } ?>
          </div>
          <?php require_once 'assets/templates/online.php';?>
          <?php if ($occurence->getErreur() === null) { ?>
          <div class="motto">
            "<?= html_entity_decode($occurence->getMission()); ?>"
          </div>
          <?php } else { ?>
          <div class="motto">
            "Erreur : API d'HabboCity indisponible."
          </div>
          <?php } ?>
        </div>
        <div id="right">
          <div class="points">
            <li style="margin-bottom: 10px"><img src="./assets/imgs/coins.png"
                style="margin-left: -3px;margin-right: 5px;" /> <b><?= $jr->jetons;?></b> &nbsp;jetons
            </li>
            <li style="margin-bottom: 10px"><img src="./assets/imgs/trophy.png"
                style="margin-left: -2px;margin-right: 5px" /> <b><?= $jr->activ_p_s;?></b> &nbsp;points
            </li>
            <li><img src="./assets/imgs/hc.png" style="margin-left: -10px;margin-right: 5px" /> <b>???</b>
              &nbsp;mois</li>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

    <div id="left" style="margin-top: 15px;width: 520px;margin-right: 15px;">
      <div class="slideshow">
        <ul>
          <?php
                    $sql = $bdd->prepare("SELECT * FROM news WHERE supprimer = 0 AND valid = 1 ORDER BY dates DESC LIMIT 5");
                    $sql->execute();
                    while ($news = $sql->fetch(PDO::FETCH_OBJ)) {
                    ?>
          <a href="news?id=<?= $news->id ?>">
            <li>
              <div class="une"
                style='background-image: url("<?= $news->background ?>");background-position: center;background-repeat: no-repeat;'>
                <div id="fond">
                  <div class="coms">
                    <i class="fa fa-comments" aria-hidden="true"></i>
                    <?= NbComment($news->id) ?>
                  </div>
                  <div class="views-news">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    <?= NbViewNews($news->id) ?>
                  </div><br /><br /><br />
                  <div class="footer">
                    <!-- <div class="author" style="background-image: url(https://avatar.citywish.fr/?username=<?php echo $news->par; ?>&headonly=1&direction=2&head_direction=4);position: absolute;height: 75px;width: auto;margin-left: 420px;margin-top: -12px; "><p>Par <?php echo $news->par; ?></p></div>-->
                    <div class="title">
                      <?= $news->categorie ?> :
                      <?= html_entity_decode($news->titre) ?>
                    </div>
                    <div class="descp">
                      <?= html_entity_decode($news->descp) ?>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </a>
          <?php } ?>
        </ul>
      </div>
    </div>

    <?php 
        $sqlvotein = $bdd->prepare('SELECT * FROM statutvote');
        $sqlvotein->execute();
        if ($sqlvotein->rowCount() > 0) {
            while($voteinfo = $sqlvotein->fetch(PDO::FETCH_OBJ)) {
                if($voteinfo->user !== 'unknow'){
                    $sqlui = $bdd->prepare('SELECT * FROM members WHERE name = :pseudo');
                    $sqlui->execute(['pseudo' => $voteinfo->user]);
                    if ($sqlui->rowCount() > 0) {
                        while ($ui = $sqlui->fetch(PDO::FETCH_OBJ)) {
        ?>
    <div id="right" style="margin-top: 15px;width: 265px;">
      <a href="profil/<?= $voteinfo->user;?>" style="text-decoration: none;color: white;">
        <div class="last-hover">
          <p>
            <?= $voteinfo->user ?><?php if ($voteinfo->staffs === 1) { ?><br><?= html_entity_decode($ui->fonction) ?><?php } ?>
          </p>
        </div>
        <div class="last">
          <div id="top">
            <div class="pseudo">
              <?= $voteinfo->user ?>
            </div>
            <?php } ?>
            <div class="avatar"
              style="background-image: url(https://avatar.citywish.fr/?username=<?= $voteinfo->user;?>&head_direction=3&headonly=0&gesture=sml&size=l&direction=3);">
            </div>
          </div>
          <div id="bottom">
            <?php
                        if ($voteinfo->staffs === 1) {
                            echo 'staff du mois';
                        } elseif ($voteinfo->staffs === 0) {
                            echo 'membre du mois';
                        }
                        ?>
          </div>
        </div>
      </a>
    </div>
    <?php
            }
        } else {
        ?>
    <div id="right" style="margin-top: 15px;width: 265px;">
      <a href="vote" style="text-decoration: none;color: white;">
        <div class="last-hover">
          <p>À vos votes !</p>
        </div>
        <div class="last" <?php if ($voteinfo->staffs === 1) { echo 'style="background-color: #FF5252;"'; } ?>>
          <div id="top">
            <div class="pseudo">
              Prochainement
            </div>
            <div class="avatar"
              style="background-image: url(https://avatar.citywish.fr/?username=&head_direction=3&headonly=0&gesture=sml&size=l&direction=3);">
            </div>
          </div>
          <div id="bottom">
            <?php
                        if ($voteinfo->staffs === 1) {
                            echo "staff du mois";
                        } elseif ($voteinfo->staffs === 0) {
                            echo "membre du mois";
                        }
                        ?>
          </div>
        </div>
      </a>
    </div>
    <?php
                }
            }
        }
        ?>

    <div class="box" style="width: 100.5%; margin-right: 3px;">
      <div id="title">
        les derniers inscrits <div id="right"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
      </div>
      <div id="box-content" style="margin-left: 0px;margin-right: 0px;">
        <div class="user">
          <?php
                       $sql = $bdd->prepare('SELECT * FROM members WHERE hide = 0 ORDER by id DESC LIMIT 6');
                       $sql->execute();
                       while ($members = $sql->fetch(PDO::FETCH_OBJ)) {
                       ?>
          <a href="<?= $Configs['Url'] ?>profil/<?= $members->name ?>">
            <div class="userss">
              <div
                style="position: absolute;background-image: url(https://avatar.citywish.fr/?username=<?= $members->name ?>&headonly=0&direction=3&head_direction=3);height: 80px;width: 60px;margin-top: -5px;margin-left: 25px;">
              </div>
              <div class="footer">
                <p style="text-transform: uppercase;font-weight: bold;margin-bottom: -5px;">
                  <?= $members->name ?>
                </p>
              </div>
            </div>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php require_once 'assets/templates/footer.php'; ?>
  </div>
  <?php
    if(date('M') === 'Dec') {
        ?>
  <script type="text/javascript" src="assets/js/snowstorm.js"></script>
  <?php } ?>
  <script type="text/javascript" src="assets/js/slide.js?v=<?= VERSION ?>"></script>
  <script type="text/javascript">
  if (document.querySelector('.slideshow')) {
    setInterval(() => {
      /* Slider timer */
      $(".slideshow ul").animate({
        marginLeft: -0
      }, 100, function() {
        $(this).css({
          marginLeft: 0
        }).find("li:last").after($(this).find("li:first"));
      });
    }, 3500);
  }

  <?php 
    if(isset($_GET['code'])) {
    ?>
  window.onload = () => {
    <?php if(isset($_SESSION['username'])) {
        ?>
    fetch('../inc/ajax/session/discord_link.php?code=<?= $_GET['code'] ?>', {
      method: 'GET',
      credentials: 'include'
    }).then((response) => {
      return response.json();
    }).then((alert) => {
      if (alert.correct === true) {
        cleanAlert();
        addAlert(alert);
        if (alert.type === 'success') {
          setTimeout(() => {
            location.href = './';
          }, 1000);
        }
      }
    });
    <?php } else { ?>
    changeOverlay('connect');
    <?php } ?>
  };
  <?php } ?>
  </script>
  <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>
</body>

</html>