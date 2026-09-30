<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../../bdd.php';

if (isset($bdd) && !empty($_SESSION['username'])) {
    $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
    $user->execute([$_SESSION['username']]);
    $webhooks = $bdd->prepare('SELECT id,link,name,avatar,role,onoff FROM flux_webhook WHERE id_user = ?');
    $webhooks->execute([$user->fetch(PDO::FETCH_OBJ)->id]);
    if($webhooks->rowCount() < 3){
        ?>
        <div class="error-v open" id="open-flux-webhook" style="background-color:#1976d2;margin-top:0;<?php if($webhooks->rowCount() === 0){ echo 'margin-bottom:0;';}?>">
        Clique-ici pour
        connecter ton Webhook Discord au flux de CityWish.
        </div>
        <?php
    }
    ?>
        <div>
                <?php
                while ($webhook = $webhooks->fetch(PDO::FETCH_OBJ)) {
            ?>
            <form class="list-webhooks">
                <div class="webname"><?= $webhook->name ?></div>
                <div class="webhook">
                    <input type="text" style="display: none;" name="id" value="<?= $webhook->id ?>"/>
                    <div class="field">
                        <label>Nom du Webhook :</label>
                        <input type="text" name="name" placeholder="Le nom du Webhook..."
                               value="<?= $webhook->name ?>"/>
                    </div>
                    <div class="field" style="margin-right: 0;">
                        <label>Lien de l'avatar du Webhook :</label>
                        <input type="text" name="avatar" placeholder="Le lien de l'avatar du Webhook..."
                               value="<?= $webhook->avatar ?>"/>
                    </div>
                    <div class="field">
                        <label>Lien du Webhook :</label>
                        <input type="text" name="link" placeholder="Le lien du Webhook..."
                               value="<?= $webhook->link ?>"/>
                    </div>
                    <div class="field" style="margin-right: 0;">
                        <label>Identifiant du rôle à mentionner :</label>
                        <input type="text" name="role" placeholder="L'identifiant du rôle à mentionner..."
                               value="<?= $webhook->role ?>"/>
                    </div>
                    <div class="field">
                        <label style="display: block;width: 100%;">Statut du Webhook :</label>
                        <select name="onoff">
                            <option value="1" <?php if ($webhook->onoff === 1) {
                                echo 'selected';
                            } ?>>Activé
                            </option>
                            <option value="0" <?php if ($webhook->onoff === 0) {
                                echo 'selected';
                            } ?>>Désactivé
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="submit-btn" value="edit">Enregistrer les modifications</button>
                    <button type="submit" class="submit-btn" value="delete">Supprimer le Webhook</button>
                </div>
            </form>
            <?php
        }
} else { ?>
    <div class="error-v" style="margin-top:0;">
    Tu es déconnecté. Connecte-toi pour pouvoir accéder à tes Webhooks.
    </div>
<?php
}
