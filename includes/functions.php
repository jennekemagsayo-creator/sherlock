<?php
// Makes text safe to print inside HTML.
function e($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

// Returns the photo path, or a placeholder when there is no photo.
function item_image($path) {
    return $path ? e($path) : 'https://placehold.co/300x200?text=No+photo';
}
// Admin login helpers
if (session_status() === PHP_SESSION_NONE) session_start();

function is_admin() {
    return !empty($_SESSION['admin_id']);
}

function require_admin() {
    if (!is_admin()) {
        header('Location: login.php');
        exit;
    }
}
