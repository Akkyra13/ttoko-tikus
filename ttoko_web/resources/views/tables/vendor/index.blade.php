<!-- user_table.php -->
@extends('components.layout')

@section('content')
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
@include('components.errors')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Roles</title>
</head>
<body>

  <h2>Registered Vendors</h2>
  <body>
    <a href="{{ route('vendor.create') }}"
        class="nav-link">
        Tambah Vendor
    </a>
    <br>
    <span> Filter : </span>
    <a href="{{ route('vendor.index') }}"
        class="nav-link {{ request()->query('filter') === 'user' && request()->is('user') ? 'active' : '' }}">
        Semua
    </a>
    <a href="{{ route('vendor.index', ['filter' => 'aktif']) }}"
        class="nav-link {{ request()->query('filter') === 'user' && request()->is('user') ? 'active' : '' }}">
        Aktif
    </a>
</body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>ID Vendor</th>
            <th>Nama Vendor</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->ID_Vendor }} </td>
            <td> {{ $d->Vendor }} </td>
            <td> {{ $d->Status }} </td>
            <td> <a href="{{ route('vendor.edit', $d->ID_Vendor) }}"> Edit </a>
                <form class="inline" action="{{ route('vendor.destroy', $d->ID_Vendor) }}" method="POST" onsubmit="return confirm('Hapus {{ $d->Vendor }}?')">
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
          <td class="no-data">No vendors found.</td>
        </tr>
      </tbody>
    @endif
  </table>

{{--@include('tables.atables')--}}

</body>
</html>

@endsection
