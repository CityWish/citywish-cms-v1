<div id="alert">
</div>
<div class="head-bar">
    <div class="logo">CITYWISH</div>
    <div class="bar">
        <?= $title_page; ?>
    </div>
</div>
<div class="head-menu">
    <div class="box">
        <b>Avertissement :</b> Toute action effectuée ici est sauvegardée et contrôlée régulièrement par les
        administrateurs.
    </div>
    <div class="user-info">
        <div class="avatar"
            style="background: url(https://api.habbocity.me/avatar_image.php?user=<?= $_SESSION['username']; ?>&headonly=1&direction=2&head_direction=2&size=l) center -40px no-repeat;">
        </div>
        <div class="text">
            <b><?= $_SESSION['username']; ?></b>
            <div class="fonction">
                <?= $user->getFonction(); ?>
            </div>
        </div>
    </div>
    <div class="menu">
        <!-- Overview -->
        <div class="category">
            <span>Overview</span>
            <a href="../../externals">
                <div class="nav" <?php if ($page === 'index' || $page === '') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-home" aria-hidden="true"></i>&nbsp;Accueil
                </div>
            </a>
            <a href="../../.." target="_blank">
                <div class="nav">
                    <i class="fas fa-share-square" aria-hidden="true"></i>&nbsp;Retourner sur le site
                </div>
            </a>
        </div>
        <!-- Fonda & Gestion -->
        <div class="category">
            <span>Fondation & Gestion</span>
            <a href="../admin/logs">
                <div class="nav">
                    <i class="fas fa-history" aria-hidden="true"></i>&nbsp;Logs
                </div>
            </a>
            <a href="../admin/valid">
                <div class="nav">
                    <i class="fas fa-check" aria-hidden="true"></i>&nbsp;Valider un article
                </div>
            </a>
            <a href="../admin/supp">
                <div class="nav">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>&nbsp;Supprimer un article
                </div>
            </a>
            <a href="../admin/members">
                <div class="nav">
                    <i class="fas fa-user" aria-hidden="true"></i>&nbsp;Information membre
                </div>
            </a>
        </div>
        <!-- Administration -->
        <div class="category">
            <span>Administration</span>
            <a href="./giveaways">
                <div class="nav" <?php if ($page === 'giveaways') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-gift" aria-hidden="true"></i>&nbsp;Giveaways
                </div>
            </a>
            <a href="../admin/rank">
                <div class="nav">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>&nbsp;Rank un membre
                </div>
            </a>
            <a href="../admin/bann">
                <div class="nav">
                    <i class="fas fa-user-slash"></i>&nbsp;Bannir un membre
                </div>
            </a>
        </div>
        <!-- Rédaction & Correction-->
        <div class="category">
            <span>Rédaction & Correction</span>
            <a href="./write">
                <div class="nav" <?php if ($page === 'write') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-file-import" aria-hidden="true"></i>&nbsp;Rédiger un article
                </div>
            </a>
            <a href="./edit">
                <div class="nav" <?php if ($page === 'edit') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Éditer un article
                </div>
            </a>
            <a href="./correct">
                <div class="nav" <?php if ($page === 'correct') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-search" aria-hidden="true"></i>&nbsp;Corriger un article
                </div>
            </a>
            <a href="./list">
                <div class="nav" <?php if ($page === 'list') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-list-ul" aria-hidden="true"></i>&nbsp;Liste des articles
                </div>
            </a>
        </div>
        <!-- Modération -->
        <div class="category">
            <span>Modération</span>
            <a href="../admin/dediliste">
                <div class="nav">
                    <i class="fas fa-comment-slash" aria-hidden="true"></i>&nbsp;Modérer les dédicaces
                </div>
            </a>
        </div>
        <!-- Animation
        <div class="category">
            <span>Animation</span>
            <a href="">
                <div class="nav">
                    <i class="fas fa-list-ol" aria-hidden="true"></i>&nbsp;Classement
                </div>
            </a>
            <a href="">
                <div class="nav">
                    <i class="fas fa-plus-circle" aria-hidden="true"></i>&nbsp;Ajout de points
                </div>
            </a>
        </div>
        Autres -->
        <div class="category">
            <span>Autres</span>
            <a href="../admin/select">
                <div class="nav">
                    <i class="fas fa-upload" aria-hidden="true"></i>&nbsp;Upload d'images
                </div>
            </a>
            <a href="../admin/listimg">
                <div class="nav">
                    <i class="fas fa-images" aria-hidden="true"></i>&nbsp;Liste des uploads
                </div>
            </a>
        </div>
    </div>
    <div class="box" id="footer">
        © 2017 - 2020 <b>CITYWISH</b> V.1.2<br />
        CITYWISH est un projet indépendant, à but non-lucratif, anciennement par <b>LOXI-</b> repris par
        <b>Cold</b>.</br />
        Administration - V.2 - Développé par <b>Cold</b>.
    </div>
</div>