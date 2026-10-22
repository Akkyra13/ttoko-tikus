<!-- views/table_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <style>
    body { font-family: system-ui, sans-serif; margin: 2rem; background: #f8fafc; }
    .nav-tabs { display: flex; gap: 8px; margin-bottom: 1.5rem; }
    .nav-tabs a { padding: 10px 16px; border: 1px solid #cbd5e1; background: #fff; text-decoration: none; color: #334155; border-radius: 6px; font-weight: 500; }
    .nav-tabs a.active { background: #2563eb; color: #fff; border-color: #2563eb; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; }
    th { background: #f1f5f9; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; color: #475569; }
    tr:hover { background: #f8fafc; }
    .no-data { text-align: center; color: #64748b; font-style: italic; }
  </style>
</head>
<body>

  <h1>Database Management Dashboard</h1>

  <!-- Navigation Bar switching URL parameters -->
  <div class="nav-tabs">
    <a href="index.php?table=users" class="<?= $currentTable === 'users' ? 'active' : '' ?>">Users</a>
    <a href="index.php?table=products" class="<?= $currentTable === 'products' ? 'active' : '' ?>">Products</a>
    <a href="index.php?table=orders" class="<?= $currentTable === 'orders' ? 'active' : '' ?>">Orders</a>
    <a href="index.php?table=categories" class="<?= $currentTable === 'categories' ? 'active' : '' ?>">Categories</a>
    <a href="index.php?table=invoices" class="<?= $currentTable === 'invoices' ? 'active' : '' ?>">Invoices</a>
    <a href="index.php?table=suppliers" class="<?= $currentTable === 'suppliers' ? 'active' : '' ?>">Suppliers</a>
  </div>

  <h2><?= htmlspecialchars($pageTitle) ?></h2>

  <!-- Dynamic Table Rendering -->
  <table>
    <?php if (!empty($tableData)): ?>
      <thead>
        <tr>
          <!-- Automatically generate table headers from array keys -->
          <?php foreach (array_keys($tableData[0]) as $columnHeader): ?>
            <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $columnHeader))) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tableData as $row): ?>
          <tr>
            <?php foreach ($row as $cellValue): ?>
              <td><?= htmlspecialchars($cellValue) ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    <?php else: ?>
      <tbody>
        <tr>
          <td class="no-data">No records found for <?= htmlspecialchars($currentTable) ?>.</td>
        </tr>
      </tbody>
    <?php endif; ?>
  </table>

</body>
</html>
