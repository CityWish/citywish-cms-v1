<?php
require_once './inc/system.php';

$page = strtolower(str_replace('.php', '', basename(__FILE__)));
$title_page = 'Rédaction : Liste des articles';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/global.css?v=<?= VERSION;?>" type="text/css" />
    <title>CITYWISH : <?= $title_page; ?></title>
</head>

<body>
    <div class="content">
        <?php require_once 'externals/header.php'; ?>

        <div class="container">
            <div class="list">
                <div class="title">Liste des articles disponibles sur le site <i style="font-size:26px">(Du plus récent
                        au plus
                        ancien)</i></div>
                <?php
                $sql= db->connect()->query('SELECT * FROM articles ORDER BY id DESC LIMIT 50');
                if ($sql->rowCount() > 0) {
                    $articles = $sql->fetchAll();
                    foreach ($articles as $news) {
                        if ($news['deleted'] === 0) {
                            ?>
                <div class="box box-news">
                    <a target="_blank"
                        href="<?= $news['valid'] === 1 ? '../news?id='.$news['id'] : './preview?id='.$news['id']; ?>">
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
                                echo $author->getName(); ?>
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
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/t8z3w7ws5w9pvknvj4piqdj64pkmnj0kqkvcez6judf0jza7/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="js/global.js?v=<?= VERSION; ?>"></script>
    <script src="https://kit.fontawesome.com/6f0608a280.js" crossorigin="anonymous"></script>
</body>

</html>