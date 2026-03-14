<?php

/**
 * Separate connection for the Epsilon TMS database.
 * Used to create per-customer operational tables like {customer_id}_payroll.
 */
class TmsDatabase
{
    private \PDO $pdo;

    public function __construct()
    {
        $host = 'srv1770.hstgr.io';
        $dbName = 'u545480412_Epsilon_TMS';
        $user = 'u545480412_HP2bt';
        $pass = 'R1s2h3h4';

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $host, $dbName);

        $this->pdo = new \PDO($dsn, $user, $pass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }
}

