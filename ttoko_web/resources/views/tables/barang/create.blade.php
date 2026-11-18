@extends('components.layout')

@section('content')
<h1> Tambah Barang </h1>

<a href="{{ route('barang.index') }}"> Back </a>
<br>

<form method="POST" action="{{ route('barang.store') }}" >
@csrf


<label>Nama Barang</label>
<input name="nama" value="{{ old('nama', '') }}">
<br>

<label>Jenis</label>
<select name="jenis">
    <option value="" disabled @selected(old('jenis') === null)> Pilih </option>
@foreach($jenis as $j => $jnam)
    <option value="{{ $j }}" @selected(old('jenis') === $j)> {{ $jnam }} </option>
@endforeach
</select>
<br>

<label>Satuan</label>
<select name="satuan">
    <option value="" disabled @selected(old('satuan') === null)> Pilih </option>
@foreach($satuan as $s)
    <option value="{{ $s->ID_Satuan }}" @selected((string) old('satuan') === (string) $s->ID_Satuan )> {{ $s->Satuan }} </option>
@endforeach
</select>
<br>

<label>Harga</label>
<input name="harga" type="number" value="{{ old('harga', '') }}">
<br>
<br>
<button type="submit"> Add </button>

</form>

@endsection
