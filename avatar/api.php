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
     * @param string $identifiant Le pseudonyme/l'id du joueur.
     * @param string $api_key  L'API key fournie par le support.
     */
    public function __construct(string $identifiant, string $api_key)
    {
        if (is_numeric($identifiant)) {
            $this->data = $this->callAPI("https://api.habbocity.me/avatar_info.php?key={$api_key}&uniqueId={$identifiant}");
        } else {
            $this->data = $this->callAPI("https://api.habbocity.me/avatar_info.php?key={$api_key}&user={$identifiant}");
        }
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
            CURLOPT_USERAGENT => 'CityWish (+https://citywish.fr)',
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
