<?php

/**
 * Permet de gérer l'API d'HabboCity (version spéciale pour CityWish).
 *
 * Basé sur le code de Tintin.
 *
 * @author -Propre <adou.alais@gmail.com>
 * @author Tintin
 */
class ApiHabboCity
{

    /**
     * @var array|null Contenu de la dernière requête.
     */
    private $data;
    
    /**
     * @var string|null Contenu de l'erreur.
     */
    private $erreur = null;

    /**
     * Constructeur.
     *
     * @param string $username Le pseudonyme du joueur.
     * @param string $api_key  L'API key fournie par le support.
     */
    public function __construct(string $identifiant, string $api_key)
    {
        if (is_numeric($identifiant)) {
            $this->data = $this->callAPI("https://api.habbocity.me/avatar_info.php?key={$api_key}&uniqueId={$identifiant}&selectedBadges");
        } else {
            $this->data = $this->callAPI("https://api.habbocity.me/avatar_info.php?key={$api_key}&user={$identifiant}&selectedBadges");
        }
    }

    /**
     * Permet d'obtenir l'ID de l'utilisateur.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->data['uniqueId'] ?? null;
    }

    /**
     * Permet d'obtenir le pseudonyme de l'utilisateur.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    /**
     * Permet d'obtenir l'humeur (ou mission) de l'utilisateur.
     *
     * @return string|null
     */
    public function getMission(): ?string
    {
        return $this->data['motto'] ?? null;
    }

    /**
     * Permet d'obtenir la figure (look) de l'utilisateur.
     *
     * @return string|null
     */
    public function getFigure(): ?string
    {
        return $this->data['figure'] ?? null;
    }

    /**
     * Permet d'obtenir l'url de l'avatar de l'utilisateur.
     *
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->data['avatar'] ?? null;
    }

    /**
     * Permet d'obtenir le statut de connexion de l'utilisateur sur le jeu.
     *
     * @return bool|null
     */
    public function getOnline(): ?bool
    {
        return $this->data['online'] ?? null;
    }

    /**
     * Permet d'obtenir la date d'inscription de l'utilisateur.
     *
     * @return string|null
     */
    public function getRegister(): ?string
    {
        return $this->data['register'] ?? null;
    }

    /**
     * Permet d'obtenir le genre de l'utilisateur.
     *
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->data['gender'] ?? null;
    }

    /**
     * Permet d'obtenir la liste des badges de l'utilisateur.
     *
     * @return array|null
     */
    public function getListBadge(): ?array
    {
        return $this->data['selectedBadges'] ?? null;
    }

    /**
     * Permet d'obtenir la liste des groupes de l'utilisateur.
     *
     * @return array|null
     */
    public function getListGroupe(): ?array
    {
        return $this->data['groups'] ?? null;
    }

    /**
     * Permet d'obtenir le contenu de l'erreur lors de la connexion à l'API.
     *
     * @return string|null
     */
    public function getErreur(): ?string
    {
        return $this->erreur;
    }

    /**
     * Appelle l'API d'HabboCity.
     *
     * @param string $url L'URL à appeler.
     *
     * @return array|null
     */
    private function callAPI(string $url): ?array
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_USERAGENT => 'CityWish (+' . citywishBaseUrl() . ')',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true
        ]);

        $data = curl_exec($curl);

        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            curl_close($curl);
            $this->erreur = 'Nous n\'avons pas réussi à effectuer la requête vers le serveur d\'HabboCity.';
            return null;
        }
        $json = json_decode($data, true);
        if (!$json) {
            curl_close($curl);
            $this->erreur = 'HabboCity est en maintenance.';
            return null;
        }
        if (array_key_exists('type', $json) && $json['type'] === 'error') {
            curl_close($curl);
            $this->erreur = $json['message'];
            return null;
        }

        curl_close($curl);
        return $json;
    }
}
