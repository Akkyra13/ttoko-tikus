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
  <title>User Roles</title>
</head>
<body>

  <h2>Registered Users</h2>
  <body>
    <a href="{{ route('role.create') }}"
        class="nav-link">
        Tambah Role
    </a>

    <br>
</body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>ID Role</th>
            <th>Role</th>
            <th>Jumlah akun</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->ID_Role }} </td>
            <td> {{ $d->Role }} </td>
            <td> {{ $d->Users }} </td>
            <td> <a href="{{ route('role.edit', $d->ID_Role) }}"> Edit </a>
                <form class="inline" action="{{ route('role.destroy', $d->ID_Role) }}" method="POST" onsubmit="return confirm('Hapus {{ $d->Role }}?')">
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
