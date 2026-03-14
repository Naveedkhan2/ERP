<?php

// Simple config file for database connection used by src/Database.php.
// Update these values to match your MySQL (Hostinger) database.
// You can also override them with environment variables DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT.

return [
    'db_host' => getenv('DB_HOST') ?: 'srv1770.hstgr.io',
    'db_name' => getenv('DB_NAME') ?: 'u545480412_ERP',
    'db_user' => getenv('DB_USER') ?: 'u545480412_SA',
    'db_pass' => getenv('DB_PASSWORD') ?: 'R1s2h3h4',
    'db_port' => getenv('DB_PORT') ?: '3306',
];

