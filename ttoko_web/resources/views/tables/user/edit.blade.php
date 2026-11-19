@extends('components.layout')

@section('content')
<h1>Edit User</h1>

<a href="{{ route('user.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('user.update', $data->ID_User) }}">
@csrf
@method('PUT')

<label> Username </label>
    <input name="username"
    value="{{ old('username', $data->Username ?? '') }}">

<label> Role </label>
    <select name="role">
        @foreach($roles as $d)
            <option value="{{ $d->ID_Role }}" @selected((string) old('role', $data->role_id) === (string) $d->ID_Role)> {{ $d->Role }} </option>
        @endforeach
    </select>

<label> New Password </label>
    <input name="newpassword" type="password"
    value="">

<label> Retype New Password </label>
    <input name="newpassword_confirmation" type="password"
    value="">

<label> Current Password </label>
    <input name="password" type="password"
    value="">

<button type="submit"> Save </button>
</form>
@endsection
