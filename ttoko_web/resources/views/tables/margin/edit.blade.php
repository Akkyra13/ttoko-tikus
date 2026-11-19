@extends('components.layout')

@section('content')
<h1> Edit Margin {{ $data->Margin }} </h1>

<a href="{{ route('margin.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('margin.update', $data->ID_Margin) }}">
@csrf
@method('PUT')

<label> Margin (%) </label>
    <input name="persen" type="number" step="0.01" min="0" max="100" value="{{ old('persen', round($data->persen * 100, 2)) }}">

<label> Status </label>
    <select name="status">
        @foreach($status as $k => $label)
            <option value="{{ $k }}" @selected((string) old('status', $data->status_id) === (string) $k)> {{ $label }} </option>
        @endforeach
    </select>

<button type="submit"> Save </button>
</form>
@endsection
