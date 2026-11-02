<!DOCTYPE html>
<html>
<x-layout>
<head>
    <title>Roles Table</title>
</head>
<body>
<h1>User List</h1>
<ul>
    @foreach($roles as $role)
        <li>{{ $role->name }}</li>
    @endforeach
</ul>
    <h2>Registered Roles</h2>
    <p>insert roles table here</p>
</x-layout>
