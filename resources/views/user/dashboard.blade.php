@extends('layouts.user')

@section('title', 'Tableau de bord')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('components.user.sidebar')
    </div>

    <div class="col-md-9">
        <h1 class="mb-4">Bienvenue dans votre espace</h1>
        <h2>{{ Auth::user()->name }}</h2>
        <p>Vous êtes connecté. Utilisez le menu pour naviguer dans votre espace personnel.</p>
    </div>
</div>
@endsection