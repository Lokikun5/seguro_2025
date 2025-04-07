@extends('layouts.app')
@section('title', config('meta.become_resident.title'))
@section('description', config('meta.become_resident.description'))
@section('canonical', Request::url())
@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li class="color-focus2" aria-current="page">Devenir resident</li>
        </ul>
    </nav>
    <section class="section-content">
        <h1>Devenir résident à la Villa Seguro</h1>
        <h2>Rejoignez un espace de création, de recherche et de transmission artistique</h2>
    </section>
@endsection