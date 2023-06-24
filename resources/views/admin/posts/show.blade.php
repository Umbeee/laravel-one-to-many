@extends('layouts.app')


@section('content')


    <div class="container">
    
            <h2  class="fs-4 text-secondary my-4">{{ $post->title }}</h2>

            <p>{{ $post->content }}</p>

            <img src="{{ asset( 'storage/' . $post->cover_image ) }}" alt="nessuna immagine caricata" class="img-fluid">
    
    </div>

@endsection