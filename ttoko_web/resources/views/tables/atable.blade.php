<!DOCTYPE html>
<html>
<head>
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
  <table>
    <?php if (!empty($currentTable)): ?>
      <thead>
        <tr>
          <!-- Automatically generate table headers from array keys -->
          <?php foreach (array_keys($currentTable[0]) as $columnHeader): ?>
            <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $columnHeader))) ?></th>
                                            <!-- str_replace('yang di ganti', 'jadi apa', 'dari string apa') -->
          <?php endforeach; ?>
            <th><?= htmlspecialchars('Action') ?></th>
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
