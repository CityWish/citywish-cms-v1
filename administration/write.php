<?php
require_once './inc/system.php';

$page = strtolower(str_replace('.php', '', basename(__FILE__)));
$title_page = 'Rédaction : Rédiger un article';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/global.css?v=<?= VERSION; ?>" />
  <title>CITYWISH : <?= $title_page; ?></title>
</head>

<body>
  <div class="content">
    <?php require_once 'externals/header.php'; ?>

    <div class="container">
      <form id="write-news">
        <div class="title">Écrire un article</div>
        <label for="news-title">Titre de l'article</label>
        <input type="text" name="title" id="news-title" placeholder="Nom de l'article..." />

        <label for="news-descp">Description de l'article</label>
        <input type="text" name="descp" id="news-descp" placeholder="Court texte descriptif de l'article..." />

        <label for="news-banner">Bannière de l'article</label>
        <input type="text" name="banner" id="news-banner" placeholder="Lien de la bannière de l'article..." />

        <label for="news-category">Catégorie de l'article</label>
        <select name="category">
          <optgroup label="Catégories">
            <option value="CityWish">CityWish</option>
            <option value="HabboCity">HabboCity</option>
            <option value="Culture">Culture</option>
            <option value="Divers">Divers</option>
          </optgroup>
        </select>

        <label for="news-text">Contenu de l'article</label>
        <textarea name="content" id="news-text" placeholder="Texte de l'article..."></textarea>

        <label>Envoies</label>
        <div class="button-container">
          <button class="submit" name="previewsend" id="previewsend">
            Prévisualiser
            <div class="submit-hover"><i class="fas fa-eye"></i></div>
          </button>
          <button class="submit" name="draftsend" id="draftsend">
            Enregistrer comme brouillon
            <div class="submit-hover"><i class="fas fa-save"></i></div>
          </button>
          <button class="submit" name="finalsend" id="finalsend">
            Envoyer en correction
            <div class="submit-hover"><i class="fas fa-check"></i></div>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.tiny.cloud/1/t8z3w7ws5w9pvknvj4piqdj64pkmnj0kqkvcez6judf0jza7/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script src="js/global.js?v=<?= VERSION; ?>"></script>
  <script src="js/send-news.js?v=<?= VERSION; ?>"></script>
  <script src="https://kit.fontawesome.com/6f0608a280.js" crossorigin="anonymous"></script>
</body>

</html>