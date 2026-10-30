<!DOCTYPE html>
<html>
<x-layout>
<body>
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
</x-layour>
