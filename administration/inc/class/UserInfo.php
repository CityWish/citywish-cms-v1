<?php
class UserInfo
{
    private $id;
    private $id_discord;
    private $discord_tokens;
    private $name;
    private $uniqueId;
    private $mail;
    private $password;
    private $rang;
    private $moto;
    private $genre;
    private $certif;
    private $hide;
    private $point_staff;
    private $stats_staff;
    private $jetons;
    private $points;
    private $activ_p_s;
    private $fonction;
    private $vote;
    private $ip_adresse;
    private $ban;
    private $error = null;

    public function __construct(string $identifiant)
    {
        if(is_numeric($identifiant)){
            $this->id = $identifiant;
        } else {
            $sql = db->connect()->prepare('SELECT id FROM members WHERE name = ?');
            $sql->execute([$identifiant]);
            if($sql->rowCount() > 0) {
                $this->id = $sql->fetch()['id'];
            } else {
                return $this->error = 'Utilisateur introuvable1';
            }
        }
        $this->getInfo();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getIdDiscord() {
        return $this->id_discord;
    }

    public function getDiscordTokens() {
        return $this->discord_tokens;
    }

    public function getName() {
        return $this->name;
    }

    public function getAvatar(int $direction = 3, int $head_direction = 3, string $size = 'n', string $gesture = 'sml', string $action = 'std', int $headonly = 0) {
        return 'https://avatar.citywish.fr/?username='.$this->name.'&direction='.$direction.'&head_direction='.$head_direction.'&size='.$size.'&gesture='.$gesture.'&action='.$action.'&headonly='.$headonly;
    }
    
    public function getUniqueId() {
        return $this->uniqueId;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRang() {
        return $this->rang;
    }

    public function getMoto() {
        return $this->moto;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getCertif() {
        return $this->certif;
    }

    public function getHide() {
        return $this->hide;
    }

    public function getPointStaff() {
        return $this->point_staff;
    }

    public function getStatsStaff() {
        return $this->stats_staff;
    }

    public function getJetons() {
        return $this->jetons;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getActivPS() {
        return $this->activ_p_s;
    }

    public function getFonction() {
        return $this->fonction;
    }

    public function getVote() {
        return $this->vote;
    }

    public function getIpAdresse() {
        return $this->ip_adresse;
    }

    public function getBan() {
        return $this->ban;
    }

    public function getError() {
        return $this->error;
    }

    private function getInfo()
    {
        $sql = db->connect()->prepare('SELECT * FROM members WHERE id = ?');
        $sql->execute([$this->getId()]);
        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();
            foreach ($user as $column => $value) {
                $this->{$column} = $value;
            }
        } else {
            $this->error = 'Utilisateur introuvable';
        }
    }

    public function hasPermissions($perm): bool
    {
        if ($perm === 'index') {
            return true;
        }
        $sql = db->connect()->prepare('SELECT perms_name FROM members_perms WHERE id_member = ?');
        $sql->execute([$this->getId()]);
        $permissions = explode(',', $sql->fetch()['perms_name']);
        foreach ($permissions as $value) {
            if ($value === $perm || $value === 'all') {
                return true;
            }
        }
        return false;
    }
}