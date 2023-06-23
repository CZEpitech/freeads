@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-shadow mb-4">{{ $post->title }}</h1>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="price bg-primary text-white px-3 py-2 rounded">€ {{ $post->price }}</span>
                        <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-muted mb-3">{{ $post->updated_at->format('F j, Y') }}</div>
                    @if(count($post->images) > 0)
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($post->images as $key => $image)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="@if($key === 0) active @endif" aria-current="@if($key === 0) true @endif" aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($post->images as $key => $image)
                            <div class="carousel-item @if($key === 0) active @endif">
                                <img style="height: 480px !important" src="{{ asset($image->filename) }}" class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @endif
                    <div class="my-3">
                        <span class="font-weight-bold mb-2 d-block">Categories:</span>
                        @foreach ($post->categories as $category)
                        <a href="/category/{{$category->slug}}" class="btn btn-sm btn-outline-secondary mr-2 mb-2">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <p class="lead">{{ $post->description }}</p>
                    <p class="font-weight-bold mb-1">Seller :</p>
                    <p class="mb-4">{{ $post->user->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection