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

  <h2>Registered Users</h2>
  <body>
    <a href="{{ route('user.create') }}"
        class="nav-link">
        Tambah User
    </a>

    <br>
    <span> Filter : </span>
    <a href="{{ route('user.index') }}"
        class="nav-link {{ request()->query('filter') === 'user' && request()->is('user') ? 'active' : '' }}">
        Semua
    </a>
    <a href="{{ route('user.index', ['filter' => 'owner']) }}"
        class="nav-link {{ request()->query('filter') === 'owner' && request()->is('*owner') ? 'active' : '' }}">
        Owner
    </a>
    <a href="{{ route('user.index', ['filter' => 'manajer']) }}"
        class="nav-link {{ request()->query('filter') === 'manajer' && request()->is('*manajer') ? 'active' : '' }}">
        Manajer
    </a>
    <a href="{{ route('user.index', ['filter' => 'kasir']) }}"
        class="nav-link {{ request()->query('filter') === 'kasir' && request()->is('*kasir') ? 'active' : '' }}">
        Kasir
    </a>
    <a href="{{ route('user.index', ['filter' => 'inventaris']) }}">
        Inventaris
    </a>
    </body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->ID_User }} </td>
            <td> {{ $d->Username }} </td>
            <td> {{ $d->Role }} </td>
            <td> <a href="{{ route('user.edit', $d->ID_User) }}"> Edit </a>
                <form class="inline" action="{{ route('user.destroy', $d->ID_User) }}" method="POST" onsubmit="return confirm('Hapus {{ $d->Username }}?')">
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
