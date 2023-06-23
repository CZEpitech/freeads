@extends('layouts.app')

@section('content')
<p>Hello {{ $user }},</p>

<p>Your article "{{ $title }}" has been successfully posted on {{ $date }}.</p>

<p>Here are the details:</p>

<ul>
    <li>Title: {{ $title }}</li>
    <li>Description: {{ $description }}</li>
    <li>Date: {{ $date }}</li>
    <li>Price: {{ $price }}</li>
</ul>

<p>Thank you for using our platform!</p>
@endsection