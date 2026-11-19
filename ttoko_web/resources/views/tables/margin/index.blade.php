@extends('components.layout')

@section('content')
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
@include('components.errors')

<h2> Margin Penjualan </h2>

<a href="{{ route('margin.create') }}"> Tambah Margin </a>
<br>
<span> Filter : </span>
<a href="{{ route('margin.index') }}"> Semua </a>
<a href="{{ route('margin.index', ['filter' => 'aktif']) }}"> Aktif </a>

<table>
@if(!empty($data))
    <thead>
        <tr>
            <th>Margin</th>
            <th>Status</th>
            <th>Updated At</th>
            <th>Created By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td> {{ $d->Margin }} </td>
            <td> {{ $d->Status }} </td>
            <td> {{ $d->Updated_at }} </td>
            <td> {{ $d->Created_by }} </td>
            <td> <a href="{{ route('margin.edit', $d->ID_Margin) }}"> Edit </a>
                <form class="inline" action="{{ route('margin.destroy', $d->ID_Margin) }}" method="POST"
                      onsubmit="return confirm('Hapus margin ' + @js($d->Margin) + '?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"> Hapus </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
@else
    <tbody>
        <tr>
            <td class="no-data">No margins found.</td>
        </tr>
    </tbody>
@endif
</table>
@endsection
