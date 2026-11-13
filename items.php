<?php
require 'includes/db.php';
require 'includes/functions.php';

$q = trim($_GET['q'] ?? '');

$sql    = "SELECT * FROM items WHERE 1=1";
$params = [];

if (!is_admin()) {
    $sql .= " AND status = 'Found'";
}

if ($q !== '') {
    if (is_admin()) {
        $sql .= " AND (item_name LIKE ? OR description LIKE ? OR location LIKE ? OR category LIKE ?)";
        $params = ["%$q%", "%$q%", "%$q%", "%$q%"];
    } else {
        $sql .= " AND (item_name LIKE ? OR category LIKE ?)";
        $params = ["%$q%", "%$q%"];
    }
}

$sql .= " ORDER BY date_reported DESC";
$st = $pdo->prepare($sql);
$st->execute($params);
$items = $st->fetchAll();

$pageTitle = 'Browse items';
require 'views/items.php';
