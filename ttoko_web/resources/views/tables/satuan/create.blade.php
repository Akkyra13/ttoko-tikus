@extends('components.layout')

@section('content')
<h1> Tambah Satuan </h1>

<a href="{{ route('satuan.index') }}"> Back </a>
<br>

<form method="POST" action="{{ route('satuan.store') }}" >
@csrf

<label> Satuan </label>
    <input name="satuan"
    value="{{ old('satuan', $data->Satuan ?? '') }}">

<button type="submit"> Add </button>

</form>

@endsection
