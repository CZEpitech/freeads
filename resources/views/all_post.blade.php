@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-end gap-2">
                @foreach ($categories as $category)
                <a href="/category/{{$category->slug}}" class="btn btn-primary">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if(count($post->images) > 0)
                <img src="{{ asset($post->images[0]->filename) }}" class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                @else
                <img src="{{ asset('placeholder-image.jpg') }}" class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>



                    @if ($post->categories->count() > 0)
                    <div class="mb-2">
                        @foreach ($post->categories as $category)
                        <a href="/category/{{$category->slug}}" class="btn btn-sm btn-primary">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    @endif

                    <h6 class="card-subtitle mb-2 text-muted">{{ $post->price }} €</h6>
                    @auth

                    <div class="d-flex justify-content-end gap-2">
                        @if ($post->user_id == auth()->id())
                        <a href="{{ route('edit_post', $post->id) }}" class="btn btn-primary "><i class="bi-pencil-fill"></i></a>
                        <form action="{{ route('delete_post', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="bi-trash3-fill"></i></button>
                        </form>
                        @endif
                        <a href="{{ route('show_post', $post->id) }}" class="btn btn-success "><i class="bi-eye-fill"></i></a>

                    </div>


                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection