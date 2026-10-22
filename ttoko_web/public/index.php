<?php

$allowedPages = [
    'dashboard' => 'dashboard.php',
    'home' => 'home.php',
    'login' => 'login.php'
];

$pageDestination = $_GET['page'] ?? 'dashboard';

$destination = $allowedPages[$pageDestination] ?? '404.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Navbar</title>
</head>
<body>

  <header>
    <nav>
      <a href="index.php?page=dashboard">Dashboard</a> |
      <a href="index.php?page=home">Home</a> |
    </nav>
  </header>

  <main>
    <?php
      // Include the targeted page file dynamically
      include $destination;
    ?>
  </main>

</body>
</html>
