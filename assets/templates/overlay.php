<?php if (isset($_SESSION['username'])) {
    if ($jr->certif < 1) { ?>

<div id="certif" style="transform: scale(0);">
    <div id="certif-container" style="transform: scale(0);">
        <div class="top">
            <div id="left" style="width:100%;">
                <center>
                    <div class="co">
                        se certifier
                    </div>
                </center>
            </div>
        </div>
        <center>
            <?php if (isset($erreur)) {
                        echo $erreur;
                    } ?>
            <form method="post" action="?do=certif" style="margin-top: 30px;">
                <input type="password" name="pass_certif" placeholder="Votre mot de passe...">
                <div id="space"></div>
                <div style="height: auto;width: 80%;padding: 5px;background: #efefef;border-bottom: 2px solid #e2e2e2;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;transition: 0.5s;-moz-transition: 0.5s;-o-transition: 0.5s;-htm-transition: 0.5s;-webkit-transition: 0.5s;"
                    onmouseover="this.style='cursor: text;height: auto;width: 80%;padding: 5px;background: #efefef;border-bottom: 2px solid #3498db;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;transition: 0.5s;-moz-transition: 0.5s;-o-transition: 0.5s;-htm-transition: 0.5s;-webkit-transition: 0.5s;'"
                    onmouseout="this.style='height: auto;width: 80%;padding: 5px;background: #efefef;border-bottom: 2px solid #e2e2e2;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;transition: 0.5s;-moz-transition: 0.5s;-o-transition: 0.5s;-htm-transition: 0.5s;-webkit-transition: 0.5s;'">
                    <p>Pour vérifier que ton compte HabboCity t'appartient réellement, tu dois mettre le code
                        ci-dessous dans ton humeur en jeu.</p>
                </div>
                <div id="space"></div>
                <input type="text" name="code" value="<?php echo happyCertif(8, 'CW'); ?>" readonly />
                <div id="space"></div>
                <div id="space"></div>
                <input type="submit" name="succes" value="Certification"
                    style="padding-top:15px;margin-bottom: 0px;text-transform: uppercase;text-align: center;font-weight: bold;font-size: 12px;color: white;">
                <div id="space"></div>
            </form>
        </center>

    </div>
</div>
<?php } ?>
<div class="overlay" id="settings-oy" style="transform: scale(0);">
    <div class="close"></div>
    <div class="overlay-container">
        <div class="overlay-title">
            Mes paramètres
        </div>
        <!-- Changement de MDP-->
        <div class="overlay-content" id="open-newpswrd">
            Modifier mon mot de passe
        </div>
        <div class="overlay-content-in" id="newpswrd">
            <form id="newpswrd-form">
                <input id="actual-mdp" type="password" name="oldmdp" placeholder="Ton mot de passe actuel..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input id="new-mdp" type="password" name="newmdp" placeholder="Nouveau mot de passe..."
                    style="background-image: url(../assets/imgs/new_mdp.png);" />
                <input id="confirm-new-mdp" type="password" name="confirm-newmdp"
                    placeholder="Confirme ton nouveau mot de passe..."
                    style="background-image: url(../assets/imgs/confirm_new_mdp.png);" />
                <input type="submit" value="Changer mon mot de passe" />
            </form>
        </div>

        <!-- Changement de pseudo -->
        <div class="overlay-content" id="open-newpseudo">
            Modifier mon pseudonyme
        </div>
        <div class="overlay-content-in" id="newpseudo">
            <form id="newpseudo-form">
                <input id="pass-pseudo-input" type="password" name="pseudo-pass" placeholder="Ton mot de passe..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input id="pseudo-input" type="text" name="pseudo" placeholder="Ton nouveau pseudo..."
                    style="background:-5px -10px url(https://avatar.citywish.fr/?username=<?php echo $_SESSION['username']; ?>&headonly=1&head_direction=2) no-repeat #efefef;" />
                <input type="text" name="pseudo-code" value="<?php echo happyCertif(8, 'CW'); ?>" readonly
                    style="background-image: url(../assets/imgs/lock.png);" />
                <input type="submit" value="Changer mon pseudo" />
            </form>
        </div>

        <!-- Changement de description -->
        <?php
            $fetchdescp = $bdd->prepare('SELECT moto FROM members WHERE name = :username');
            $fetchdescp->execute(['username' => $_SESSION['username']]);
            $descp = $fetchdescp->fetch(PDO::FETCH_OBJ);
            ?>
        <div class="overlay-content" id="open-newdescp">
            Modifier ma description
        </div>
        <div class="overlay-content-in" id="newdescp">
            <form id="newdescp-form">
                <input id="descp-pass" type="password" name="descp-pass" placeholder="Ton mot de passe..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input id="descp-input" type="text" name="descp" placeholder="Ta nouvelle description..."
                    style="background-image: url(../assets/imgs/new_mdp.png);" value="<?php echo $descp->moto; ?>" />
                <input type="submit" value="Changer ma description" />
            </form>
        </div>

        <!-- Changement d'image personnalisée -->
        <div class="overlay-content" id="open-newimg">
            Modifier mon image personnalisée <i>(Bientôt)</i>
        </div>
        <div class="overlay-content-in" id="newimg">
            <form id="newimg-form">
                <input id="img-pass" type="password" name="img-pass" placeholder="Ton mot de passe..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input type="file" name="img-upload" style="background-image: url(../assets/imgs/files.png);" />
                <input type="submit" value="Changer mon image" />
            </form>
        </div>

        <!-- Lien avec Discord -->
        <div class="overlay-content" id="open-discord">
            Lier mon compte CityWish à mon compte Discord
        </div>
        <div class="overlay-content-in" id="discord">
            <form id="discord-form">
                <input id="discord-pass" type="password" name="discord-pass" placeholder="Ton mot de passe..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input type="submit" value="Lier mon compte Discord" />
            </form>
        </div>
    </div>
</div>

<!-- Flux Webhook -->
<div class="overlay" id="flux-webhook" style="transform: scale(0);">
    <div class="close"></div>
    <div class="overlay-container">
        <div class="overlay-title">
            Ajouter mon Webhook Discord
        </div>
        <div class="overlay-content" style="cursor: default;text-decoration: underline;">
            Formulaire d'ajout
        </div>
        <div class="overlay-content-in" style="transform: scale(1);display: block;">
            <form id="flux-webhook-form">
                <input type="text" name="name" placeholder="Le nom de votre serveur Discord..."
                    style="background-image: url(../assets/imgs/webhook.png);" />
                <input type="text" name="avatar" placeholder="Le lien du logo de votre serveur Discord..."
                    style="background-image: url(../assets/imgs/avatar-link.png);" />
                <input type="text" name="link" placeholder="L'URL du Webhook..."
                    style="background-image: url(../assets/imgs/link.png);" />
                <input type="text" name="role" placeholder="L'identifiant du rôle à mentionner... (Pas obligatoire)"
                    style="background-image: url(../assets/imgs/email.png);" />
                <label>Statut du Webhook :</label>
                <select name="onoff">
                    <option value="1">Activé</option>
                    <option value="0">Désactivé</option>
                </select>
                <input type="submit" value="Ajouter mon Webhook" />
            </form>
        </div>
    </div>
</div>

<?php if($jr->rang >= 6) { ?>
<!-- Accès Administration -->
<div class="overlay" id="admin" style="transform: scale(0);">
    <div class="close"></div>
    <div class="overlay-container">
        <div class="overlay-title">
            Accéder à l'Administration
        </div>
        <div class="overlay-content" style="cursor: default;text-decoration: underline;">
            Formulaire d'authentification
        </div>
        <div class="overlay-content-in" style="transform: scale(1);display: block;">
            <form id="auth-admin-form">
                <!--<input type="text" id="code-input" name="code"
                    placeholder="Ton code d'accès temporaire... (ex. : 123456)"
                    style="background-image: url(../assets/imgs/webhook.png);" />-->
                <div class="otp-field">
                    <input type="text" class="code-input" maxlength="1" placeholder="1"/>
                    <input type="text" class="code-input" maxlength="1" placeholder="2"/>
                    <input type="text" class="code-input" maxlength="1" placeholder="3"/>
                    <input type="text" class="code-input" maxlength="1" placeholder="4"/>
                    <input type="text" class="code-input" maxlength="1" placeholder="5"/>
                    <input type="text" class="code-input" maxlength="1" placeholder="6"/>
                </div>
                <input type="submit" id="auth-admin-code" value="M'envoyer un code"
                    style="margin-bottom:15px;background-color:#5865F2;" />
                <input type="submit" id="auth-admin-check" value="M'authentifier" />
            </form>
        </div>
    </div>
</div>
<?php } } ?>

<?php
if (!isset($_SESSION['username'])) {
    ?>
<!-- Connexion -->
<div class="overlay" id="connect" style="transform: scale(0);">
    <div class="close"></div>
    <div class="overlay-container">
        <div class="overlay-title">
            Connexion
        </div>

        <div class="overlay-content">
            Formulaire de connexion
        </div>
        <div class="overlay-content-in" style="transform: scale(1);display: block;">
            <form id="connect-form">
                <input id="connect-pseudo-input" type="text" name="pseudo" placeholder="Ton pseudonyme..."
                    style="background:-5px -10px url(https://avatar.citywish.fr/?headonly=1&head_direction=2) no-repeat #efefef;" />
                <input id="connect-pass-input" type="password" name="password" placeholder="Ton mot de passe..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input type="submit" value="Me connecter" />
            </form>
        </div>
    </div>
</div>

<!-- Inscription -->
<div class="overlay" id="register" style="transform: scale(0);">
    <div class="close"></div>
    <div class="overlay-container">
        <div class="overlay-title">
            Inscription
        </div>

        <div class="overlay-content">
            Formulaire d'inscription
        </div>
        <div class="overlay-content-in" style="transform: scale(1);display: block;">
            <form id="register-form">
                <input id="register-pseudo-input" type="text" name="pseudo" placeholder="Ton pseudonyme HabboCity..."
                    style="background:-5px -10px url(https://avatar.citywish.fr/?headonly=1&head_direction=2) no-repeat #efefef;" />
                <input type="mail" name="email" placeholder="Ton adresse mail..."
                    style="background-image: url(../assets/imgs/email.png);" />
                <input type="password" name="password" placeholder="Ton mot de passe (autre que celui de HabboCity)..."
                    style="background-image: url(../assets/imgs/old_mdp.png);" />
                <input type="password" name="password-confirm" placeholder="Confirme ton mot de passe..."
                    style="background-image: url(../assets/imgs/new_mdp.png);" />
                <div class="overlay-content">
                    Rentre le code ci-dessous dans ton humeur sur HabboCity pour prouver que le compte t'appartient
                </div>
                <input type="text" name="code" value="<?php echo happyCertif(8, 'CW'); ?>" readonly
                    style="background-image: url(../assets/imgs/lock.png);" />
                <input type="submit" value="M'inscrire" />
            </form>
        </div>
    </div>
</div>
<?php }
?>