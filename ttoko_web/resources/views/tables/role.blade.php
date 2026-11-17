<!-- role_table.php -->
@extends('components.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Role Directory</title>
</head>
<body>

  <h2>Registered Roles</h2>

@include('tables.atable')

</body>
</html>
@endsection

