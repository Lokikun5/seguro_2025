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
        <img src="{{ asset('images/photos/seguro-hero.webp') }}" alt="expo villa Seguro" class="img-page img-fluid shadow rounded my-4">
        <p class="base-texte p-1 texte-center mobil-pad">
            Construite en 2018 au bord du lac Togo, dans la ville de Porto-Séguro, Agbodrafo. 
            La <span class="color-focus">Villa Séguro</span> est un lieu d’échanges interdisciplinaires qui a pour vocation de renforcer 
            le dialogue interculturel entre tous les artistes du monde. 
        </p>
        <p class="base-texte">
            Elle se veut un cadre privilégié de rencontres, de création, de diffusion et de 
            médiation. Elle est un établissement privé entièrement financé sur fonds propres qui 
            bénéficie, à ce jour, du soutien des mécènes <span class="color-focus fst-italic"> Marion Urban, Didier Acouetey, Jonas Daou, 
            Hawa Drame, JosephineKoudoyor, Lydie Koudoyor, Bertin Kinvi.</span>
             
        </p>
        <div class="txtplusimg2">
            <div class="bloc1">
                <p class="base-texte text-start">
                Le programme de résidence de la <span class="color-focus">Villa Séguro</span> s’adresse aux artistes ou collectifs de 
                toutes disciplines et de toutes nationalités, engagés dans la création contemporaine. 
                </p>
            </div>
            <div class="bloc2">
                <img src="{{ asset('images/photos/exposition-seguro.webp') }}" alt="logo villa Seguro" class="img-page img-fluid shadow rounded my-4">
            </div>
        </div>
        <p class="base-texte">
            Les projets qui y sont reçus sont conçus en relation avec la scène culturelle togolaise 
            ou africaine et confirmés par un partenaire local. Les résidences durent de deux semaines 
            à trois mois et doivent déboucher sur une restitution en public. 

        </p>
        <h2>LES OBJECTIFS DE LA RÉSIDENCE</h2>
        <div class="txtplusimg2">
            <div class="bloc1">
                <img src="{{ asset('images/photos/jardin-seguro.webp') }}" alt="jardin de la villa Seguro" class="img-page img-fluid shadow rounded my-4">
            </div>
            <div class="bloc2">
                <ul>
                    <li class="base-texte text-start">
                         Former des comédiens amateurs et professionnels à la lecture à haute voix
                    </li>
                    <li class="base-texte text-start">
                        Permettre aux écrivains d’écrire des textes pour la voix et de finaliser leur 
                        projet de manuscrits en cours
                    </li>
                    <li class="base-texte text-start">
                        Créer une synergie entre la création artistique et l’audiovisuel grâce à un 
                        partenariat avec des médias
                    </li>
                    <li class="base-texte">
                        Enregistrer des textes pour des livres audio
                    </li>
                </ul>
            </div>
        </div>
        <h2>LES BÉNÉFICIAIRES DE LA RÉSIDENCE</h2>
        <img src="{{ asset('images/photos/seguro-reunion.webp') }}" alt="Seguro réunion" class="img-page img-fluid shadow rounded my-4">
        <p class="base-texte">
            La résidence réunira, autour de 4 formateurs, 26 stagiaires (16 comédiens 
            professionnels et amateurs, ainsi que 10 chanteurs confirmés) vivant au Togo. 
        </p>
        <p class="base-texte">
            Les formateurs résideront à Alogavi pendant 21 jours et consacreront leur 
            temps aux activités d’écriture, de formation et d’excursion.
        </p>
        <p class="base-texte">
            Les stagiaires bénéficieront de 10 jours de formation organisée en deux 
            séquences de 5 jours chacune. 
        </p>
           
        <div class="flex-warp">
            <a class="seguro-btn" href="{{ route('pages.index') }}">
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