@extends('layouts.app')
@section('title', config('meta.donation.title'))
@section('description', config('meta.donation.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li aria-current="page">Faire un don</li>
        </ul>
    </nav>
    <section class="section-content">
        <h1>Faire un don</h1>
        
    </section>

@endsection