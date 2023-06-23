@extends('layouts.app')
@section('content')
@if(auth()->check())
<form method="POST" action="{{ route('messages.store') }}">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="recipient_id">Recipient:</label>
        <select name="recipient_id" id="recipient_id" class="form-control">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="5" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>

@endif
@endsection