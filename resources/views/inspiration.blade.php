@extends('layouts.app')
@section('title', config('meta.become_resident.title'))
@section('description', config('meta.become_resident.description'))

@section('content')
    <section class="inspirationc-container">
        <h1>VILLA SEGURO <br>PROJET D’IDENTITÉ GRAPHIQUE</h1>
        <aside>
            <p class="word accueil">ACCUEILLIR</p>
            <p class="word mettre">METTRE LE MONDE <br>EN LUMIÈRE</p>
            <p class="word reveler">RÉVÉLER</p>
            <img src="{{ asset('images/inspiration/open-close.PNG') }}" alt="logo villa Seguro" class="logo">
            <p class="word se-donner">SE DONNER</p>
            <p class="word donner-voir">ET DONNER À VOIR</p>
            <p class="word recueillir">SE RECUEILLIR</p>
            <p class="word partager">PARTAGER</p>
            <p class="word refuge">REFUGE</p>
        </aside>
    </section>
    <section class="inspiration-gallery">
        <div class="image-container">
            <img src="{{ asset('images/inspiration/villa-Seguro-WEB-2.webp') }}" alt="villa Seguro image 1">
            <img src="{{ asset('images/inspiration/villa-Seguro-WEB-3.webp') }}" alt="villa Seguro image 2" class="image-two">
            <p class="caption">ACCUEILLIR</p>
        </div>
    </section>
    <section class="inspiration-gallery">
        <div class="image-container image-container2">
            <img src="{{ asset('images/inspiration/villa-Seguro-WEB 4.jpg') }}" alt="villa Seguro image 1">
            <img src="{{ asset('images/inspiration/villa-Seguro-WEB-5.jpg') }}" alt="villa Seguro image 2">
            <p class="caption2">METTRE LE MONDE <br> EN LUMIÈR</p>
            <p class="caption3">RÉVÉLER</p>
            <p class="caption4">DÉVOILER</p>
        </div>
    </section>
@endsection
