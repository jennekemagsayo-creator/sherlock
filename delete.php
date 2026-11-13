<?php
require 'includes/db.php';
require 'includes/functions.php';
require_admin();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$st->execute([$id]);
$item = $st->fetch();

$errors = [];

if ($item && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("DELETE FROM items WHERE id = ?")->execute([$id]);

    if ($item['image_path'] && strpos($item['image_path'], 'uploads/') === 0) {
        @unlink(__DIR__ . '/' . $item['image_path']);
    }

    header('Location: items.php?deleted=1');
    exit;
}

$pageTitle = 'Delete item';
require 'views/delete.php';
