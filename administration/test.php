<?php
/*require_once 'inc/class/BddInit.php';

$bdd = new BddInit();

$news = $bdd->connect()->query('SELECT * FROM news ORDER BY id ASC');
$news_data = $news->fetchAll();

foreach ($news_data as $key => $new) {
  $article = $bdd->connect()->prepare('INSERT INTO articles (id, title, descp, body, author, corrector, dates, dates_correction, dates_editing, category, background, valid, deleted, draft, corrected) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $article->execute([$new['id'], $new['titre'], $new['descp'], $new['body'], $new['par'], '', $new['dates'], '', '', $new['categorie'], $new['background'], $new['valid'], $new['supprimer'], 0, 1]);
}*/