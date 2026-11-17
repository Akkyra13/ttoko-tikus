<!-- user_table.php -->
@extends('components.layout')

@section('content')
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
    <a href="{{ route('tables', ['page' => 'barang']) }}"
        class="nav-link {{ request()->query('page') === 'barang' && request()->is('tables') ? 'active' : '' }}">
        Hapus filter
    </a>
    <br>
    <a> Filter : </a>
    <a href="{{ route('tables', ['page' => 'barang-tersedia']) }}"
        class="nav-link {{ request()->query('page') === 'barang-tersedia' && request()->is('tables') ? 'active' : '' }}">
        Stok Tersedia
    </a>
    </body>

@include('tables.atable')

</body>
</html>

@endsection
