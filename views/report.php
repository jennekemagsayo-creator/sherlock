<?php require 'includes/header.php'; ?>

<main class="wrap narrow">
  <h2>Add a found item</h2>

  <?php foreach ($errors as $error): ?>
    <p class="error"><?= e($error) ?></p>
  <?php endforeach; ?>

  <form method="post" enctype="multipart/form-data" class="form">
    <label>Item name
      <input name="item_name" required value="<?= e($_POST['item_name'] ?? '') ?>">
    </label>

    <label>Category
      <select name="category">
        <?php foreach ($cats as $c): ?>
          <option><?= e($c) ?></option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>Description <span class="hint">(hidden from students, used to verify the owner)</span>
      <textarea name="description" rows="4" required><?= e($_POST['description'] ?? '') ?></textarea>
    </label>

    <label>Where was it found? <span class="hint">(admin only)</span>
      <select name="location">
      <option value="">-- Choose a place --</option>
      <?php
      $places = [
        'Common areas' => ['Canteen / Cafeteria', 'Main Library', 'Gymnasium', 'Admin Building / Office', 'Main Gate / Guard House'],
        'College buildings' => ['College of Computing Studies (CCS)', 'College of Engineering', 'College of Nursing', 'College of Law', 'College of Liberal Arts', 'College of Science and Mathematics', 'College of Teacher Education', 'College of Architecture'],
        'Other' => ['Campus grounds / walkways', 'Parking area', 'Other (not listed)'],
      ];
      $chosen = $_POST['location'] ?? '';
      foreach ($places as $group => $list): ?>
        <optgroup label="<?= e($group) ?>">
          <?php foreach ($list as $p): ?>
            <option value="<?= e($p) ?>"<?= $p === $chosen ? ' selected' : '' ?>><?= e($p) ?></option>
          <?php endforeach; ?>
        </optgroup>
      <?php endforeach; ?>
    </select>
    </label>

    <label>Photo (optional, max 2 MB)
      <input type="file" name="image" accept="image/*">
    </label>

    <label>Notes <span class="hint">(optional, admin only, e.g. who turned it in)</span>
      <input name="contact_info" value="<?= e($_POST['contact_info'] ?? '') ?>">
    </label>

    <button class="btn" type="submit">Add found item</button>
  </form>
</main>

<?php require 'includes/footer.php'; ?>
