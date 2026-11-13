<?php require 'includes/header.php'; ?>

<main class="wrap narrow">
  <?php if (!$item): ?>
    <p class="empty">Item not found. <a href="items.php">Back to all items</a></p>
  <?php else: ?>
    <h2>Delete "<?= e($item['item_name']) ?>"?</h2>
    <p>This cannot be undone.</p>

    <form method="post" class="form">
      <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
      <button class="btn btn-danger" type="submit">Yes, delete this item</button>
    </form>
    <p><a class="btn btn-secondary" href="item.php?id=<?= (int)$item['id'] ?>">Cancel</a></p>
  <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>
