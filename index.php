<?php
require 'includes/db.php';
require 'includes/functions.php';
$recent = $pdo->query("SELECT * FROM items WHERE status='Found' ORDER BY date_reported DESC LIMIT 4")->fetchAll();

$pageTitle = 'Home';
require 'includes/header.php';
?>

<section class="hero">
  <h1>Lost Something on Campus?<br>Sherlock will find it.</h1>
  <p>The WMSU Lost &amp; Found: browse items found around Western Mindanao State University and claim yours at the admin office.</p>
  <div class="actions">
    <a class="btn" href="login.php">Admin login</a>
    <a class="btn" href="items.php">Browse Items</a>
  </div>
</section>

<section id="how" class="wrap">
  <h2>How It Works</h2>
  <div class="steps">
    <div class="card"><div class="ico">&#128269;</div><b>Browse Found Items</b><p>Check the items found around the WMSU campus, posted with a photo and where they were found.</p></div>
    <div class="card"><div class="ico">&#128247;</div><b>Spot Your Item</b><p>Match the photo, description, and place. Found items are posted by the WMSU admin office.</p></div>
    <!-- TODO: put the exact admin office location in the third card if the school has one (building / room). -->
    <div class="card"><div class="ico">&#129309;</div><b>Claim It at the Admin Office</b><p>Go to the admin office and bring your school ID to claim your item.</p></div>
  </div>

  <h2>Recently Found Items</h2>
  <?php if (!$recent): ?>
    <p class="empty">No found items yet. <a href="report.php?type=Found">Report the first one.</a></p>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($recent as $item): ?>
        <a class="item" href="item.php?id=<?= (int)$item['id'] ?>">
          <img src="<?= item_image($item['image_path']) ?>" alt="">
          <div>
            <b><?= e($item['item_name']) ?></b>
            <small><?= e(date('M j, Y', strtotime($item['date_reported']))) ?></small>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
