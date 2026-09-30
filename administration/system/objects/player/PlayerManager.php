<?php
require '/var/www/citywish/administration/system/objects/player/Player.php';

class PlayerManager
{
    public function load(string $identifiant = null)
    {
        if ($identifiant === null) {
            if (sessionManager->isOnline()) {
                $identifiant = sessionManager->playerId;
                $where = 'id';
            } else {
                return null;
            }
        } else if (is_numeric($identifiant)) {
            $where = 'id';
        } else {
            $where = 'name';
        }
        $sql = db->connect()->prepare("SELECT * FROM members WHERE $where = ?");
        $sql->execute([$identifiant]);
        if ($sql->rowCount() > 0) {
            return Player($sql->fetch());
        } else {
            return null;
        }
    }
}