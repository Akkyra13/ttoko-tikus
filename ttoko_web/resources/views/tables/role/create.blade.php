@extends('components.layout')

@section('content')
<h1> Tambah Role </h1>

<a href="{{ route('role.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('role.store') }}" >
@csrf

<label> Role Name </label>
    <input name="name"
    value="{{ old('name', '') }}">

<button type="submit"> Add </button>

</form>

@endsection
