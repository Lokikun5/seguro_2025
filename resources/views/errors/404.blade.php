@extends('layouts.app')

@section('title', 'Page introuvable')

@section('content')
<section class="section-content text-center h-100vh">
    <h1 class="display-4">404</h1>
    <p class="lead">Oups ! La page que vous cherchez est introuvable.</p>
    <a href="{{ route('welcome') }}" class="seguro-btn mt-4">
        Retour à l’accueil
        <span class="arrow"></span>
    </a>
</section>
@endsection