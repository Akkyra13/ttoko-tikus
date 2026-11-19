@extends('components.layout')

@section('content')
<h1> Tambah User </h1>

<a href="{{ route('user.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('user.store') }}" >
@csrf

<label> Username </label>
    <input name="username"
    value="{{ old('username', '') }}">

<label> Password </label>
    <input name="password" type="password"
    value="">

<label> Retype Password </label>
    <input name="password_confirmation" type="password"
    value="">

<label> Role </label>
    <select name="role">
        <option value="" disabled @selected(old('role') === null)> Pilih </option>
        @foreach ($roles as $r)
        <option value="{{$r->ID_Role}}" @selected((string) old('role') === (string) $r->ID_Role)> {{ $r-> Role }} </option>
        @endforeach
    </select>

<button type="submit"> Add </button>

</form>

@endsection
