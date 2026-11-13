<?php
require 'includes/db.php';
require 'includes/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    $st = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $st->execute([$user]);
    $admin = $st->fetch();
    if ($admin && password_verify($pass, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: items.php');
        exit;
    }
    $errors[] = 'Wrong username or password.';
}

$pageTitle = 'Admin login';
require 'views/login.php';
