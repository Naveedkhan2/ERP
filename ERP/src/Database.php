<?php

class Database
{
    private \PDO $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['db_host'], $config['db_name']);

        $this->pdo = new \PDO($dsn, $config['db_user'], $config['db_pass'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }
}

