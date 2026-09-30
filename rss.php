<?php
require_once 'inc/bdd.php';

function antiHappySecu($var)
{
    return html_entity_decode(htmlspecialchars_decode($var));
}

$requete = $bdd->prepare('SELECT id,titre,descp,par,dates,categorie,background FROM news WHERE supprimer = :supprimer AND valid = :valid ORDER BY id DESC LIMIT 10');
$requete->execute(['supprimer' => 0, 'valid' => 1]);
$articles = $requete->fetchAll(PDO::FETCH_OBJ);

header('Content-type: application/rss+xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">' . "\n";
echo '  <channel>' . "\n";

echo '      <title>CITYWISH</title>' . "\n";
echo '      <atom:link href="https://' . $_SERVER['HTTP_HOST'] . '/rss.xml" type="application/rss+xml" rel="self"/>' . "\n";
echo '      <link>https://' . $_SERVER['HTTP_HOST'] . '</link>' . "\n";
echo '      <description>CITYWISH est un site-fan officiel du rétro-serveur HabboCity ! Tu pourras y retrouver toute l\'actualité d\'HabboCity, ainsi que des jeux, des tutoriels et des concours inédits !</description>' . "\n";
echo '      <lastBuildDate>' . (new DateTime($articles[0]->dates))->format(DateTime::RSS) . '</lastBuildDate>' . "\n";
echo '      <language>fr-FR</language>' . "\n";

echo '      <image>' . "\n";
echo '          <url>https://' . $_SERVER['HTTP_HOST'] . '/fav/mstile-144x144.png</url>' . "\n";
echo '          <title>CITYWISH</title>' . "\n";
echo '          <link>https://' . $_SERVER['HTTP_HOST'] . '</link>' . "\n";
echo '          <width>144</width>' . "\n";
echo '          <height>144</height>' . "\n";
echo '      </image>' . "\n";

foreach ($articles as $article) {
    $author = $bdd->prepare('SELECT name FROM members WHERE id = ?');
    $author->execute([$article->par]);
    $author_name = $author->fetch(PDO::FETCH_OBJ)->name;
    echo '      <item>' . "\n";
    echo '          <title><![CDATA[ ' . antiHappySecu($article->titre) . ' ]]></title>' . "\n";
    echo '          <link>https://' . $_SERVER['HTTP_HOST'] . '/news?id=' . $article->id . '</link>' . "\n";
    echo '          <dc:creator><![CDATA[ ' . $author_name . ' ]]</dc:creator>' . "\n";
    echo '          <pubDate>' . (new DateTime($article->dates))->format(DateTime::RSS) . '</pubDate>' . "\n";
    echo '          <category>' . $article->categorie . '</category>' . "\n";
    echo '          <guid>https://' . $_SERVER['HTTP_HOST'] . '/news?id=' . $article->id . '</guid>' . "\n";
    echo '          <description><![CDATA[ ' . antiHappySecu($article->descp) . ' ]]></description>' . "\n";
    echo '          <banner>'.$article->background.'</banner>' . "\n";
    echo '      </item>' . "\n";
}

echo '  </channel>' . "\n";
echo '</rss>' . "\n";
