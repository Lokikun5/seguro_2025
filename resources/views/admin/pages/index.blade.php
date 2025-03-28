@extends('layouts.app')

@section('title', 'Gestion des pages')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Pages</h1>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Ajouter une page</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->type }}</td>
                        <td>
                            <input type="checkbox" class="toggle-active" data-id="{{ $page->id }}" {{ $page->active ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette page ?')">
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
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.toggle-active');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async function () {
                const pageId = this.dataset.id;
                const isActive = this.checked;

                try {
                    const response = await fetch(`/admin/pages/${pageId}/toggle-active`, {
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
                        throw new Error('Erreur côté serveur.');
                    }
                } catch (error) {
                    alert(error.message);
                    this.checked = !isActive;
                }
            });
        });
    });
</script>
@endpush