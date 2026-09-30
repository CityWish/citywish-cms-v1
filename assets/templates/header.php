
<div id="alert">
</div>

<div id="barre">
    <div id="container"
         style="<?php if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && $jr->rang < 6)) { ?>width: 1030px;<?php } elseif (isset($_SESSION['username']) && $jr->rang >= 6) { ?>width: 1035px;<?php } ?>">
        <div id="left">
            <div class="menu">
                <li <?= $nav_en_cours === 'Accueil' ? ' id="active"' : '' ?> class="nav">
                    <a href="<?= $Configs['Url'] ?>index"><i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
                <li <?= $nav_en_cours === 'Articles' ? ' id="active"' : '' ?> class="nav">
                    <a href="<?= $Configs['Url'] ?>articles">articles</a>
                </li>
                <li class="nav">
                    <a style="cursor: default;">Communauté <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="sous_nav" style="margin-top: 30px;">
                        <i class="fa fa-caret-up" aria-hidden="true"
                           style="position: absolute;margin-top:-14px;margin-left:-65px;color: #1976d2;font-size: 17px;"></i>
                        <a href="<?= $Configs['Url'] ?>team">
                            <li <?= $nav_en_cours === 'Équipe' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>
                                Équipe
                            </li>
                        </a>
                        <a href="<?= $Configs['Url'] ?>flux">
                            <li <?= $nav_en_cours === 'Flux' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>
                                Flux
                            </li>
                        </a>
                        <a href="<?= $Configs['Url'] ?>partners">
                            <li <?= $nav_en_cours === 'Partners' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>
                                Partenaires
                            </li>
                        </a>
                        <a href="https://discord.gg/gbPF5JKHYe" target="_blank">
                            <li <?= $nav_en_cours === 'Social' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>
                                Discord
                            </li>
                        </a>
                        <a href="<?= $Configs['Url'] ?>vote">
                            <li <?= $nav_en_cours === 'Vote' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>
                                Votes du mois</li>
                        </a>
                    </ul>
                </li>
                <li <?= $nav_en_cours === 'Dédicaces' ? ' id="active"' : '' ?> class="nav">
                    <a href="<?= $Configs['Url'] ?>dedicaces">dédicace</a>
                </li>
                <li <?= $nav_en_cours === 'Security' ? ' id="active"' : '' ?> class="nav">
                    <a href="<?= $Configs['Url'] ?>secu">sécurité</a>
                </li>
            </div>
        </div>

        <div id="right">
            <div class="search-user">
                <div class="avatar"><img id="u-s-avatar"
                                         src="https://avatar.citywish.fr/?username=<?= $_SESSION['username'] ?? '' ?>&size=n&head_direction=2&headonly=1"/>
                </div>
                <input type="text" id="u-search" placeholder="Pseudo de l'utilisateur..."/>
                <a id="u-s-href" href="https://citywish.fr/profil/">
                    <div class="search"><i class="fa fa-search"></i></div>
                </a>
            </div>

            <?php if (isset($_SESSION['username'])) { ?>
                <?php if ($jr->rang < 6) { ?>
                    <a href="https://habbocity.me/" target="_blank">
                        <div class="btn"
                             style="height: 39px;width: 90px;background: url(https://citywish.fr/assets/imgs/gocity.png);-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 9px;margin-right: -3px;"
                             id="go">
                        </div>
                    </a>
                <?php } else { 
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                        ?>
                   <a href="<?= $Configs['Url'] ?>admin/" target="_blank" style="margin-right: -10px;">
                        <div class="btn" id="go">
                            administration
                        </div>
                    </a>
                <?php
                } else { ?>
                   <a href="#admin" class="open" id="open-admin" style="margin-right: -10px;">
                        <div class="btn" id="go">
                            administration
                        </div>
                    </a>
        
            <?php } } } else { ?>
                <a href="https://habbocity.me/" target="_blank" style="margin-right: 50px;">
                    <div class="btn"
                         style="height: 39px;width: 90px;background: url(https://citywish.fr/assets/imgs/gocity.png);-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 9px;"
                         id="go">
                    </div>
                </a>
            <?php } ?>

            <?php if (isset($_SESSION['username'])) { ?>
                <a>
                    <div class="btn" <?php if ($jr->rang < 6) { ?>style="margin-right: 5px;" <?php } ?> id="log"
                         style="margin-right: -4px;">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php
    if(date('M') === 'Dec') {
        ?>
        <img src="../assets/imgs/snow.png" id="snowButton" width="40" height="40"/>
    <?php } ?>
</div>

<header id="snowLimit">
    <div id="container" style="position: relative; z-index:2;">
        <div id="left">
                        <!--<img src="https://citywish.fr/assets/imgs/birthday.png"
                 style="position: absolute; height: 66px; width: 54px; margin-left:-10px; margin-top: 20px;z-index: 2;">   -->   
            <?php
            if(date('M') === 'Dec') {
            ?>
            <img src="https://citywish.fr/assets/imgs/winter.png"
                 style="image-rendering: pixelated; position: absolute; height: 100px; width: 100px; margin-left:-39px; margin-top: -5px;z-index: 2;">            
            <?php } ?>
            <div class="logo">
                <a style="color:white;">CITYWISH</a>
            </div>
            <div class="slogan">
                Toute l'actualité d'<a
                        style="color: white; text-decoration: none; cursor: pointer; transition: all 0.3s ease 0s;"
                        onmouseout="this.style='color: white;text-decoration: none;cursor: pointer;transition: 0.3s;'"
                        onmouseover="this.style='color: gray;text-decoration: none;cursor: pointer;transition: 0.3s;'"
                        href="https://habbocity.me" target="_blank"><b><?= $Configs['Retro'] ?></b></a> se trouve ici !
            </div>
        </div>
        <div id="right">
            <?php if (!isset($_SESSION['username'])) { ?>
                <a href="#connect" class="open" id="open-connect">
                    <div class="btn" id="co" style="margin-right: 10px;">
                        connexion
                    </div>
                </a>
                <a href="#register" class="open" id="open-register">
                    <div class="btn" id="in">
                        inscription
                    </div>
                </a>
            <?php } else { ?>
                <a style="color: white;" href="<?= $Configs['Url'] ?>profil/<?= $jr->name ?>">
                    <div class="btn" id="in" style="margin-right: 10px;">
                        mon profil
                    </div>
                </a>
                <a href="#settings-oy" class="open" id="open-settings-oy">
                    <div class="btn" id="co">
                        paramètres
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</header>

<?php require_once 'assets/templates/giveaways.php'; ?>