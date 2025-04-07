@extends('layouts.app')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('canonical', route('page.show', $page->slug))

@section('og:title', $page->meta_title)
@section('og:description', $page->meta_description)
@section('og:url', Request::url())
@section('og:image', $page->profile_pic)

@section('twitter:title', $page->meta_title)
@section('twitter:description', $page->meta_description)
@section('twitter:image', $page->profile_pic)

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li><a href="{{ route('pages.index') }}">Les articles</a></li>
            <li class="color-focus2" aria-current="page">{{ $page->title }}</li>
        </ul>
    </nav>
    <section class="section-content">
        <div class="header-page">
            <div class="img-resident">
                <img src="{{ $page->profile_pic }}" alt="{{ $page->title }}">
            </div>
            <div class="texte-info">
                <h1>{{ $page->title }}</h1>
                <h2>{{ $page->introduce }}</h2>
            </div>
        </div>

        <div class="resident-detail">
            <p>{{ $page->created_at->format('d F Y') }}</p>
            {!! $page->description !!}
        </div>

        @if($media->isNotEmpty())
            <h2>Découvrez la galerie</h2>
            @include('components.gallery', ['media' => $media])
        @endif

        @if($media->where('type', 'video')->isNotEmpty())
            <h2>Vidéo</h2>
            @include('components.gallery-video', ['media' => $media->where('type', 'video')])
        @endif
    </section>

    <!-- Modale de la lightbox incluse ici -->
    @include('components.lightbox', ['media' => $media])
    @include('components.share-page', ['title' => $page->meta_title])
    @include('components.split-section')

    <section class="related-items section-content">
        <h2 class="text-center">Découvrez aussi</h2>
        <div class="related-items-wrapper">
            @foreach($otherPages as $other)
                <div class="related-card">
                    <img src="{{ asset($other->profile_pic) }}" alt="{{ $other->title }}">
                    <div class="related-card-body">
                        <h3>{{ $other->title }}</h3>
                        <p>{{ Str::limit($other->introduce, 100) }}</p>
                        <a href="{{ route('page.show', $other->slug) }}" class="seguro-btn">
                            Découvrir l'article
                            <span class="arrow"></span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection