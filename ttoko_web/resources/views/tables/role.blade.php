<!-- role_table.php -->
<!DOCTYPE html>
<html lang="en">
<x-layout>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Role Directory</title>
  <style>
    body { font-family: system-ui, -apple-system, sans-serif; margin: 2rem; background: #f8fafc; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; }
    th { background-color: #f1f5f9; font-weight: 600; color: #334155; }
    tr:hover { background-color: #f8fafc; }
    .no-data { text-align: center; color: #64748b; font-style: italic; }
  </style>
</head>
<body>

  <h2>Registered Roles</h2>

  <table>
    <thead>
      <tr>
        <th>Role ID</th>
        <th>Role</th>
        <th>Users</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $role): ?>
          <tr>
            <td><?= htmlspecialchars($role['ID_Role']) ?></td>
            <td><?= htmlspecialchars($role['Role']) ?></td>
            <td><?= htmlspecialchars($role['Users']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="no-data">No roles found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
</x-layout>

