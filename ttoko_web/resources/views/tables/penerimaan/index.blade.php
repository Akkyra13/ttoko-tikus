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
  <title>Penerimaan</title>
</head>
<body>

  <h2>Daftar Penerimaan</h2>
  <body>
    <a href="{{ route('penerimaan.create') }}"
        class="nav-link">
        Buat Penerimaan Baru
    </a>
    <br>
    <span> Filter : </span>
    <a href="{{ route('penerimaan.index') }}"
        class="nav-link {{ request()->query('filter') === 'user' && request()->is('user') ? 'active' : '' }}">
        Semua
    </a>
    <a href="{{ route('pengadaan.index', ['filter' => 'proses']) }}"
        class="nav-link {{ request()->query('filter') === 'user' && request()->is('user') ? 'active' : '' }}">
        Diproses
    </a>
</body>


    <table>
    @if(!empty($data))
    <thead>
        <tr>
            <th>ID Penerimaan</th>
            <th>Tanggal Terima</th>
            <th>ID Pengadaan</th>
            <th>Vendor</th>
            <th>Penerima</th>
            <th>Status</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->ID_Penerimaan }} </td>
            <td> {{ $d->Tanggal }} </td>
            <td> {{ $d->ID_Pengadaan }} </td>
            <td> {{ $d->Vendor }} </td>
            <td> {{ $d->Diterima_oleh }} </td>
            <td> {{ $d->Status }} </td>
            <td> {{ $d->Jumlah_Barang }} </td>
            <td> {{ $d->Nilai }} </td>
            <td> <a href="{{ route('penerimaan.show', $d->ID_Penerimaan) }}"> Detil </a>
                @if (in_array($d->Status, ['Draf', 'Diproses']))
                <form class="inline" action="{{ route('pengadaan.destroy', $d->ID_Pengadaan) }}" method="POST" onsubmit="return confirm({{ Js::from('Batalkan pengadaan #' . $d->ID_Pengadaan . ' ke ' . $d->Vendor . '?') }})">
                    @csrf
                    @method('DELETE')
                    <button type="submit" > Batal </button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    @else
      <tbody>
        <tr>
          <td class="no-data">No data found.</td>
        </tr>
      </tbody>
    @endif
  </table>

{{--@include('tables.atables')--}}

</body>
</html>

@endsection
