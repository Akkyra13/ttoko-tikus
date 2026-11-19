@extends('components.layout')

@section('content')
<h1> Tambah Margin </h1>

<a href="{{ route('margin.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('margin.store') }}">
@csrf

<label> Margin (%) </label>
    <input name="persen" type="number" step="0.01" min="0" max="100" value="{{ old('persen') }}">

<label> Status </label>
    <select name="status">
        @foreach($status as $k => $label)
            <option value="{{ $k }}" @selected((string) old('status', 0) === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<label> Dibuat Oleh </label>
    <select name="iduser">
        <option value="" disabled @selected(old('iduser') === null)> Pilih </option>
        @foreach($users as $u)
            <option value="{{ $u->ID_User }}" @selected((string) old('iduser') === (string) $u->ID_User)> {{ $u->Username }} ({{ $u->Role }}) </option>
        @endforeach
    </select>

<button type="submit"> Add </button>
</form>
@endsection
