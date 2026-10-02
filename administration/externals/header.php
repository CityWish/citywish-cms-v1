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
            style="background: url(https://avatar.citywish.fr/?username=<?= $_SESSION['username']; ?>&headonly=1&direction=2&head_direction=2&size=l) center -40px no-repeat;">
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
            <a href="./">
                <div class="nav" <?php if ($page === 'index' || $page === '') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-home" aria-hidden="true"></i>&nbsp;Accueil
                </div>
            </a>
            <a href="<?= citywishBaseUrl() ?>admin/" target="_blank">
                <div class="nav">
                    <i class="fas fa-share-square" aria-hidden="true"></i>&nbsp;Retourner sur l'ancienne administration
                </div>
            </a>
            <a href="<?= citywishBaseUrl() ?>" target="_blank">
                <div class="nav">
                    <i class="fas fa-share-square" aria-hidden="true"></i>&nbsp;Retourner sur le site
                </div>
            </a>
        </div>
        <!-- Administration -->
        <div class="category">
            <span>Administration</span>
            <a href="./giveaways.php">
                <div class="nav" <?php if ($page === 'giveaways') {
                    echo 'style="opacity:1;background-color: #1976d2;"';
                } ?>>
                    <i class="fas fa-gift" aria-hidden="true"></i>&nbsp;Giveaways
                </div>
            </a>
        </div>
    </div>
    <div class="box" id="footer">
        © 2017 - <?= date('Y') ?> <b>CITYWISH</b> V.1.2<br />
        CITYWISH est un projet indépendant, à but non-lucratif, anciennement par <b>LOXI-</b> repris par
        <b>Cold</b>.</br />
        [ALPHA] Administration - V.2 - Développé par <b>Cold</b>.
    </div>
</div>