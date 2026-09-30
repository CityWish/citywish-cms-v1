<?php
  require 'inc/data.php';
    $_GET['page'] = 0;
    $nav_en_cours = 'Ban';
    if($jr->rang < 9){
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
              <h3 class="card-title">Bannir un membre</h3>
              <form method="post" action="?do=ban">
                <label>Pseudo du membre</label><input type="text" name="pseudo" placeholder="Pseudo" style="width: 100%;padding: 10px;"><br /><br />
                <label>Raison du ban</label><input type="text" name="why" placeholder="Raison" style="width: 100%;padding: 10px;"><br /><br />
                <input type="checkbox" name="banip" value="1" style="padding: 10px;"> Ipban<br><br>
                <input type="submit" class="btn btn-primary icon-btn mr-10" value="Valider" style="width: 100%;">
              </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div style="color: red;font-size: 20px;text-transform: uppercase;text-align: center;font-weight: bold;">/!\ <i>Chaque ban de compte est sauvegardé dans les logs du site, ne pas en abuser sous peine de licenciement</i> ! /!\</div>
            </div>
          </div>
        </div>
      </div>
    <!-- Javascripts-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
  </body>
</html>
