@extends('components.layout')

@section('content')
<h1> Buat Pengadaan </h1>

<a href="{{ route('pengadaan.index') }}"> Back </a>
<br>
@include('components.errors')

@if (empty($vendors))
    <p> Belum ada vendor aktif. Aktifkan atau tambah vendor terlebih dahulu. </p>
@else
<form method="POST" action="{{ route('pengadaan.store') }}">
@csrf

<label> Vendor </label>
    <select name="vendor" required>
        <option value="" disabled @selected(old('vendor') === null)> Pilih Vendor </option>
        @foreach($vendors as $v)
            <option value="{{ $v->ID_Vendor }}" @selected((string) old('vendor') === (string) $v->ID_Vendor)> {{ $v->Vendor }} </option>
        @endforeach
    </select>

<button type="submit"> Buat </button>
</form>
@endif
@endsection
