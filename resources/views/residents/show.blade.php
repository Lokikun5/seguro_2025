@extends('layouts.app')
@php
    $residentImage = $resident->profile_pic ?? 'images/residents/seguro-default.webp';
@endphp

@section('title', $resident->meta_title)
@section('description', $resident->meta_description)
@section('canonical', route('residents.show', $resident->resident_slug))

@section('og:title', $resident->meta_title)
@section('og:description', $resident->meta_description)
@section('og:url', Request::url())
@section('og:image', asset($residentImage))

@section('twitter:title', $resident->meta_title)
@section('twitter:description', $resident->meta_description)
@section('twitter:image', asset($residentImage))

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li><a href="{{ route('residents.index') }}">Les résidents</a></li>
            <li aria-current="page">{{ $resident-> first_name }} {{ $resident-> last_name }}</li>
        </ul>
    </nav>
    <section class="section-content">
        <div class="header-page">
        <div class="img-resident">
            <img src="{{ asset($resident->profile_pic ?? 'images/residents/seguro-default.webp') }}"
                alt="{{ $resident->first_name }} {{ $resident->last_name }}">
        </div>

            <div class="texte-info">
                <h1>{{ $resident->first_name }} {{ $resident->last_name }}</h1>
                <h2>{{ $resident->introduce }}</h2>
                <p>Nationalité: {{ $resident->nationality }}</p>
                <p>Performance: {{ $resident->performance }}</p>
                <div class="social-link">
                    <a href="{{ $resident->linkedin_slug }}" title="le linkedin de {{ $resident->first_name }} {{ $resident->last_name }}" target="_blank">
                        <img src="{{ asset('images/logo/linkedin-svgrepo-com.svg') }}">
                    </a>
                    <a href="{{ $resident->instagram_slug }}" title="l'instagram de {{ $resident->first_name }} {{ $resident->last_name }}" target="_blank">
                        <img src="{{ asset('images/logo/insta-svgrepo-com.svg') }}">
                    </a>
                </div>
            </div>
        </div>

        <div class="resident-detail">
            <p>{{ $resident->description }}</p>
        </div>

        <!-- Affichage de la galerie si des médias sont présents -->
        @if($media->isNotEmpty())
            <h2>Découvrir {{ $resident->first_name }} {{ $resident->last_name }}</h2>
            @include('components.gallery', ['media' => $media])
        @endif

        @if($media->where('type', 'video')->isNotEmpty())
            <h2>{{ $resident->first_name }} {{ $resident->last_name }} en vidéo</h2>
            @include('components.gallery-video', ['media' => $media->where('type', 'video')])
        @endif
    </section>

    <!-- Modale de la lightbox incluse ici -->
    @include('components.lightbox', ['media' => $media])

    @include('components.share-page', ['title' => $resident->meta_title])
@endsection