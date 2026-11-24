@extends('components.layout')

@section('content')
<h1> Buat Penerimaan </h1>

<a href="{{ route('penerimaan.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('penerimaan.store') }}">
@csrf

<label> Pengadaan </label>
    <select name="pengadaan" required>
        <option value="" disabled @selected(old('pengadaan') === null)> Pilih Pengadaan </option>
        @foreach($data as $r)
            <option value="{{ $r->ID_Pengadaan }}" @selected((string) old('pengadaan'))> {{ $r->ID_Pengadaan }} </option>
        @endforeach
    </select>

<button type="submit"> Lanjut </button>
</form>
@endsection
