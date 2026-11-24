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
        <select name="location">
        <option value="">-- Choose a place --</option>
        <?php
        $places = [
          'Common areas' => ['Canteen / Cafeteria', 'Main Library', 'Gymnasium', 'Admin Building / Office', 'Main Gate / Guard House'],
          'College buildings' => ['College of Computing Studies (CCS)', 'College of Engineering', 'College of Nursing', 'College of Law', 'College of Liberal Arts', 'College of Science and Mathematics', 'College of Teacher Education', 'College of Architecture'],
          'Other' => ['Campus grounds / walkways', 'Parking area', 'Other (not listed)'],
        ];
        $saved = (string)($item['location'] ?? '');
        $known = array_merge(...array_values($places));
        if ($saved !== '' && !in_array($saved, $known, true)): ?>
          <option value="<?= e($saved) ?>" selected><?= e($saved) ?> (saved earlier)</option>
        <?php endif;
        foreach ($places as $group => $list): ?>
          <optgroup label="<?= e($group) ?>">
            <?php foreach ($list as $p): ?>
              <option value="<?= e($p) ?>"<?= $p === $saved ? ' selected' : '' ?>><?= e($p) ?></option>
            <?php endforeach; ?>
          </optgroup>
        <?php endforeach; ?>
      </select>
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
