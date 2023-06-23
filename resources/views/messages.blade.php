@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Messages') }}</div>

                <div class="card-body">
                    @foreach($conversations as $conversation)
                    <div class="conversation">
                        @foreach($conversation->messages as $message)
                        <div class="message">
                            <p>{{ $message->body }}</p>
                            <small>{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                        @endforeach
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection