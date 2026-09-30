<?php
  require 'inc/data.php';
    $_GET['page'] = 0;
    $nav_en_cours = 'Rank';
    if($jr->rang < 8){
      header('Location: index');
      exit();
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
              <h3 class="card-title">Rank un joueur</h3>
              <form method="post" action="?do=rank">
                <label>Pseudo du membre</label><input type="text" name="pseudo" placeholder="Pseudo" style="width: 100%;padding: 10px;"><br /><br />
                <label>Rang du membre</label>  
                <br />  
                <select name="rang">
                  <option value="1">Membre</option>
                  <?php if($jr->rang > 7){?>
                  <option value="7">Staff</option>
                  <?php } if($jr->rang > 8){?>
                  <option value="8">Responsable</option>
                  <?php } if($jr->rang > 9){?>
                  <option value="9">Administrateur</option>
                  <?php } if($jr->rang > 10){?>
                  <option value="10">Gérant(e)</option>
                  <option value="11">Fondateur(trie)</option>
                  <?php }?>
                </select>
                <br /><br />
                <label>Pôle actuel ou ancien pôle du membre</label>  
                <br />  
                <select name="pole">
                  <?php if($jr->rang > 7){?>
                    <option value="1">Construction</option>
                    <option value="2">Création</option>
                    <option value="3">Animation</option>
                    <option value="4">Correction</option>
                    <option value="5">Rédaction</option>
                    <option value="6">Communication</option>
                  <option value="7">Événementiel</option>
                  <?php } if($jr->rang > 9){?>
                  <option value="8">Administration</option>
                  <?php } if($jr->rang > 10){?>
                  <option value="9">Gestion</option>
                  <option value="10">Fondation</option>
                  <?php }?>
                </select>
              <br /> 
              <br />
                 <label>Fonction du membre</label><input type="text" name="fonction" placeholder="Fonction" style="width: 100%;padding: 10px;"><br /><br />
                  <input type="submit" class="btn btn-primary icon-btn mr-10" value="Valider" style="width: 100%;">
              </form>
            </div>
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
