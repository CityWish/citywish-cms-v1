<?php

class BddInit
{
    /**
     * @var string Le mot de passe de la base de données.
     */
    private $pass;

    /**
     * @var string L'hôte de la base de données.
     */
    private $host;

    /**
     * @var string Le nom de la base de données.
     */
    private $name;

    /**
     * @var string L'utilisateur de la base de données.
     */
    private $user;

    /**
     * @var PDO PDO de la basse de données.
     */
    private $pdo;

    /**
     * Constructeur.
     *
     * @param string $pass
     * @param string $host
     * @param string $name
     * @param string $user
     */
    public function __construct(string $pass = SQL_PASS, string $host = SQL_HOST, string $name = SQL_BASE, string $user = SQL_USER)
    {
        $this->pass = $pass;
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;

        try {
            $params = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
            $bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass, $params);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $this->pdo = $bdd;
        } catch (PDOException $e) {
            die('Nous n\'avons pas réussi à nous connecter à la base de données. Réessaye plus tard. ' . $e->getMessage());
        }
    }
    
    public function connect()
    {
        return $this->pdo;
    }

    public function htmlEntities(string $text) 
    {
        return htmlspecialchars(htmlentities(trim($text)));
    }
}