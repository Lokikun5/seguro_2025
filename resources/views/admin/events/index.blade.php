@extends('layouts.app')
@section('noindex', 'noindex, nofollow')

@section('title', 'Gestion des événements')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Événements</h1>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Ajouter un événement</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Performance</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->performance }}</td>
                        <td>
                            <input type="checkbox" class="toggle-active" data-id="{{ $event->id }}" {{ $event->active ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet événement ?')">
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.toggle-active');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async function () {
                const eventId = this.dataset.id;
                const isActive = this.checked;

                try {
                    const response = await fetch(`/admin/events/${eventId}/toggle-active`, {
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

                    const data = await response.json();
                    if (!data.success) {
                        throw new Error('Échec de la mise à jour côté serveur.');
                    }
                } catch (error) {
                    alert(error.message);
                    this.checked = !isActive; // revert checkbox state
                }
            });
        });
    });
</script>
@endpush
@endsection

