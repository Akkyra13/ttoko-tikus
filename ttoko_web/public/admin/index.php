<?php

include_once('bootstrap.php');

$tableMap = [
    'users'      => ['class' => User::class,     'method' => 'getUsers']
];

$table = $_GET['table'] ?? '';

// $config = $tableMap[$table];
// $modelClass = $config['class'];
// $methodName = $config['method'];
//
// $modelInstance = new $modelClass();
// $tableData = $modelInstance->$methodName();
// $pageTitle = $config['title'];
//
// // 5. Load view
// require_once 'view/table_view.php';
//
$allowedPages = [
    'dashboard' => 'admindashboard.php',
    'logout' => 'logout.php'
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
      <a href="admin.php?page=dashboard">Admin Dashboard</a> |
      <a href="admin.php?page=logout">Logout</a> |
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
