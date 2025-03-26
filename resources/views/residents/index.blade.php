@extends('layouts.app')
@section('title', config('meta.residents.title'))
@section('description', config('meta.residents.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li aria-current="page">Les résidents</li>
        </ul>
    </nav>
    <section class="section-content">
        <h1>Les résidents de la Villa Seguro</h1>
        <h2 class="mx-5 no-marge">Une diversité d’artistes engagés dans des pratiques contemporaines en résidence à Lomé</h2>
        <div class="list">
            @foreach($residents as $resident)
                @include('components.card-resident', ['resident' => $resident])
            @endforeach
        </div>
    </section>
@endsection