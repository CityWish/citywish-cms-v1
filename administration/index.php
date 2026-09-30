<?php
require_once './inc/system.php';

$page = strtolower(str_replace('.php', '', basename(__FILE__)));
$title_page = 'Administration : Accueil';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <?php include './externals/head.php'; ?>

    <link rel="stylesheet" type="text/css" href="css/index.css?v=<?= VERSION; ?>"/>
    <title>CITYWISH : <?= $title_page; ?></title>
</head>

<body>
<div class="content">
    <?php require_once 'externals/header.php'; ?>

    <main class="container">
        <div class="stats">
            <div class="title">Statistiques</div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #1e88e5;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countMembers(); ?>
                </div>
                <div class="box-stats-title">
                    Membres
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #FF5252;">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countStaffs(); ?>
                </div>
                <div class="box-stats-title">
                    Staffs
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #444;">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countBanned(); ?>
                </div>
                <div class="box-stats-title">
                    Membres bannis
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #C2410C;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countArticles(); ?>
                </div>
                <div class="box-stats-title">
                    Articles
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #FF9800;">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countViews(); ?>
                </div>
                <div class="box-stats-title">
                    Vues
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #15803D;">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countComments(); ?>
                </div>
                <div class="box-stats-title">
                    Commentaires
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #4CAF50;">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countDedicaces(); ?>
                </div>
                <div class="box-stats-title">
                    Dédicaces
                </div>
            </div>
            <div class="box-stats">
                <div class="box-stats-icon" style="background-color: #F9D046;">
                    <i class="fas fa-arrow-right-arrow-left"></i>
                </div>
                <div class="box-stats-count">
                    <?= system->getStatistics()->countFlux(); ?>
                </div>
                <div class="box-stats-title">
                    Fluxs
                </div>
            </div>
        </div>
        <div class="user-info">
            <div class="title">Mes informations</div>
            <div class="box-user"></div>
        </div>
    </main>
</div>

<script src="js/global.js?v=<?= VERSION; ?>"></script>
<script src="https://kit.fontawesome.com/6f0608a280.js" crossorigin="anonymous"></script>
</body>

</html>