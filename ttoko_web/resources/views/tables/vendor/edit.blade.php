@extends('components.layout')

@section('content')
<h1> Edit Vendor </h1>

<a href="{{ route('vendor.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('vendor.update', $data->ID_Vendor) }}">
@csrf
@method('PUT')

<label> Nama Vendor </label>
    <input name="nama" value="{{ old('nama', $data->nama_vendor) }}">

<label> Badan Hukum </label>
    <select name="badan_hukum">
        @foreach($badan as $k => $label)
            <option value="{{ $k }}" @selected((string) old('badan_hukum', $data->badan_hukum) === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<label> Status </label>
    <select name="status">
        @foreach($status as $k => $label)
            <option value="{{ $k }}" @selected((string) old('status', $data->status_id) === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<button type="submit"> Save </button>
</form>
@endsection
