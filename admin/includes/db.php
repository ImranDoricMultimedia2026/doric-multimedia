<?php

date_default_timezone_set('Asia/Kolkata');

function getDbConnection(): PDO
{
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'u754812051_doric_admin';
    $user = getenv('DB_USER') ?: 'u754812051_doricadmin';
    $pass = getenv('DB_PASS') ?: 'YOUR_DATABASE_PASSWORD';

    $charset = 'utf8mb4';

    $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException(
            'Database connection failed. Please verify the database credentials.',
            0,
            $e
        );
    }
}