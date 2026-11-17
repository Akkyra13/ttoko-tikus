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
  @stack('styles')
</head>
<body>
  <table>
    @if(!empty($data))
      <thead>
        <tr>
          @foreach ($column as $col)
            <th>{{ $col }}</th>
          @endforeach
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $row)
          <tr>
            @foreach ($column as $value)
              <td>{{ $row->$value }}</td>
            @endforeach
                <td><a href="{{ route('barang.show', $row->ID_Item) }}"> Detil </a>
          </tr>
        @endforeach
      </tbody>
    @else
      <tbody>
        <tr>
          <td class="no-data">No records found for <?= htmlspecialchars($data) ?>.</td>
        </tr>
      </tbody>
    @endif
  </table>
