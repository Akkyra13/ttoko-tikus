<!-- user_table.php -->
<!DOCTYPE html>
<html lang="en">
<x-layout>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Margin Directory</title>
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

  <h2>Margins</h2>

  <table>
    <thead>
      <tr>
        <th>Jumlah Margin</th>
        <th>Updated at</th>
        <th>User</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $margin): ?>
          <tr>
            <td><?= htmlspecialchars($margin['Margin']) ?></td>
            <td><?= htmlspecialchars($margin['Updated_at']) ?></td>
            <td><?= htmlspecialchars($margin['Created_by']) ?></td>
            <td><?= htmlspecialchars($margin['Status']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="no-data">No data found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
</x-layout>

