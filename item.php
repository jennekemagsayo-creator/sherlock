<?php
require 'includes/db.php';
require 'includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$st->execute([$id]);
$item = $st->fetch();

if ($item && !is_admin() && $item['status'] !== 'Found') {
    $item = false;
}

$pageTitle = $item ? $item['item_name'] : 'Item not found';
require 'views/item.php';
