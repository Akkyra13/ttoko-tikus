<!-- user_table.php -->
@extends('components.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
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

@include('tables.atable')

</body>
</html>
@endsection

