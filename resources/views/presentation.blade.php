@extends('layouts.app')
@section('title', config('meta.presentation.title'))
@section('description', config('meta.presentation.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li aria-current="page">QUI SOMMES-NOUS</li>
        </ul>
    </nav>
    <section class="section-content">
        <h1>QUI SOMMES-NOUS</h1>
        <h2 class="mx-5 no-marge">Un lieu de création, de réflexion et de transmission entre les cultures</h2>
        <img src="{{ asset('images/photos/seguro-hero.webp') }}" alt="logo villa Seguro" class="img-page img-fluid shadow rounded my-4">
        <p class="base-texte p-1 texte-center mobil-pad">
        <span class="color-focus2">La Villa Seguro</span> est un lieu d'échanges interdisciplinaires 
        qui pour vocation de renforcer le dialogue interculturel 
        entre tous les imaginaires du monde. On discutera Patrimoine de l'Afrique: 
        des pratiques spirituelles, 
        des questions écologiques, des enjeux politiques, comme des 
        cultures gastronomiques, de la mode et de la musique. 
        </p>
        <p class="base-texte"><span class="color-focus2">La Villa Seguro</span>  est une fondation financée sur fonds 
        propres et soutenue par des bonnes volontés </p>
        <div class="flex-warp">
            <a class="seguro-btn" href="{{ route('page.index') }}">
            Découvrir nos articles
            <span class="arrow"></span>
            </a>

            <a class="seguro-btn" href="{{ route('events.index') }}">
            Découvrir nos évènements
            <span class="arrow"></span>
            </a>

            <a class="seguro-btn" href="{{ route('become_resident') }}">
                Devenir resident
                <span class="arrow"></span>
            </a>
            <a class="seguro-btn" href="{{ route('make_a_donation') }}">
                Faire un don 
                <span class="arrow"></span>
            </a>
        </div>
    </section>
    @include('components.split-section')

@endsection