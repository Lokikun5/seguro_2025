@extends('layouts.app')

@section('title', 'Erreur serveur')

@section('content')
<section class="section-content text-center h-100vh">
    <h1 class="display-4">500</h1>
    <p class="lead">Une erreur s’est produite sur le serveur. Veuillez réessayer plus tard.</p>
    <a href="{{ route('welcome') }}" class="seguro-btn mt-4">
        Retour à l’accueil
        <span class="arrow"></span>
    </a>
</section>
@endsection
