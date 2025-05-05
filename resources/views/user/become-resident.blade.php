@extends('layouts.user')

@section('title', 'Devenir résident')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Sidebar utilisateur --}}
        <div class="col-md-3 mb-4">
            @include('components.user.sidebar')
        </div>

        {{-- Contenu principal --}}
        <div class="col-md-9 mb-5">
            <h1 class="mb-4">Devenir résident</h1>

            {{-- Message succès --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Classes de badge selon statut --}}
            @php
                $statusClasses = [
                    'en_attente' => 'bg-warning text-dark',
                    'valide'     => 'bg-success',
                    'refuse'     => 'bg-danger',
                    'terminee'   => 'bg-secondary',
                ];
            @endphp

            {{-- Demandes à venir ou en cours --}}
            @if ($futureRequests->isNotEmpty())
                <div class="mb-5">
                    <h5 class="mb-3">Demandes en cours ou à venir</h5>
                    <ul class="list-group">
                        @foreach ($futureRequests as $request)
                            <li class="list-group-item">
                                <div><strong>Début :</strong> {{ $request->start_date->translatedFormat('d F Y') }}</div>
                                <div><strong>Fin :</strong> {{ $request->end_date->translatedFormat('d F Y') }}</div>
                                <div><strong>Formules :</strong> {{ implode(', ', $request->formules) }}</div>
                                <div>
                                    <strong>Statut :</strong>
                                    <span class="badge {{ $statusClasses[$request->status] ?? 'bg-light text-dark' }}">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </div>
                                <div class="text-muted"><small>Envoyée le {{ $request->created_at->translatedFormat('d F Y à H\hi') }}</small></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Demandes passées --}}
            @if ($pastRequests->isNotEmpty())
                <div class="mb-5">
                    <h5 class="mb-3">Demandes passées</h5>
                    <ul class="list-group">
                        @foreach ($pastRequests as $request)
                            <li class="list-group-item">
                                <div><strong>Début :</strong> {{ $request->start_date->translatedFormat('d F Y') }}</div>
                                <div><strong>Fin :</strong> {{ $request->end_date->translatedFormat('d F Y') }}</div>
                                <div><strong>Formules :</strong> {{ implode(', ', $request->formules) }}</div>
                                <div>
                                    <strong>Statut :</strong>
                                    <span class="badge {{ $statusClasses[$request->status] ?? 'bg-light text-dark' }}">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </div>
                                <div class="text-muted"><small>Envoyée le {{ $request->created_at->translatedFormat('d F Y à H\hi') }}</small></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulaire de nouvelle demande --}}
            <h5 class="mb-3">Faire une nouvelle demande</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.become-resident.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="start_date">Date de début</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_date">Date de fin</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>Choisissez vos formules</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="formules[]" value="hébergement" id="formule1">
                        <label class="form-check-label" for="formule1">Hébergement</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="formules[]" value="repas" id="formule2">
                        <label class="form-check-label" for="formule2">Repas</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="formules[]" value="atelier" id="formule3">
                        <label class="form-check-label" for="formule3">Atelier</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer la demande</button>
            </form>
        </div>
    </div>
</div>
@endsection