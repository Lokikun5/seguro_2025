@extends('layouts.app')
@section('title', config('meta.évènement.title'))
@section('description', config('meta.évènement.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li class="color-focus2" aria-current="page">Les événements</li>
        </ul>
    </nav>
        <section class="section-content">
            <h1>Les événements de la Villa Seguro</h1>
            <h2 class="mx-5 no-marge">Performances, expositions, projections et rencontres artistiques à Lomé</h2>
            <div class="list">
            @foreach($events as $event)
                @include('components.card-event', ['events' => $event])
            @endforeach
            </div>
        </section>
@endsection