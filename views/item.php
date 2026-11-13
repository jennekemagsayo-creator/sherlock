<?php require 'includes/header.php'; ?>

<main class="wrap narrow">
  <?php if (!$item): ?>
    <p class="empty">Item not found. <a href="items.php">Back to all items</a></p>
  <?php else: ?>
    <a href="items.php">&larr; All items</a>

    <?php if (is_admin() && isset($_GET['updated'])): ?>
      <p class="ok">Item updated.</p>
    <?php endif; ?>

    <h2>
      <?= e($item['item_name']) ?>
      <?php if (is_admin()): ?>
        <span class="tag <?= e($item['status']) ?>"><?= e($item['status']) ?></span>
      <?php endif; ?>
    </h2>

    <?php if ($item['image_path']): ?>
      <img class="detail" src="<?= e($item['image_path']) ?>" alt="">
    <?php endif; ?>

    <p>
      <b>Category:</b> <?= e($item['category']) ?><br>
      <b>Date found:</b> <?= e(date('M j, Y', strtotime($item['date_reported']))) ?>
    </p>

    <?php if (is_admin()): ?>
      <p><?= nl2br(e($item['description'])) ?></p>
      <p>
        <b>Location:</b> <?= e($item['location'] ?: 'Not given') ?><br>
        <b>Reported:</b> <?= e(date('M j, Y g:i A', strtotime($item['date_reported']))) ?><br>
        <b>Notes:</b> <?= e($item['contact_info'] ?: 'None') ?>
      </p>
      <div class="actions-row">
        <a class="btn" href="edit.php?id=<?= (int)$item['id'] ?>">Edit</a>
        <a class="btn btn-danger" href="delete.php?id=<?= (int)$item['id'] ?>">Delete</a>
      </div>
    <?php else: ?>
      <p class="ok">Is this yours? Please see the admin and describe the item (what it looks like, where and when you lost it) to claim it.</p>
    <?php endif; ?>
  <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>
