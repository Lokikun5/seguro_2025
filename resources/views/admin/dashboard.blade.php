@extends('layouts.app')
@section('noindex', 'noindex, nofollow')

@section('title', 'Tableau de bord admin')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1>Bienvenue Admin</h1>

        {{-- Liste des utilisateurs --}}
        <h2>Liste des utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Création d’un nouvel utilisateur --}}
<h2 class="mt-5">Ajouter un nouvel utilisateur</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" class="mb-4">
    @csrf

    <div class="mb-3">
        <label for="name">Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email">Adresse email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation">Confirmation du mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="role">Rôle</label>
        <select name="role" class="form-select" required>
            <option value="user">Utilisateur</option>
            <option value="rédacteur">Rédacteur</option>
            <option value="admin">Administrateur</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
</form>


        {{-- Demandes de résidence --}}
        <h2 class="mt-5">Demandes de résidence</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Formules</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residentRequests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.resident-requests.update', $request->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="date" name="start_date" class="form-control" value="{{ $request->start_date->format('Y-m-d') }}">
                        </td>
                        <td>
                                <input type="date" name="end_date" class="form-control" value="{{ $request->end_date->format('Y-m-d') }}">
                        </td>
                        <td>{{ implode(', ', $request->formules) }}</td>
                        <td>
                            <select name="status" class="form-select">
                                <option value="en_attente" {{ $request->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="valide" {{ $request->status == 'valide' ? 'selected' : '' }}>Validée</option>
                                <option value="date_a_changer" {{ $request->status == 'date_a_changer' ? 'selected' : '' }}>Date à changer</option>
                                <option value="annulee" {{ $request->status == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-sm btn-success">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection