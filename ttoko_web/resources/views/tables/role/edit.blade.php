@extends('components.layout')

@section('content')
<h1>Edit User</h1>

<a href="{{ route('role.index') }}"> Back </a>
<br>
@include('components.errors')

<form method="POST" action="{{ route('role.update', $data->ID_Role) }}">
@csrf
@method('PUT')

<label> Role Name </label>
    <input name="name"
    value="{{ old('name', $data->Role ?? '') }}">

<button type="submit"> Save </button>
</form>
@endsection
