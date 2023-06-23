@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        User Info
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <p class="form-control-static">{{ $user->name }}</p>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <p class="form-control-static">{{ $user->email }}</p>
        </div>
    </div>
</div>
@endsection