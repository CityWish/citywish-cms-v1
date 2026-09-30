<div class="giveaway-container opened" id="giveaway">
  <div id="giveaway-open"></div>
  <div class="giveaway-content">
    <div class="giveaway-title">Giveaways <i id="reload-giveaway" class="fa fa-rotate-right"></i></div>
    <div class="giveaway-list" id="giveaways">
      <?php 
      $sql = $bdd->prepare('SELECT * FROM giveaways ORDER BY timestamp DESC LIMIT 5');
      $sql->execute();
foreach ($sql->fetchAll() as $key => $item) {
    if(isset($_SESSION['username'])) {
        $user = $bdd->prepare('SELECT id FROM members WHERE name = ?');
        $user->execute([$_SESSION['username']]);
        $user_info = $user->fetch();
        $participated = $bdd->prepare('SELECT id_user FROM giveaways_participants WHERE id_giveaway = ? AND id_user = ?');
        $participated->execute([$item['id'], $user_info['id']]);
      }
    ?>
    <div class="giveaway-item">
      <input type="hidden" value="<?= $item['id']; ?>" class="giveaways-id" />
      <input type="hidden" value="<?= $item['timestamp']; ?>" id="giveaway-timestamp-<?= $item['id']; ?>" />
      <div class="item-title"><?= $item['title']; ?> <i class="item-nb-winners"><?= $item['nb_winners']; ?>
          gagnant(s)</i></div>
      <div class="item-timer" id="giveaway-timer-<?= $item['id']; ?>">-j -h -min et -s</div>
      <div id="giveaway-informations-<?= $item['id']; ?>">
        <?php if(time() < $item['timestamp']) { 
          if(isset($_SESSION['username'])){
          ?>
        <button class="item-btn <?= $participated->rowCount() > 0 ? 'deleting' : ''; ?>"
          id="giveaway-btn-<?= $item['id']; ?>">
          <?= $participated->rowCount() > 0 ? 'Retirer' : 'Participer'; ?>
        </button>
        <?php } else { ?>
          <button class="item-btn"
            id="giveaway-btn-<?= $item['id']; ?>">
            Participer
          </button>
        <?php } } else { 
        $sql = $bdd->prepare('SELECT id_user FROM giveaways_participants WHERE id_giveaway = ?');
        $sql->execute([$item['id']]);
        $participants = $sql->fetchAll();
        $winner = 'Aucun gagnant';
        if($item['winner'] !== null) {
            if($item['nb_winners'] > 1) {
                $winners = explode(',', $item['winner']);
                foreach ($winners as $key => $value) {
                    $sql = $bdd->prepare('SELECT name FROM members WHERE id = ?');
                    $sql->execute([$participants[$value-1]['id_user']]);
                    $winner_fetch = $sql->fetch();
                    if($key === 0) {
                        $winner = 'Gagnant(s) : '.$winner_fetch['name'] ;
                    } else {
                        $winner = $winner.', '.$winner_fetch['name'];
                    }
                }
            } else {
                $sql = $bdd->prepare('SELECT name FROM members WHERE id = ?');
                $sql->execute([$participants[$item['winner']-1]['id_user']]);
                $winner_fetch = $sql->fetch();
                $winner = 'Gagnant(e) : '.$winner_fetch['name'];
            }
        }
        ?>
        <div class="item-winners"><?= $winner; ?></div>
        <?php } ?>
      </div>
    </div>
<?php } ?>

    </div>
  </div>
</div>