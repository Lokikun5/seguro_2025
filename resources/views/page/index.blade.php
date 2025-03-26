@extends('layouts.app')
@section('title', config('meta.article.title'))
@section('description', config('meta.article.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li aria-current="page">Les articles</li>
        </ul>
    </nav>
    <section class="section-content">
        <h1>Les articles de la villa Seguro</h1>
        <h2 class="mx-5">Récits, réflexions et récaps autour de la résidence et des artistes accueillis</h2>
        <div class="articles-list">
            @foreach($pages as $page)
                <a href="{{ route('page.show', ['slug' => $page->slug]) }}" title="découvrir {{ $page->title }}" class="article-card">
                    <div class="card-content">
                        <div class="contain">
                            <img src="{{ $page->profile_pic }}" alt="{{ $page->title }}" class="card-image">
                        </div>
                        <p class="card-title">{{ $page->title }}</p>
                        <p>{{ $page->meta_description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection