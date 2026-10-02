<?php
require_once 'inc/data.php';
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

$_GET['page'] = 0;
$nav_en_cours = 'valid';
$page = "valid";
?>
<?php
  if(isset($_GET['valid'])){
    if($jr->fonction === 'Resp. R&amp;eacute;daction' OR $jr->rang >= 10){
    $sql = $bdd->prepare("UPDATE news SET valid = :valid, dates = :dates WHERE id = :id");
    $sql->execute(["valid" => 1, "dates" => time(), "id" => happySecu($_GET['valid'])]);
    $logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
    $logsql->execute(array("A validé un article",$jr->name,date('d-m-Y H:i:s')));

    $info = $bdd->prepare('SELECT titre,descp,par,categorie,background FROM news WHERE id = ?');
    $info->execute([$_GET['valid']]);
    $article = $info->fetch(PDO::FETCH_OBJ);

    $author = $bdd->prepare('SELECT name,fonction FROM members WHERE id = ?');
    $author->execute([$article->par]);
    $par = $author->fetch(PDO::FETCH_OBJ);
   /* $client = new Client(citywishEnv('CITYWISH_ADMIN_DISCORD_WEBHOOK', CITYWISH_ADMIN_DISCORD_WEBHOOK));
    $client->avatar(citywishBaseUrl() . 'assets/imgs/meta.png');

    $titre = html_entity_decode(html_entity_decode($article->titre));
    $descp = html_entity_decode(html_entity_decode($article->descp));
    $poste = html_entity_decode(html_entity_decode($par->fonction));

    $embed = new Embed();
    $embed->url(citywishBaseUrl() . 'news?id='.$_GET['valid']);
    $embed->color('#1976d2');
    $embed->author($par->name.' - '.$poste, citywishBaseUrl() . 'profil/'.$par->name, citywishBaseUrl() . 'assets/imgs/meta.png');
    $embed->title('__**Nouvel Article sur CityWish**__');
    $embed->description('Un __**[nouvel article](<?= $Configs['Url'] ?>news?id='.$_GET['valid'].' "'.$titre.'")**__ écrit par __**['.$par->name.'](<?= $Configs['Url'] ?>profil/'.$par->name.' "'.$poste.'")**__ est apparu sur notre site internet CityWish.fr !');
    $embed->field('Titre de l\'article :', '__'.$titre.'__', true);
    $embed->field('Description de l\'article :', '__'.$descp.'__', true);
    $embed->field('Catégorie de l\'article :', '__'.$article->categorie.'__', true);
    $embed->field('Lien de l\'article :', '**<?= $Configs['Url'] ?>news?id='.$_GET['valid'].'**');
    $embed->image($article->background);
    $embed->thumbnail(citywishBaseUrl() . 'assets/imgs/meta.png');
    $embed->footer('Liste des articles de notre site : ' . citywishBaseUrl() . 'articles');
    $embed->timestamp(date('c'));
    $client->embed($embed)->message('<@&586184708581359617>')->send();*/
    } else {
      echo '<script>alert("Erreur rank trop petit");</script>';
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
            <?php
              if(isset($_GET['id'])){
                $id = happySecu($_GET['id']);
                if(empty($id)){
                  echo 'error';
                } else{
                  $sql = $bdd->prepare("SELECT * FROM news where id = ? and valid = 0 and supprimer = 0");
                  $sql->execute(array($id));
                  $req = $sql->fetch(PDO::FETCH_OBJ);

                  $author = $bdd->prepare('SELECT name,fonction FROM members WHERE id = ?');
                  $author->execute([$req->par]);
                  $par = $author->fetch(PDO::FETCH_OBJ);
                  if($sql->rowCount() < 1){
                    echo 'error';
                  } else{
              ?>
            <div class="card">
                <h3 class="card-title" style="text-transform: uppercase;"><?= $req->categorie;?> : <?= $req->titre;?></h3>
                <i><?= $req->descp;?></i>
                <hr>
                <p>
                <?= $req->body;?>
                </p>
                <hr>
                Posté par <b><?= $par->name;?></b> (<?= $par->fonction;?>)
                <br />
                le <b><?= date('d-m-Y',$req->dates);?></b>
                <br />
                <a href="?valid=<?= $req->id;?>"><button class="btn btn-primary icon-btn mr-10" style="margin-top: 10px;">valider l'article</button></a>
            </div>
            <?php } } } ?>
            <div class="card">
              <h3 class="card-title" style="margin-bottom: 5px;">Valider un article</h3>
              <?php
              $sql = $bdd->prepare("SELECT * FROM news where valid = 0 and supprimer = 0 order by id desc");
              $sql->execute();
              while($req = $sql->fetch(PDO::FETCH_OBJ)){
                  $author = $bdd->prepare('SELECT name FROM members WHERE id = ?');
                  $author->execute([$req->par]);
                  $par = $author->fetch(PDO::FETCH_OBJ);
              ?>

                <div style="margin-left: -15px;display: inline-block;margin-top: -10px;color: white;">
                <div style="height: 150px;width: 332.7px;background-color: red;background-image:url(<?= $req->background;?>);background-position:center;margin-left: 20px;margin-top: 20px;">
                  <div style="height: 150px;width: 332.7px;background-color: rgba(0,0,0,0.6);padding: 15px;">
                    <div style="text-transform: uppercase;font-weight: bold;font-size: 20px;"><?= $req->categorie;?> : <?= html_entity_decode($req->titre); ?></div>
                    <div style="font-size: 13px;">Posté par : <?= $par->name;?></div>
                    <a href="?id=<?= $req->id;?>" style="color: white;"><button class="btn btn-primary icon-btn mr-10" style="width: 100%;margin-top: 15px;">voir l'article</button></a>
                  </div>
                </div>
                </div>

              <?php } ?>
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
