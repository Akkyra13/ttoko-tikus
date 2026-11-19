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
  <title>Inventory</title>
</head>
<body>

  <h2>Inventory Items</h2>
  <body>
    <a href="{{ route('barang.create') }}"
        class="nav-link">
        Tambah Barang
    </a>

    <br>
    <span> Filter : </span>
    <a href="{{ route('barang.index') }}"
        class="nav-link {{ request()->query('filter') === 'barang' && request()->is('barang') ? 'active' : '' }}">
        Semua
    </a>
    <a href="{{ route('barang.index', ['filter' => 'tersedia']) }}"
        class="nav-link {{ request()->query('filter') === 'tersedia' && request()->is('*tersedia') ? 'active' : '' }}">
        Stok Tersedia
    </a>
    </body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>ID Barang</th>
            <th>Jenis</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->idbarang }} </td>
            <td> {{ $d->Jenis }} </td>
            <td> {{ $d->Nama_Barang }} </td>
            <td> {{ $d->Satuan }} </td>
            <td> {{ $d->Stok }} </td>
            <td> {{ $d->Harga }} </td>
            <td> <a href="{{ route('barang.edit', $d->idbarang) }}"> Edit </a>
                <form class="inline" action="{{ route('barang.destroy', $d->idbarang) }}" method="POST" onsubmit="return confirm('Hapus {{ $d->Nama_Barang }}?')">
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
