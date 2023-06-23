@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Messages') }}</div>
                <div class="card-body">
                    @if ($messages->count() > 0)
                    <ul class="list-group">
                        @foreach($messages as $message)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="font-weight-bold">{{ $message->sender->name }}</p>
                                    <p>{{ $message->body }}</p>
                                </div>
                                <div class="col-md-2 text-right">
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">
                        {{ $messages->links() }}
                    </div>
                    @else
                    <p>{{ __('You have no messages.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection