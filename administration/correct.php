<?php
require_once './inc/system.php';

$page = strtolower(str_replace('.php', '', basename(__FILE__)));
$title_page = 'Correction : Corriger un article';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./css/global.css?v=<?= VERSION; ?>" type="text/css" />
  <title>CITYWISH : <?= $title_page; ?></title>
</head>

<body>
  <div class="content">
    <?php require_once 'externals/header.php'; ?>

    <div class="container">
      <?php
        if (empty($_GET['id'])) {
            ?>
      <div class="list">
        <div class="title">Liste des articles à corriger <i style="font-size:26px">(Du plus récent au plus
            ancien)</i></div>
        <?php
                $sql = db->connect()->prepare('SELECT * FROM articles WHERE corrected = ? ORDER BY id DESC LIMIT 50');
                $sql->execute([0]);
                if ($sql->rowCount() > 0) {
                    $articles = $sql->fetchAll();
                    foreach ($articles as $news) {
                        if ($news['deleted'] === 0) {
                            ?>
        <div class="box-news">
          <a href="correct?id=<?= $news['id']; ?>">
            <div class="img-news">
              <div class="title-news"><?= $news['category']; ?>
                : <?= html_entity_decode($news['title']); ?></div>
              <div class="descp-news"><?= html_entity_decode($news['descp']); ?></div>
              <div class="bg-news" style="background-image: url(<?= $news['background']; ?>);"></div>
            </div>
          </a>
          <div class="author-news">
            <?php
                                $author = new UserInfo($news['author'], db);
                                echo $author->getName();
                                ?>
            <div class="info-hover"><i class="fas fa-user-edit"></i></div>
          </div>
          <div class="date-news">
            <?php
                                $date = explode('-', $news['dates'], 3);
                                $months = [
                                    '',
                                    'janvier',
                                    'février',
                                    'mars',
                                    'avril',
                                    'mai',
                                    'juin',
                                    'juillet',
                                    'août',
                                    'septembre',
                                    'octobre',
                                    'novembre',
                                    'décembre'
                                ];
                            $month = intval(str_replace('0', '', $date[1]));
                            if (intval($date[0]) < 10) {
                                $day = str_replace('0', '', $date[0]);
                            } else {
                                $day = $date[0];
                            }
                            echo $day . ' ' . $months[$month] . ' ' . $date[2]; ?>
            <div class="info-hover"><i class="fas fa-calendar-alt"></i></div>
          </div>
          <div class="state-news">
            <?php
                                if ($news['valid'] === 0) {
                                    echo 'Non validé' . '<div class="info-hover"><i class="fas fa-times"></i></div>';
                                } elseif ($news['valid'] === 1) {
                                    echo 'Validé' . '<div class="info-hover"><i class="fas fa-check"></i></div>';
                                } ?>
          </div>
        </div>
        <?php
                        } elseif ($news['deleted'] === 1 && $user->getRang() >= 10) {
                            ?>
        <div class="box-news">
          Article supprimé (design à faire)
        </div>
        <?php
                        }
                    }
                } else {
                    echo 'Aucun article';
                }
                ?>
      </div>
      <?php
        } else {
            $sql = db->connect()->prepare('SELECT * FROM articles WHERE id = ?');
            $sql->execute([$_GET['id']]);
            if ($sql->rowCount() < 1) {
                header('Location: correct', true, 307);
                exit();
            } else {
                $article = $sql->fetch();
                if ($article['deleted'] === 1 && $user->getRang() < 10) {
                    header('Location: correct', true, 307);
                    exit();
                } else {
                    ?>
      <form id="write-news">
        <div class="title">Corriger un article <i style="font-size:26px">(Article envoyé en correction
            le <?= $article['dates']; ?>)</i></div>
        <label for="news-title">Titre de l'article</label>
        <input type="text" value="<?= html_entity_decode($article['title']); ?>" name="title" id="news-title"
          placeholder="Nom de l'article..." />
        <label for="news-descp">Description de l'article</label>
        <input type="text" value="<?= html_entity_decode($article['descp']); ?>" name="descp" id="news-descp"
          placeholder="Court texte descriptif de l'article..." />
        <label for="news-banner">Bannière de l'article</label>
        <input type="text" value="<?= html_entity_decode($article['background']); ?>" name="banner" id="news-banner"
          placeholder="Lien de la bannière de l'article..." disabled />
        <label for="news-category">Catégorie de l'article</label>
        <select value="<?= $article['category']; ?>" name="category" disabled>
          <optgroup label="Catégories">
            <option value="CityWish">CityWish</option>
            <option value="HabboCity">HabboCity</option>
            <option value="Culture">Culture</option>
            <option value="Divers">Divers</option>
          </optgroup>
        </select>
        <label for="news-text">Contenu de l'article</label>
        <textarea name="content" id="news-text"
          placeholder="Texte de l'article..."><?= html_entity_decode($article['body']); ?></textarea>
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
      <?php
                }
            }
        }
        ?>
    </div>
  </div>

  <script src="https://cdn.tiny.cloud/1/t8z3w7ws5w9pvknvj4piqdj64pkmnj0kqkvcez6judf0jza7/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script src="js/global.js?v=<?= VERSION; ?>"></script>
  <?php
if (!empty($_GET['id'])) {
    ?>
  <script src="js/send-news.js?v=<?= VERSION; ?>"></script>
  <?php
}
?>
  <script src="https://kit.fontawesome.com/6f0608a280.js" crossorigin="anonymous"></script>
</body>

</html>