<?php
    include('inc/data.php');
    $_GET['page'] = 0;
    $nav_en_cours = 'Articles';

  ?>
<!DOCTYPE html>
<html lang="fr" style="overflow-y: auto;">
    <head profile='https://gmpg.org/xfn/11'>
        <!--[if lt IE 9]>
            <script src="https://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
        <![endif]-->

        <meta charset='UTF-8'>

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name='viewport' content='user-scalable=no, user-scalable=no, initial-scale=1.0, maximum-scale=1, width=device-width'>
        <meta name='og:description' content="<?php echo $Configs['desc']; ?>">

        <meta property='og:image' content='https://citywish.fr/assets/imgs/meta.png'>
        <meta property="og:title" content="CITYWISH" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://citywish.fr/" />

        <meta property="og:image:alt" content="Logo social" />
        <meta property="og:image:height" content="400" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:site_name" content="CITYWISH" />
        <meta name="twitter:card" content="summary" />
   <meta name="twitter:site" content="@CityWish_FR" />
   <meta name="twitter:title" content="CITYWISH" />
   <meta name="twitter:description" content="<?php echo $Configs['Desc']; ?>" />
   <meta name="twitter:creator" content="" />
   <meta name="twitter:image:src" content="https://citywish.fr/assets/imgs/meta.png" />
   <meta name="twitter:image:alt" content="Logo social" />
   <meta name="twitter:domain" content="https://citywish.fr/" />

        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://citywish.fr/fav/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://citywish.fr/fav/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://citywish.fr/fav/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://citywish.fr/fav/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="https://citywish.fr/fav/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://citywish.fr/fav/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://citywish.fr/fav/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://citywish.fr/fav/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-196x196.png" sizes="196x196" />
        <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-16x16.png" sizes="16x16" />
        <link rel="icon" type="image/png" href="https://citywish.fr/fav/favicon-128.png" sizes="128x128" />

        <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/global.css" />
        <link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $Configs['Web']; ?>style/header.css" />
        <link type="text/css" rel="stylesheet" href="//cdn.axiomer.com/libs/glyphicons/1.9/glyphicons-all.min.css">
        <link type="text/css" rel='stylesheet' href='<?php echo $Configs['Web']; ?>icones/font Awesome/css/font-awesome.css'>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">

        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script type='text/javascript' src='//code.jquery.com/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='<?php echo $Configs['Web']; ?>js/slide.js'></script>
        <script type='text/javascript' src='//code.jquery.com/jquery-migrate-1.2.1.min.js'></script>

        <title><?php echo $Configs['Nom']; ?> : News</title>
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
    <body>





        <div id="container">


            <a href="liste.php">
              <div class="btn" id="co" style="">
                RETOURNER À L'ADMINISTRATION
              </div>
            </a>




            <div class="box">
                <?php
                if(isset($_GET['id'])){
                if(empty($_GET['id'])){
                    header("Location: index.php");
                } else{
                $sql = $bdd->prepare("SELECT * FROM news WHERE id = ? AND supprimer = ? AND valid = ?");
                $sql->execute(array(happySecu($_GET['id']),0,0));
                if($sql->rowCount() < 1){
                echo "<script type='text/javascript'>alert('Cet article est déjà visible sur le site.');</script>"; 
                $redirect->url(liste);
                }
                while($news = $sql->fetch(PDO::FETCH_OBJ)){
                    $author = $bdd->prepare("SELECT name FROM members WHERE id = ?");
                    $author->execute(array($news->par));
                    $author = $author->fetch(PDO::FETCH_OBJ);
                ?>
                <div class="news">
                    <div class="une" style="background-image: url(<?= $news->backgroundn;?>);">
                        <div id="fond">
                            <div class="footer">
                                <div class="title">
                                    <?= $news->categorie;?> : <?php $newstitlecode = $news->titre; $ntitleb = html_entity_decode($newstitlecode);echo $ntitleb; ?>
                                </div>
                                <div class="descp">
                                      <?php $descpnewscode = $news->descp; $descpnewsb = html_entity_decode($descpnewscode);echo $descpnewsb; ?>
                                </div>
                                <div class="par">
                                <i class="fa fa-history" aria-hidden="true"></i> posté le <b><?= $news->dates;?></b> par <a href="<?php echo $Configs['Url']; ?>profil.php?name=<?= $author->name;?>" style="color: white;"><b><?= $author->name;?></b></a> dans la catégorie <b><?= $news->categorie;?></b> !
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $news->body;?>
                    <div class="sign">
                        <div id="left">
                            <a href="<?php echo $Configs['Url']; ?>profil.php?name=<?= $news->par;?>">
                            <div  class="pseudo">
                                <b><?= $news->par;?></b>
                            </div>
                            </a>
                            <div class="fonction">
                                <i>  <?php $fonctiondecode = $news->fonction; $foncb = html_entity_decode($fonctiondecode);echo $foncb; ?> de <?php echo $Configs['Nom']; ?></i>
                            </div>
                        </div>
                        <div id="right">

                        </div>
                    </div>
                </div>
                <?php }}} ?>
            </div>

            <?php include_once("../assets/templates/footer.php"); ?>
        </div>

    </body>
</html>
