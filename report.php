<?php
require 'includes/db.php';
require 'includes/functions.php';
require_admin();

$cats   = ['Phone/Electronics', 'Wallet/Bag', 'Keys', 'Documents/ID', 'Clothing', 'Other'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['item_name'] ?? '');
    $desc    = trim($_POST['description'] ?? '');
    $cat     = in_array($_POST['category'] ?? '', $cats) ? $_POST['category'] : 'Other';
    $loc     = trim($_POST['location'] ?? '');
    $contact = trim($_POST['contact_info'] ?? '');

    if ($name === '') $errors[] = 'Enter the item name.';
    if ($desc === '') $errors[] = 'Enter a description.';

    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Image upload failed.';
        } elseif (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $errors[] = 'Image must be JPG, PNG, GIF or WEBP.';
        } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Image must be under 2 MB.';
        } else {
            $file = 'uploads/' . bin2hex(random_bytes(8)) . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/' . $file);
            $imagePath = $file;
        }
    }

    if (!$errors) {
        $st = $pdo->prepare("INSERT INTO items (item_name, description, category, status, image_path, location, contact_info, edit_code) VALUES (?,?,?,?,?,?,?,?)");
        $st->execute([$name, $desc, $cat, 'Found', $imagePath, $loc, $contact, '']);
        header('Location: items.php?posted=1');
        exit;
    }
}

$pageTitle = 'Add found item';
require 'views/report.php';
