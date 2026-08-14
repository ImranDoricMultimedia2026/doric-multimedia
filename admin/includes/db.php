<?php

// Ensure PHP uses India Standard Time across the app so displayed times
// (relative and formatted) are consistent with IST / Asia-Kolkata.
// Force application timezone to IST (Asia/Kolkata) so all date/time
// formatting and relative calculations are consistent.
date_default_timezone_set('Asia/Kolkata');

function getDbConnection(): PDO
{
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $dbname = getenv('DB_NAME') ?: 'doric_admin';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
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
        throw new PDOException('Database connection failed. Please verify the local XAMPP MySQL settings.', 0, $e);
    }
}
