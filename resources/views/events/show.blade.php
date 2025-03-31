@extends('layouts.app')

@section('title',$event->meta_title)
@section('description',$event->meta_description)
@section('canonical', route('events.show', $event->slug))

@section('og:title', $event->meta_title)
@section('og:description', $event->meta_description)
@section('og:url', Request::url())
@section('og:image', $event->profile_pic)

@section('twitter:title', $event->meta_title)
@section('twitter:description', $event->meta_description)
@section('twitter:image', $event->profile_pic)

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li><a href="{{ route('events.index') }}">Les événements</a></li>
            <li aria-current="page">{{ $event->title  }}</li>
        </ul>
    </nav>
    <section class="section-content">
        <div class="header-page">
            <div class="img-resident">
                <img src="{{ asset($event->profile_pic) }}" alt="{{ $event->title }}">
            </div>
            <div class="texte-info">
                <h1>{{ $event->title }}</h1>
                <p>Date: {{ $event->start_date }}</p>
                <p>Performance: {{ $event->performance }}</p>
                <h2>{{ $event->introduce }}</h2>
            </div>
        </div>
        <div class="resident-detail">
            <p>{!! $event->description !!}</p>
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

    @include('components.share-page', ['title' => $event->meta_title])
@endsection
