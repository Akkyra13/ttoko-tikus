@extends('components.layout')

@section('content')
<h1>Edit Satuan </h1>

<a href="{{ route('satuan.index') }}"> Back </a>
<br>

<form method="POST" action="{{ route('satuan.update', $data->ID_Satuan) }}">
@csrf
@method('PUT')

<label> Satuan </label>
    <input name="satuan"
    value="{{ old('satuan', $data->Satuan ?? '') }}">

<label> Stok </label>
    <select name="aktif">
        @foreach($status as $d => $label)
            <option value="{{ $d }}" @selected(old('aktif', $data->statuss) === (int) $d)> {{ $label }} </option>
        @endforeach
    </select>

<button type="submit"> Save </button>
</form>
@endsection
