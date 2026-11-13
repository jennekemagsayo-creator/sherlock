<?php
require 'includes/db.php';
require 'includes/functions.php';
require_admin();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$st->execute([$id]);
$item = $st->fetch();

$cats   = ['Phone/Electronics', 'Wallet/Bag', 'Keys', 'Documents/ID', 'Clothing', 'Other'];
$errors = [];

if ($item && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['item_name'] ?? '');
    $desc    = trim($_POST['description'] ?? '');
    $cat     = in_array($_POST['category'] ?? '', $cats) ? $_POST['category'] : 'Other';
    $loc     = trim($_POST['location'] ?? '');
    $contact = trim($_POST['contact_info'] ?? '');

    if ($name === '') $errors[] = 'Enter the item name.';
    if ($desc === '') $errors[] = 'Enter a description.';

    if (!$errors) {
        $st = $pdo->prepare("UPDATE items SET item_name=?, description=?, category=?, location=?, contact_info=? WHERE id=?");
        $st->execute([$name, $desc, $cat, $loc, $contact, $id]);
        header('Location: item.php?id=' . $id . '&updated=1');
        exit;
    }

    $item['item_name']    = $name;
    $item['description']  = $desc;
    $item['category']     = $cat;
    $item['location']     = $loc;
    $item['contact_info'] = $contact;
}

$pageTitle = 'Edit item';
require 'views/edit.php';
