<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; }
    .container { width: 300px; margin: 100px auto; background: #fff; padding: 20px; border-radius: 10px; }
    input { width: 100%; padding: 8px; margin: 8px 0; }
    button { width: 100%; padding: 10px; background: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background: #0056b3; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>

    <?php if (!empty($data['error'])): ?>
      <p style="color:red;"><?= $data['error'] ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>admin/adminauth">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>