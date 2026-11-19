@extends('components.layout')

@section('content')
<h1>{{ $data->Nama_Barang }} </h1>

<a href="{{ route('barang.index') }}"> Back </a>
<br>

<form method="POST" action="{{ route('barang.update', $data->idbarang) }}">
@csrf
@method('PUT')

<label> Nama Barang </label>
    <input name="nama"
    value="{{ old('nama', $data->Nama_Barang ?? '') }}">

<label> Jenis </label>
    <select name="jenis">
        @foreach($jenis as $d => $label)
            <option value="{{ $d }}"
            @selected(old('jenis', $data->jenis_id) === (string) $d)>
            {{ $label }}
            </option>
        @endforeach
    </select>

<label> Satuan </label>
    <select name="satuan">
        @foreach($satuan as $s)
            <option value="{{ $data->satuan_id }}"
                @selected(old('satuan', $data->satuan_id) === (int) $s->ID_Satuan)>
                {{ $s->Satuan }}
            </option>
        @endforeach
    </select>

<label> Stok </label>
    <select name="stok">
        @foreach($stok as $d => $label)
            <option value="{{ $d }}" @selected(old('stok', $data->status_id) === (string) $d)> {{ $label }} </option>
        @endforeach
    </select>

<label> Harga </label>
    <input name="harga" type="number"
    value="{{ old('harga', $data->harga_int ?? '') }}">

<button type="submit"> Save </button>
</form>
@endsection
