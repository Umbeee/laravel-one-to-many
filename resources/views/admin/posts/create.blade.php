@extends('layouts.app')


@section('content')

<div class="container">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="fs-4 text-secondary my-4">Crea il tuo post compilando i campi, poi invia il tutto!</h2>
        <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input type="text" class="form-control" id="post-title" name="title" placeholder="Titolo">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="post-content" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="post-cover-image" class="form-label">image</label>
            <input type="file" class="form-control" name="cover_image" id="post-cover-image" rows="3"></input>
        </div>

        <div class="mb-3">
            <label for="post-categories" class="form-label">Categories</label>
            <select class="form-select form-select-lg @error ('category_id') is-invalid @enderror" name="category_id" id="post-categories">


                <option value="">Scegli una categoria</option>
                @foreach ( $categories as $elem )

                <option value="{{ $elem->id }}">{{ $elem->name }}</option>

                @endforeach
            </select>
            <div>
                @error('category_id')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">invia</button>
    </form>
</div>


@endsection