@extends('layouts.app')


@section('content')


<div class="container">

    <h2 class="fs-4 text-secondary my-4">{{ $post->title }}</h2>

    <p>{{ $post->content }}</p>

    <img src="{{ asset( 'storage/' . $post->cover_image ) }}" alt="404 img" class="img-fluid">


    <div class="my-3">
        Categoria: <b>{{ $post->category->name }}</b>
    </div>

</div>

@endsection