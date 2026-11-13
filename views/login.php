<?php require 'includes/header.php'; ?>

<main class="wrap narrow">
  <h2>Admin login</h2>

  <?php foreach ($errors as $error): ?>
    <p class="error"><?= e($error) ?></p>
  <?php endforeach; ?>

  <form method="post" class="form">
    <label>Username
      <input name="username" required>
    </label>
    <label>Password
      <input type="password" name="password" required>
    </label>
    <button class="btn" type="submit">Log in</button>
  </form>
</main>

<?php require 'includes/footer.php'; ?>
