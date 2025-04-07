@extends('layouts.app')

@section('title', 'Une erreur est survenue')

@section('content')
<section class="section-content text-center h-100vh">
    <h1 class="display-4">{{ $code ?? 'Erreur' }}</h1>
    <p class="lead">
        {{ $message ?? 'Une erreur est survenue. Veuillez réessayer plus tard.' }}
    </p>
    <a href="{{ route('welcome') }}" class="seguro-btn mt-4">
        Retour à l’accueil
        <span class="arrow"></span>
    </a>
</section>
@endsection
