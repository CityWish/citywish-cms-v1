<?php
  require 'inc/data.php';
    $_GET['page'] = 0;
    $nav_en_cours = 'creer';
    $page = "creer";
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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/js/tinymce/tinymce.min.js"></script>
     <script type="text/javascript">
  tinymce.init({
      selector: "textarea",
      theme: "modern",
      plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      toolbar2: "print preview media | forecolor backcolor emoticons",
      image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });
  </script>
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
              <h3 class="card-title">Créer un article</h3>
              <form method="post" action="?do=creer">
                <input class="form-control" id="exampleInputEmail1" type="text" name="titre" placeholder="Titre"> <br>
                <input class="form-control" id="exampleInputEmail1" type="text" name="background" placeholder="Lien bannière"> <br>
                <input class="form-control" id="exampleInputEmail1" type="text" name="descp" placeholder="Description"> <br>
                <textarea  class="form-control" rows="3" name="msg" placeholder="news" style="height: 1000px;"></textarea> <br>
                <select name="categorie">
                  <option value="HABBOCITY">HABBOCITY</option>
                  <option value="CITYWISH">CITYWISH</option>
                  <option value="HORS-HABBO">HORS-HABBO</option>
                  <option value="INTERVIEW">INTERVIEW</option>
                  <option value="TUTORIEL">TUTORIEL</option>
                </select> 
                  <br><br>
                <button type="submit" class="btn btn-primary icon-btn mr-10" class="btn btn-default">Executer</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascripts-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/main.js"></script>
     <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
