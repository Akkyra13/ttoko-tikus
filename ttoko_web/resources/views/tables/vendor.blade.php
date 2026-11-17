<!-- user_table.php -->
@extends('components.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Directory</title>
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

@include('tables.atable')

</body>
</html>
@endsection
