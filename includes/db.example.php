<?php
// Connects to the MySQL database that lives in the VM.
// WSL reaches the VM through Windows: port 3307 is forwarded to the VM's MySQL.
$DB_HOST = trim((string)shell_exec("ip route show | grep default | awk '{print \$3}'"));
$DB_PORT = 3307;
$DB_NAME = 'lost_and_found_db';
$DB_USER = 'wsl_user';
$DB_PASS = 'YOUR_DB_PASSWORD';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}
