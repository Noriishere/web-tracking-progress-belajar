<?php
$judul = $judul ?? "Dashboard";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($judul) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?= BASE_URL ?>css/output.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>css/layout.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script src="<?= BASE_URL ?>js/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>favicon.ico">
  <script>
    (function() {
      const theme = localStorage.getItem('theme');
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>
</head>


<body class="transition-colors duration-300 dark:bg-background-dark ease-in-out">

  <?php require __DIR__ . '/sidebar.php'; ?>
  <?php require __DIR__ . '/navbar.php'; ?>

  <main class="layout-main p-6 dark:bg-background-dark">