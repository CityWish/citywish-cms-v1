<?php
  require 'inc/data.php';
    $_GET['page'] = 0;
    $nav_en_cours = 'Logs';
   $dedi = $bdd->query('SELECT * FROM dedi ORDER BY id DESC');
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
            <div class="col-md-12">
              <div class="card">
                <h3 class="card-title">Dédicaces</h3>
                <?php while($d = $dedi->fetch()) { ?>
                <li><?php $dediencodea = $d['msg']; $dediba = html_entity_decode($dediencodea);echo $dediba; ?> | Par <?= $d['par'] ?> | <a target="_blank" href="./dedisupp.php?id=<?= $d['id'] ?>">Supprimer</a></li>
                <?php } ?>
<br />
<a href="./dediliste.php"><button   class="btn btn-primary icon-btn mr-10" class="btn btn-default">Rafraîchir</button></a>
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
