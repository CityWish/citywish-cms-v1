<?php

class DatabaseManager
{
    public string $host = SQL_HOST;
    public string $user = SQL_USER;
    public string $pass = SQL_PASS;
    public string $table = SQL_BASE;

    public static ?PDO $pdo = null;

    public function __construct()
    {
        try {
            self::$pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->table . ';charset=utf8mb4', $this->user, $this->pass, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            return self::$pdo;
        } catch (\PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function connect(): ?PDO
    {
        return self::$pdo;
    }
}
