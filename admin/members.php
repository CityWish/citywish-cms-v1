<?php
  require 'inc/data.php';
    $_GET['page'] = 0;
    $nav_en_cours = 'Look';
?>
<?php
// Changer mot de passe
  if(isset($_GET['do'])){
    if(happySecu($_GET['do']) == "mdp"){
      if($jr->rang > 2){
      if(isset($_POST["mdp"]) || isset($_POST["pseudo"])){
        if(empty($_POST["mdp"]) || empty($_POST["pseudo"])){
          echo '<script>alert("Erreur");</script>';
        } else{
          $sql = $bdd->prepare("SELECT * FROM members WHERE name = :name");
          $sql->bindValue("name", happySecu($_POST["pseudo"]), PDO::PARAM_STR);
          $sql->execute();
          if($sql->rowCount() < 1){
            echo '<script>alert("Compte introuvable");</script>';
          } else{
            if(strlen($_POST["mdp"]) < 5){
              echo '<script>alert("Mot de passe trop faible");</script>';
            } else{
              $logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
              $logsql->execute(array("À changé le mot de passe de ".$_POST['pseudo']."",$jr->name,date('d-m-Y H:i:s')));
              $sql = $bdd->prepare("UPDATE members SET password = :password WHERE name = :name");
              $sql->bindValue("password", newHash($_POST["mdp"]), PDO::PARAM_STR);
              $sql->bindValue("name", happySecu($_POST["pseudo"]), PDO::PARAM_STR);
              $sql->execute();
              echo '<script>alert("Mot de passe changé !");</script>';
            }
          }
        }
      }
    } else{
      echo '<script>alert("Rank trop petit");</script>';
    }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo $Configs['Nom']; ?> : Administration</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>

  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="index">CityWish</a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">

          </div>
        </nav>
      </header>
      <?php include_once("assets/templates/header.php"); ?>
        <div class="row">

          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Changer une certification</h3>
              <form method="post" action="?do=certifmodif">
                <select name="certifmodif"><option value="1">Certifié</option><option value="0">Non certifié</option></select><br /> <br />
                <input type="text" name="name" placeholder="Nom du joueur" style="width: 100%;padding: 10px;"><br /><br />
                <input type="submit" class="btn btn-primary icon-btn mr-10" value="Valider" style="width: 100%;">
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Changer un pseudo</h3>
              <form method="post" action="?do=namemodif">
                <input type="text" name="namemodif" placeholder="Nouveau pseudo" style="width: 100%;padding: 10px;"><br /><br />
                <input type="text" name="name" placeholder="Nom du joueur" style="width: 100%;padding: 10px;"><br /><br />
                <input type="submit" class="btn btn-primary icon-btn mr-10" value="Modifier" style="width: 100%;">
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Changer un mot de passe</h3>
              <form method="post" action="?do=mdp">
                <input type="password" name="mdp" placeholder="Nouveau mot de passe" style="width: 100%;padding: 10px;"><br /><br />
                <input type="text" name="pseudo" placeholder="Pseudonyme du joueur" style="width: 100%;padding: 10px;"><br /><br />
                <input class="btn btn-primary icon-btn mr-10" type="submit" value="Modifier" style="width: 100%;">
              </form>
            </div>
          </div>
        <?php if ($jr->rang > 8) {?>
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Récupérer l'IP d'un membre</h3>
              <form method="post" action="?do=takeip">
                <input type="text" name="pseudo" placeholder="Pseudonyme du joueur" style="width: 100%;padding: 10px;"><br /><br />
                <input class="btn btn-primary icon-btn mr-10" type="submit" value="Récupérer" style="width: 100%;">
              </form>
            </div>
        <?php }?>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div style="color: red;font-size: 20px;text-transform: uppercase;text-align: center;font-weight: bold;">/!\ <i>Chaque changement de compte est sauvegardé dans les logs du site, ne pas en abuser sous peine de licenciement</i> ! /!\</div>
            </div>
          </div>
        </div>
      </div>
    <!-- Javascripts-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
