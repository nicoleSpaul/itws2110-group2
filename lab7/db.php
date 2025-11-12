<?php

$host = getenv('DB_HOST') ?: 'websystems.cza8yasoo5ed.us-east-2.rds.amazonaws.com';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_NAME') ?: 'websystems';
$user = getenv('DB_USER') ?: 'admin';
$pass = getenv('DB_PASS') ?: 'DGJNTKzzL01Nwk1XFjxH';

$charset = 'utf8mb4';

$dsn = "mysql:host={$host};port={$port};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "DB connection failed: " . $e->getMessage();
    exit;
}
?>