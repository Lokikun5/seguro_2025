@extends('layouts.app')
@section('noindex', 'noindex, nofollow')

@section('title', 'Gestion des résidents')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Résidents</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.residents.create') }}" class="btn btn-primary mb-3">Ajouter un résident</a>

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Nationalité</th>
                    <th>Performance</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($residents as $resident)
                    <tr>
                        <td>
                            @if($resident->profile_pic)
                            <img src="{{ asset($resident->profile_pic ?? 'images/residents/seguro-default.webp') }}"
                                alt="Photo de {{ $resident->first_name }}"
                                width="60">

                            @else
                                <em>Pas de photo</em>
                            @endif
                        </td>
                        <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
                        <td>{{ $resident->nationality }}</td>
                        <td>{{ $resident->performance }}</td>
                        <td>
                            <input type="checkbox" data-id="{{ $resident->id }}" class="toggle-active" {{ $resident->active ? 'checked' : '' }}>
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.residents.edit', $resident) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('admin.residents.destroy', $resident) }}" method="POST" onsubmit="return confirm('Supprimer ce résident ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.toggle-active');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async function () {
                const residentId = this.dataset.id;
                const isActive = this.checked;

                try {
                    const response = await fetch(`/admin/residents/${residentId}/toggle-active`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ active: isActive })
                    });

                    if (!response.ok) {
                        throw new Error('Erreur lors de la mise à jour.');
                    }
                } catch (error) {
                    alert(error.message);
                    this.checked = !isActive; // revert state if error
                }
            });
        });
    });
</script>
@endsection