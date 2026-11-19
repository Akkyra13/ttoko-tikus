@extends('components.layout')

@section('content')
<h1> Tambah Vendor </h1>

<a href="{{ route('vendor.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('vendor.store') }}">
@csrf

<label> Nama Vendor </label>
    <input name="nama" value="{{ old('nama') }}">

<label> Badan Hukum </label>
    <select name="badan_hukum">
        <option value="" disabled @selected(old('badan_hukum') === null)> Pilih </option>
        @foreach($badan as $k => $label)
            <option value="{{ $k }}" @selected((string) old('badan_hukum') === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<label> Status </label>
    <select name="status">
        @foreach($status as $k => $label)
            <option value="{{ $k }}" @selected((string) old('status', 1) === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<button type="submit"> Add </button>
</form>
@endsection
