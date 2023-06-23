@extends('layouts.app')

@section('content')
@foreach ($users as $user)
<tr>
    <td>{{ $user->name }}</td><br>
    <td>{{ $user->email }}</td><br>
    <br><br>
</tr>
@endforeach
@endsection