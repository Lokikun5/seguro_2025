@extends('layouts.app')
@section('title', config('meta.gallery.title'))
@section('description', config('meta.gallery.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li class="color-focus2" aria-current="page">Galerie de la Villa Seguro</li>
        </ul>
    </nav>

    <section class="section-content">
        <h1>Galerie</h1>
        <h2 class="gallery-description">Moments capturés lors des résidences, <br> événements et créations artistiques</h2>

        <!-- Galerie de miniatures -->
        <div class="gallery-thumbs">
            @foreach ($media as $index => $item)
                @if ($item->type === 'photo')
                    <div class="thumb">
                        <img
                            src="{{ asset('storage/media/photos/' . $item->file_name) }}"
                            alt="{{ $item->name }}"
                            class="img-thumbnail"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal"
                            data-bs-slide-to="{{ $index }}"
                        >
                        @if ($item->legende)
                        <p class="thumb-caption mt-2 text-center">{{ $item->legende }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- Section vidéos -->
    @if($media->where('type', 'video')->isNotEmpty())
    <section class="section-content" id="video-section">
    <h2 class="mt-5">Vidéos</h2>
    <div class="gallery-videos">
        @foreach ($media->where('type', 'video') as $video)
            <div class="video-wrapper">
                <iframe 
                    width="560" 
                    height="315" 
                    src="{{ $video->file_url }}" 
                    title="{{ $video->name }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                <p class="gallery-caption">{{ $video->legende }}</p>
            </div>
        @endforeach
    </div>
</section>
    @endif

    <!-- Modale lightbox avec carousel -->
    @include('components.lightbox', ['media' => $media])
@endsection