<?php

$page = 1;
$nbPerPages = 20;
$count = $bdd->prepare('SELECT COUNT(*) AS nb_articles FROM news');
$count->execute();
$total = (int) $count->fetch()['nb_articles'];
$nbPages = ceil($total / $nbPerPages);

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);

    if ($page > $nbPages) {
        $page = $nbPages;
    }
}

$firstElement = ($page * $nbPerPages) - $nbPerPages;

$sql = $bdd->prepare('SELECT id,titre,descp,categorie,background FROM news WHERE supprimer = 0 AND valid = 1 ORDER BY id DESC LIMIT :first, :nb');
$sql->execute(['first' => $firstElement, 'nb' => $nbPerPages]);

while ($news = $sql->fetch(PDO::FETCH_OBJ)) {
    ?>
    <a href="news?id=<?= $news->id; ?>">
        <div class="article" style='background-image: url("<?= $news->background; ?>");'>
            <div id="fond">
                <div class="views-news">
                    <i class="fa fa-eye" aria-hidden="true"></i> <?php echo NbViewNews($news->id); ?>
                </div>
                <div class="coms">
                    <i class="fa fa-comments" aria-hidden="true"></i> <?php echo NbComment($news->id); ?>
                </div>
                <div class="footer">
                    <div class="title">
                        <?= $news->categorie; ?> : <?php $newstitlecode = $news->titre;
                        $ntitleb = html_entity_decode($newstitlecode);
                        echo $ntitleb; ?>
                    </div>
                    <div class="descp">
                        <?php $descpnewscode = $news->descp;
                        $descpnewsb = html_entity_decode($descpnewscode);
                        echo $descpnewsb; ?>
                    </div>
                    <div class="suite">
                        Lire la suite
                    </div>
                </div>
            </div>
        </div>
    </a>
<?php
}

echo '<p align="center">Page : ';
for ($i = 1; $i <= $nbPages; $i++)
{

    if ($i == $page)
    {
        echo ' [ ' . $i . ' ] ';
    } else {
        echo ' <a href="articles?page=' . $i . '">' . $i . '</a> ';
    }
}
echo '</p>';


