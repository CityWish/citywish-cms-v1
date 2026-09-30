<?php
require_once '../../core.php';

$search = str_replace(' ', '', $_POST['value-search']);
$statut = $_GET['type'];
if ($statut === 'staff') {
    $page_title = 'Staff';
    $bg_color = '#DE2222';
    $max_rang = 11;
    $min_rang = 7;
    $limit = 24;
} elseif ($statut === 'member') {
    $page_title = 'Membre';
    $bg_color = '#00BFA5';
    $max_rang = 6;
    $min_rang = 1;
    $limit = 24;
}
if ($search !== null) {
    ?>
    <?php
    $votesql = $bdd->prepare("SELECT id,name,rang,vote FROM members WHERE name LIKE :search AND rang >= :minrang AND rang <= :maxrang AND certif = :certif ORDER BY vote DESC, name ASC LIMIT $limit");
    $votesql->execute(['search' => $search . '%', 'minrang' => $min_rang, 'maxrang' => $max_rang, 'certif' => 1]);
    while ($users = $votesql->fetch(PDO::FETCH_OBJ)) {
        if ($users->vote > 1) {
            $vote_s = $users->vote . ' votes';
        } elseif ($users->vote < 2) {
            $vote_s = $users->vote . ' vote';
        }
        ?>
        <div class="user-v <?= $_GET['type'] ?>"
             style="background-image: url(https://avatar.citywish.fr/?username=<?= $users->name; ?>&headonly=0&direction=3&head_direction=3&gesture=sml)">
            <div class="header" style="background-color: <?= $bg_color ?>;"><?= $page_title ?></div>
            <?php
            $stylev = $bdd->prepare('SELECT id_users,id_whovote FROM vote WHERE id_users = ? AND id_whovote = ?');
            $stylev->execute([$users->id, $jr->id]);
            if ($stylev->rowCount() < 1) {
                ?>
                <div class="footer h-vote">
                    <div class="pseudo"><?= $users->name; ?></div>
                    <div class="votes"><?= $vote_s; ?></div>
                    <div class="check-v"></div>
                </div>
                <?php
            } elseif ($stylev->rowCount() > 0) {
                ?>
                <div class="footer h-unvote">
                    <div class="pseudo"><?= $users->name; ?></div>
                    <div class="votes"><?= $vote_s; ?></div>
                    <div class="uncheck-v"></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
} ?>
