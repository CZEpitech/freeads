@extends('layouts.app')

@section('content')
<p>Click the link below to confirm your account:</p>
<a href="{{ url('/confirmation?token='.$confirmation_token) }}">{{ url('/confirmation?token='.$confirmation_token) }}</a>

@endsection