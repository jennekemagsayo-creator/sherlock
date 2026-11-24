<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle ?? 'Sherlock') ?> | Sherlock</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="nav">
  <a class="logo" href="index.php">
    <img src="images/wmsu-logo.png" alt="WMSU" class="site-logo">
    <img src="images/ccs-logo.jpeg" alt="CCS" class="site-logo">
    <span>&#128269; Sherlock</span>
  </a>
  <nav>
    <a href="index.php">Home</a>
    <a href="index.php#how">How It Works</a>
    <a href="items.php">Browse Items</a>
    <?php if (is_admin()): ?>
      <a href="report.php">Add Found Item</a>
      <a class="btn-small" href="logout.php">Log out</a>
    <?php else: ?>
      <a class="btn-small" href="login.php">Admin login</a>
    <?php endif; ?>
  </nav>
</header>
