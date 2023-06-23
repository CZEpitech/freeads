@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $article->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $article->price }}">
        </div>
        <div class="form-group row">
            <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
            <div class="col-md-6">
                <select id="categories" class="form-control @error('category') is-invalid @enderror" name="categories[]" multiple required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(in_array($category->id, old('category', []))) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>

            <div class="col-md-6">
                <input id="images" type="file" class="form-control-file @error('images') is-invalid @enderror" name="images[]" multiple>

                @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection