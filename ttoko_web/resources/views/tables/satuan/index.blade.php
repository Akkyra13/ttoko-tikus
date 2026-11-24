<!-- user_table.php -->
@extends('components.layout')

@section('content')
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unit of Measurements</title>
</head>
<body>

  <h2>Unit of Measurements</h2>
  <body>
    <a href="{{ route('satuan.create') }}"
        class="nav-link">
        Tambah Satuan
    </a>

    <br>
    <span> Filter : </span>
    <a href="{{ route('satuan.index') }}"
        class="nav-link {{ request()->query('filter') === 'satuan' && request()->is('satuan') ? 'active' : '' }}">
        Semua
    </a>
    <a href="{{ route('satuan.index', ['filter' => 'aktif']) }}"
        class="nav-link {{ request()->query('filter') === 'aktif' && request()->is('*aktif') ? 'active' : '' }}">
        Aktif
    </a>
    <a href="{{ route('satuan.index', ['filter' => 'nonaktif']) }}"
        class="nav-link {{ request()->query('filter') === 'nonaktif' && request()->is('*nonaktif') ? 'active' : '' }}">
        Non-Aktif
    </a>
    </body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>Satuan</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->Satuan }} </td>
            <td> {{ $d->Status }} </td>
            <td> <a href="{{ route('satuan.edit', $d->ID_Satuan) }}"> Edit </a>
                <form class="inline" action="{{ route('satuan.destroy', $d->ID_Satuan) }}" method="POST" onsubmit="return confirm({{ Js::from('Hapus ' . $d->Satuan . '?') }})">
                    @csrf
                    @method('DELETE')
                    <button type="submit" > Hapus </button>
                </form>
            </td>
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

{{--@include('tables.atables')--}}

</body>
</html>

@endsection
