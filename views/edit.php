<?php require 'includes/header.php'; ?>

<main class="wrap narrow">
  <?php if (!$item): ?>
    <p class="empty">Item not found. <a href="items.php">Back to all items</a></p>
  <?php else: ?>
    <h2>Edit item</h2>

    <?php foreach ($errors as $error): ?>
      <p class="error"><?= e($error) ?></p>
    <?php endforeach; ?>

    <form method="post" class="form">
      <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">

      <label>Item name
        <input name="item_name" required value="<?= e($item['item_name']) ?>">
      </label>

      <label>Category
        <select name="category">
          <?php foreach ($cats as $c): ?>
            <option <?= $c === $item['category'] ? 'selected' : '' ?>><?= e($c) ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label>Description
        <textarea name="description" rows="4" required><?= e($item['description']) ?></textarea>
      </label>

      <label>Where it was found
        <input name="location" value="<?= e($item['location']) ?>">
      </label>

      <label>Notes
        <input name="contact_info" value="<?= e($item['contact_info']) ?>">
      </label>

      <button class="btn" type="submit">Save changes</button>
    </form>
    <p><a class="btn btn-secondary" href="item.php?id=<?= (int)$item['id'] ?>">Cancel</a></p>
  <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>
