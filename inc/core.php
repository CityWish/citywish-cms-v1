<?php
require_once __DIR__ . '/config.php';

ini_set('session.cookie_domain', '.citywish.fr');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');

/*$isElectronApp = isset($_SERVER['HTTP_USER_AGENT']) && str_contains($_SERVER['HTTP_USER_AGENT'], 'Electron');
if($isElectronApp) {
ini_set('session.cookie_samesite', 'None');
} else {
    header('X-Frame-Options: SAMEORIGIN');
    header("Content-Security-Policy: frame-ancestors 'self'");
}*/

session_start();

define('VERSION', 165);

// Configurations de base
$Configs = [
  'Auteur' => 'LOXI- & Cold',
  'Développeur' => 'Neal & Cold avec l\'aide de -Propre',
  'Nom' => 'CITYWISH',
  'Retro' => 'HabboCity',
  'Url' => 'https://citywish.fr/',
  'Web' => 'https://citywish.fr/assets/',
  'Desc' => 'CITYWISH est un site-fan officiel du rétro-serveur HabboCity ! Tu pourras y retrouver toute l\'actualité d\'HabboCity, ainsi que des jeux, des tutoriels et des concours inédits !',
];

require_once 'bdd.php';

require_once 'api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

// Fonction
function newHash($password)
{
    return password_hash($password, PASSWORD_ARGON2I);
}

function happySecu($var)
{
  return htmlspecialchars(htmlentities(trim(strip_tags($var))));
}

function happyHash($var)
{
  return happySecu(md5(sha1(md5(sha1($var)))));
}

function isOldHash($hash)
{
    return preg_match('/^[a-f0-9]{32}$/', $hash);
}

function happyCertif($length = 10, $prefix, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
{
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }
  return (!is_null($prefix) ? mb_strtoupper($prefix) . '-' : '') . $code;
}

function NbComment($var)
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM commentaires WHERE id_article = :id');
  $sql->execute(['id' => $var]);
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function NbViewNews($var)
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM view_article WHERE id_article = :id');
  $sql->execute(['id' => $var]);
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function NbViewsAll()
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM view_article');
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function SetView($var)
{
  global $bdd;
  $sqlviewverif = $bdd->prepare('SELECT * FROM view_article WHERE id_article = :id AND IP = :ip');
  $sqlviewverif->execute(['id' => $var, 'ip' => $_SERVER['REMOTE_ADDR']]);
  if ($sqlviewverif->rowCount() === 0) {
    $sqlviewset = $bdd->prepare('INSERT INTO view_article(id_article, IP, dates) VALUES (:id, :ip, :dates)');
    $sqlviewset->execute(['id' => $var, 'ip' => $_SERVER['REMOTE_ADDR'], 'dates' => date('d-m-Y H:i:s')]);
  }
}

function NbCommentAll()
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM commentaires');
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function NbMemberAll()
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM members');
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function NbNewsAll()
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM news WHERE valid = :valid AND supprimer = :supprimer');
  $sql->execute(['valid' => 1, 'supprimer' => 0]);
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function NbBanIpAll()
{
  global $bdd;
  $sql = $bdd->prepare('SELECT COUNT(id) AS nb FROM banip');
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_OBJ);
  return $data->nb;
}

function ColorStaff($var)
{
  $var = (int)$var;
  if ($var >= 10) {
    return '#FF5252';
  } elseif ($var === 9) {
    return '#00BFA6';
  } elseif ($var === 8) {
    return '#FFC107';
  } elseif ($var === 7) {
    return '#19BD6E';
  } elseif ($var === 6) {
    return '#7289DA';
  }
  return 'null';
}

function BadgeStaff($var)
{
  $var = (int)$var;
  if ($var === 11) {
    return './assets/imgs/staffs/fonda.png';
  } elseif ($var === 10) {
    return './assets/imgs/staffs/fonda.png';
  } elseif ($var === 9) {
    return './assets/imgs/staffs/admin.png';
  } elseif ($var === 8) {
    return './assets/imgs/staffs/resp.png';
  } elseif ($var === 7) {
    return './assets/imgs/staffs/staff.png';
  }
  return 'null';
}

function Comment_Title_News($var)
{
  global $bdd;
  $sql = $bdd->prepare('SELECT * FROM news WHERE id = :id');
  $sql->execute(['id' => $var]);
  $title = $sql->fetch(PDO::FETCH_OBJ);
  return $title->titre;
}

// On défini les données de l'utilisateur
if (isset($_SESSION['username'])) {
  $sql = $bdd->prepare('SELECT * FROM members WHERE name = :username LIMIT 1');
  $sql->execute(['username' => happySecu($_SESSION['username'])]);
  if ($sql->rowCount() > 0) {
    $jr = $sql->fetch(PDO::FETCH_OBJ);
    $_SESSION['userId'] = $jr->id;
    $ipsql = $bdd->prepare('UPDATE members SET ip_adresse = :ip_adresse WHERE name = :username');
    $ipsql->execute(['ip_adresse' => $_SERVER['REMOTE_ADDR'], 'username' => $jr->name]);
    $pseudoapi = $_SESSION['username'];
    $occurence = new ApiHabboCity($pseudoapi, $apiKey);
    if ($occurence->getErreur() === null) {
      $sqlgenre = $bdd->prepare('UPDATE members SET genre = :genre WHERE name = :username');
      $sqlgenre->execute(['genre' => $occurence->getGender(), 'username' => $_SESSION['username']]);
    } else {
      $_SESSION['error'] = '<div class="error-v">Nous n\'avons pas réussi à nous connecter à l\'API de HabboCity.</div>';
    }
    if ($jr->certif < 1) {
      $erreur = '<script>
      sweetAlert({
      title: "Oops...",
      text: "Ton compte n\'est pas certifié !",
      icon: "warning",
      button: "Me certifier",
      closeOnClickOutside: false,
      closeOnEsc: false,
    })
      .then((goCertif) => {
        if (goCertif) {
  if (document.getElementById("certif").style.transform == "scale(0)") {
       document.getElementById("certif").style.transform = "scale(1)";
       $("html").css({overflow: "hidden"});
       setTimeout(function(){
       document.getElementById("certif" + "-container").style.transform = "scale(1)";
       }, 300);
  }
  else {
       document.getElementById("certif").style.transform = "scale(0)";
       document.getElementById("certif" + "-container").style.transform = "scale(0)";       
  }
        }
    });
    </script>';
    }
    $sqlban = $bdd->prepare('SELECT * FROM banip WHERE pseudo = :user');
    $sqlban->execute(['user' => $jr->name]);
    if ($sqlban->rowCount() > 0) {
      header('Location: ban.php', true, 307);
      exit();
    }
    $sqlbanid = $bdd->prepare('SELECT * FROM banip WHERE id = :id');
    $sqlbanid->execute(['id' => $jr->id]);
    if ($sqlbanid->rowCount() > 0) {
      header('Location: ban.php', true, 307);
      exit();
    }
  } else {
    header('Location: index', true, 307);
    exit();
  }
}

/* Ban IP */
$banip = $bdd->prepare('SELECT * FROM banip WHERE ip = :ip');
$banip->execute(['ip' => $_SERVER['REMOTE_ADDR']]);
if ($banip->rowCount() > 0) {
  header('Location: ban', true, 307);
  exit();
}

// Maintenance
$sql = $bdd->prepare('SELECT * FROM maintenance WHERE etat = :etat');
$sql->execute(['etat' => 1]);
if ($sql->rowCount() === 1) {
  header('Location: maintenance', true, 307);
  exit();
}

//Certification
if (isset($_GET['do'])) {
  if (happySecu($_GET['do']) === 'certif') {
    if (isset($_SESSION['username'])) {
      if (isset($_POST['pass_certif'])) {
        $mdp = $_POST['pass_certif'];
        $name = $jr->name;
        $hash = $jr->password;
        if (empty($mdp)) {
          $erreur = '<script>sweetAlert("Oops...", "Les champs sont vides.", "error");</script>';
        } else {
            if (password_verify($mdp, $hash)) {
            $pseudo = $name;
            $occurence = new ApiHabboCity($pseudo, $apiKey);
            if ($occurence->getErreur() !== null) {
              $erreur = '<script>sweetAlert("Oops...", "Nous n\'avons trouvé aucun compte sous le pseudo énoncé ci-dessus.", "error");</script>';
            } else {
              if ($occurence->getMission() === $code = $_POST['code']) {
                $sql = $bdd->prepare('UPDATE members SET certif = :certif WHERE name = :name');
                $sql->execute(['certif' => 1, 'name' => $jr->name]);
                $_SESSION['error'] = '<div class="error-v" style="background-color:#28b463;">Ton compte a bien été certifié.</div>';
                header('Location: index', true, 307);
                exit();
              }
            }
          } else {
            $erreur = '<script>swal({
          title: "Oops...",
          text: "La certification n\'a pas marché, réessaye !",
          icon: "error",
          button: "Réessayer",
          closeOnClickOutside: false,
          closeOnEsc: false,
        })
          .then((reCertif) => {
            if (reCertif) {
              if (document.getElementById("certif").style.display == "none") {
                   document.getElementById("certif").style.display = "block";
              }
              else {
                   document.getElementById("certif").style.display = "none";
              }
            }
        });</script>';
          }
        }
      }
    }
  }
}

// Envoie dédicace
if (isset($_GET['do'])) {
  if (happySecu($_GET['do']) === 'dedi') {
    if (isset($_SESSION['username'])) {
      if (empty(happySecu($_POST['dedimsg']))) {
        $_SESSION['error'] = '<div class="error-v">Le champ de saisi est vide.</div>';
      } else {
        $dedi = happySecu($_POST['dedimsg']);
        if (strlen($dedi > 84)) {
          $_SESSION['error'] = '<div class="error-v">Le message saisi est trop long.</div>';
        } else {
          $sql = $bdd->prepare('INSERT INTO dedi(msg, par, ip, verif) VALUES (:msg, :par, :ip, :verif)');
          $sql->execute(['msg' => $dedi, 'par' => $jr->name, 'ip' => $_SERVER['REMOTE_ADDR'], 'verif' => 0]);
          $_SESSION['error'] = '<div class="error-v" style="background-color: #28b463;">Ta dédicace a été envoyé !</div>';
          header('Location: dedicaces', true, 307);
          exit();
        }
      }
    } else {
      $_SESSION['error'] = '<div class="error-v">Il faut être connecté pour envoyer une dédicace.</div>';
    }
  }
}

/* Réinitaliser les votes */
if (isset($_GET['do'])) {
  if (happySecu($_GET['do']) === 'resetvote') {
    if (isset($_SESSION['username'])) {
      $rang = $jr->rang;
      if ($rang < 10) {
        $erreur = '<script>swal("Oops...", "Tu n\'as pas les autorisations nécessaires pour effectuer cette action.", "error");</script>';
      } else {
        $sqlreset = $bdd->prepare('UPDATE members SET vote = :zero WHERE vote >= :un');
        $sqlreset->execute(['zero' => 0, 'un' => 1]);
        $sqldelete = $bdd->prepare('DELETE FROM vote');
        $sqldelete->execute();

        $_SESSION['error'] = '<div class="error-v" style="background-color:#28b463;">Les votes ont bien été réinitialisés !</div>';
        header('Location: vote', true, 307);
        exit();
      }
    }
  }
}

/* Changer le membre/staff du mois */
if (isset($_GET['do'])) {
  if (happySecu($_GET['do']) === 'setpseudo') {
    if (empty($_POST['pseudo-vote'])) {
      $erreur = '<script>swal("Oops...", "Le champ pseudo est vide.", "error");</script>';
    } else {
      $pseudomonth = happySecu($_POST['pseudo-vote']);
      if (isset($_SESSION['username'])) {
        $rang = $jr->rang;
        if ($rang < 10) {
          $erreur = '<script>swal("Oops...", "Tu n\'as pas les autorisations nécessaires pour effectuer cette action.", "error");</script>';
        } else {
          $sqlchangepseudo = $bdd->prepare('UPDATE statutvote SET user = :pseudo');
          $sqlchangepseudo->execute(['pseudo' => $pseudomonth]);

          $_SESSION['error'] = '<div class="error-v" style="background-color:#28b463;">Le pseudo a bien été changé !</div>';
          header('Location: vote', true, 307);
          exit();
        }
      }
    }
  }
}