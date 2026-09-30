<?php

class Player extends ObjectBase
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

    public function __construct($fetchAll)
    {
        if ($fetchAll != null) {
            $this->initAttributes($fetchAll);
        }
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

    public function getAvatar(int $direction = 3, int $head_direction = 3, string $size = 'n', string $gesture = 'sml', string $action = 'std', int $headonly = 0): string
    {
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

    public function hasPermissions($perm): bool
    {
        if ($perm === 'index') {
            return true;
        }
        $sql = db->connect()->prepare('SELECT ranks FROM cw_staffs WHERE id = ?');
        $sql->execute([$this->getId()]);
        $permissions = explode(',', $sql->fetch()['ranks']);
        foreach ($permissions as $value) {
            if ($value === $perm || $value === 'all') {
                return true;
            }
        }
        return false;
    }
}