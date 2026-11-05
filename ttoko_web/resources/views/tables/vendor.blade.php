<!-- user_table.php -->
<!DOCTYPE html>
<html lang="en">
<x-layout>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Directory</title>
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

<h2>Registered Vendors</h2>

    <a href="{{ route('tables', ['page' => 'vendor']) }}"
        class="nav-link {{ request()->query('page') === 'vendor' && request()->is('tables') ? 'active' : '' }}">
        Hapus filter
    </a>
    <br>
    <a> Filter : </a>
    <a href="{{ route('tables', ['page' => 'vendor-aktif']) }}"
        class="nav-link {{ request()->query('page') === 'vendor-aktif' && request()->is('tables') ? 'active' : '' }}">
        Aktif
    </a>


  <table>
    <thead>
      <tr>
        <th>Nama Vendor</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $vendor): ?>
          <tr>
            <td><?= htmlspecialchars($vendor['Vendor']) ?></td>
            <td><?= htmlspecialchars($vendor['Status']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="no-data">No vendors found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
</x-layout>

