<?php
require_once './inc/system.php';
require_once './inc/class/Giveaways.php';

$page = strtolower(str_replace('.php', '', basename(__FILE__)));
$title_page = 'Giveaways : Liste des giveaways';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <?php include './externals/head.php'; ?>

    <link rel="stylesheet" href="./css/giveaways.css?v=<?= VERSION; ?>" type="text/css"/>
    <title>CITYWISH : <?= $title_page; ?></title>
</head>

<body>
<div class="content">
    <?php require_once 'externals/header.php'; ?>

    <div class="container">
        <div class="list" style="margin-bottom: 30px;" id="giveaways">
            <div class="title">Liste des giveaways sur le site <i style="font-size:26px">(Du plus récent
                    au plus
                    ancien)</i>
            </div>
            <div class="box box-giveaways create">
                <i class="fas fa-plus"></i>
            </div>
            <?php
            $sql = db->connect()->prepare('SELECT id FROM giveaways ORDER BY timestamp DESC LIMIT 6');
            $sql->execute();
            while ($item = $sql->fetch()) {
                $giveaways = new Giveaways(false, $item['id']);
                $author = new UserInfo($giveaways->getAuthor());
                ?>
                <div class="box box-giveaways" id="item-<?= $item['id']; ?>">
                    <div class="title-giveaways"><?= $giveaways->getTitle(); ?></div>
                    <div class="author-giveaways"><i class="fas fa-user-edit"
                                                     aria-hidden="true"></i> <?= $author->getName(); ?></div>
                    <div class="nbwinners-giveaways"><i class="fas fa-trophy"></i> <?= $giveaways->getNbWinners(); ?>
                        gagnant(s)
                    </div>
                    <div class="time-giveaways"><i class="fas fa-calendar-alt"></i>
                        <?= date('d/m/Y', $giveaways->getTimestamp()); ?></div>
                </div>
                <?php
            }
            ?>
        </div>

        <form id="send-giveaways">
            <div class="title" id="form-ga-title">Créer un giveaways</div>
            <input type="hidden" value="create" name="id" id="giveaways-id" placeholder="Lots..."/>
            <label for="giveaways-lots">Lots du giveaways</label>
            <input type="text" value="" name="title" id="giveaways-lots" placeholder="Lots..."/>
            <label for="giveaways-nbwinners">Nombre de gagnants du giveaways</label>
            <input type="number" value="" name="nb-winners" id="giveaways-nbwinners"
                   placeholder="Nombre de gagnants..."/>
            <label for="giveaways-date">Date de fin du giveaways</label>
            <input type="datetime-local" value="" name="date" id="giveaways-date"/>
            <label>Envoies</label>
            <div class="button-container">
                <button class="submit" name="finalsend" style="margin:0 0 10px 0;">
                    Envoyer
                    <div class="submit-hover"><i class="fas fa-check"></i></div>
                </button>
            </div>
        </form>

        <div class="list participants">
            <div class="title">Participants</div>
            <ul id="participants-list">
            </ul>
        </div>
    </div>
</div>

<script src="js/global.js?v=<?= VERSION; ?>"></script>
<script src="js/giveaways.js?v=<?= VERSION; ?>"></script>
<script src="https://kit.fontawesome.com/6f0608a280.js" crossorigin="anonymous"></script>
</body>

</html>