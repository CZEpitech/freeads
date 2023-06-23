@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit User Info
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', auth()->user()->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{auth()->user()->email}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
        <form method="POST" action="{{ route('users.destroy', auth()->user()->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
            </div>
        </form>
    </div>
</div>
@endsection