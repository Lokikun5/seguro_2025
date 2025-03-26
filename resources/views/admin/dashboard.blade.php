@extends('layouts.app')

@section('title', 'Tableau de bord admin')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1>Bienvenue Admin</h1>
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
    </main>
</div>
@endsection