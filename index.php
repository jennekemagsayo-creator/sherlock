<?php
require 'includes/db.php';
require 'includes/functions.php';

$recent = $pdo->query("SELECT * FROM items WHERE status='Found' ORDER BY date_reported DESC LIMIT 4")->fetchAll();

$pageTitle = 'Home';
require 'includes/header.php';
?>

<section class="hero">
  <h1>Lost Something?<br>Sherlock will find it.</h1>
  <p>The easy way to report and find missing items in your neighborhood.</p>
  <div class="actions">
    <a class="btn" href="login.php">Admin login</a>
    <a class="btn" href="items.php">Browse Items</a>
  </div>
</section>

<section id="how" class="wrap">
  <h2>How It Works</h2>
  <div class="steps">
    <div class="card"><div class="ico">&#128269;</div><b>Report a Lost Item</b><p>Describe what you lost and where.</p></div>
    <div class="card"><div class="ico">&#128247;</div><b>Upload Found Items</b><p>Post a photo of what you found.</p></div>
    <div class="card"><div class="ico">&#129309;</div><b>Reconnect with Owners</b><p>Owners and finders contact each other.</p></div>
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