<?php
require_once 'inc/data.php';
$_GET['page'] = 0;
$nav_en_cours = 'Rank';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" />
    <!-- Font-icon CSS-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title><?= $Configs['Nom'] ?> : Administration</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>

<body class="sidebar-mini fixed">
    <div class="wrapper">
        <!-- Navbar-->
        <header class="main-header hidden-print">
            <a class="logo" href="index">CityWish</a>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
                <!-- Navbar Right Menu-->
                <div class="navbar-custom-menu">

                </div>
            </nav>
        </header>
        <?php require_once 'assets/templates/header.php'; ?>
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-title">Envoyer une image</h3>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <label>Sélectionne une image</label><input type="file" name="fileToUpload" id="fileToUpload"><br /><br />
                        <input type="submit" class="btn btn-primary icon-btn mr-10" value="Envoyer l'image" name="submit">
                    </form>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div style="color: red;font-size: 20px;text-transform: uppercase;text-align: center;font-weight: bold;">
                        /!\ <i>Chaque upload est sauvegardé dans les logs du site, ne pas en abuser sous peine de
                            licenciement</i> ! /!\
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>