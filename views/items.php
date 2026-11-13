<?php require 'includes/header.php'; ?>

<main class="wrap">
  <h2>Browse found items</h2>

  <?php if (isset($_GET['posted'])): ?><p class="ok">Found item added.</p><?php endif; ?>
  <?php if (isset($_GET['deleted'])): ?><p class="ok">Item deleted.</p><?php endif; ?>

  <form class="search" method="get">
    <input name="q" placeholder="Search by item name or category" value="<?= e($q) ?>">
    <button class="btn" type="submit">Search</button>
  </form>

  <?php if (!$items): ?>
    <p class="empty">No items found.</p>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($items as $item): ?>
        <a class="item" href="item.php?id=<?= (int)$item['id'] ?>">
          <img src="<?= item_image($item['image_path']) ?>" alt="">
          <div>
            <b><?= e($item['item_name']) ?></b>
            <small>
              <?php if (is_admin()): ?>
                <span class="tag <?= e($item['status']) ?>"><?= e($item['status']) ?></span>
              <?php endif; ?>
              <?= e($item['category']) ?> &middot; <?= e(date('M j, Y', strtotime($item['date_reported']))) ?>
            </small>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>
