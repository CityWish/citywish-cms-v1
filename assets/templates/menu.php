<div id="barre">
    <div id="container">
        <div id="left">
            <div class="menu">
                <li <?= $nav_en_cours === 'Accueil' ? ' id="active"' : '' ?> class="nav">
                    <a href="./index">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li <?= $nav_en_cours === 'Articles' ? 'id=active' : '' ?> class="nav">
                    <a href="./articles">Articles</a>
                </li>
                <li class="nav">
                    <a style="cursor: default;">Communauté <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="sous_nav" style="margin-top: 30px;">
                        <i class="fa fa-caret-up" aria-hidden="true" style="position: absolute;margin-top:-14px;margin-left:-65px;color: #1976d2;font-size: 17px;"></i>
                        <a href="./team">
                            <li <?= $nav_en_cours === 'Équipe' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>Équipe</li>
                        </a>
                        <a href="./flux">
                            <li <?= $nav_en_cours === 'Vote' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>Flux</li>
                        </a>
                        <a href="./partners">
                            <li <?= $nav_en_cours === 'Partners' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>Partenaires</li>
                        </a>
                        <a href="https://discord.gg/gbPF5JKHYe" target="_blank">
                            <li <?= $nav_en_cours === 'Social' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>Discord</li>
                        </a>
                        <a href="./vote">
                            <li <?= $nav_en_cours === 'Vote' ? ' style="background-color: #EAEAEA; border-left: 2px solid #1976d2;"' : '' ?>>Vote staff du mois</li>
                        </a>                    
                    </ul>
                </li> 
                <li <?= $nav_en_cours === 'Dédicaces' ? 'id=active' : '' ?> class="nav">
                    <a href="./dedicaces">Dédicaces</a>
                </li>
                <li <?= $nav_en_cours === 'Security' ? 'id=active' : '' ?> class="nav">
                    <a href="./secu">Sécurité</a>
                </li>
            </div>
        </div>
        <div id="right">
            <div class="search-user">
                <input type="text" id="u-search" placeholder="Pseudo de l'utilisateur..."/>
                <a id="u-s-href" href="<?= $Configs['Url'] ?>profil/">
                    <div class="search"><i class="fa fa-search"></i></div>
                </a>
            </div>
            <a href="https://habbocity.me" target="_blank">
                <div class="btn" id="btn-gocity"></div>
            </a>
            <div class="btn" id="btn-logout"></div>
        </div>
        <a href="./admin/"></a>
    </div>
</div>

