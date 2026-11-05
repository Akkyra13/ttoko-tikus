<!-- user_table.php -->
<!DOCTYPE html>
<html lang="en">
<x-layout>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
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

  <h2>Registered Users</h2>

    <a href="{{ route('tables', ['page' => 'user']) }}"
        class="nav-link {{ request()->query('page') === 'user' && request()->is('tables') ? 'active' : '' }}">
        Hapus filter
    </a>
    <br>
    <a> Filter : User Roles</a>
    <br>
    <a href="{{ route('tables', ['page' => 'user-kasir']) }}"
        class="nav-link {{ request()->query('page') === 'user-kasir' && request()->is('tables') ? 'active' : '' }}">
        Kasir
    </a>
    <a href="{{ route('tables', ['page' => 'user-inventaris']) }}"
        class="nav-link {{ request()->query('page') === 'user-inventaris' && request()->is('tables') ? 'active' : '' }}">
        Inventaris
    </a>
    <a href="{{ route('tables', ['page' => 'user-manajer']) }}"
        class="nav-link {{ request()->query('page') === 'user-manajer' && request()->is('tables') ? 'active' : '' }}">
        Manajer
    </a>


  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['Username']) ?></td>
            <td><?= htmlspecialchars($user['Role']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="no-data">No users found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
</x-layout>

