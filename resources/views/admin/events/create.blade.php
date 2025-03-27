@extends('layouts.app')

@section('title', 'Ajouter un événement')

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Ajouter un événement</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="meta_description">Meta Description</label>
                <input type="text" name="meta_description" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start_date">Date de début</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="performance">Performance</label>
                <input type="text" name="performance" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="introduce">Introduction</label>
                <input type="text" name="introduce" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="profile_pic">Image à la une</label>
                <input type="file" name="profile_pic" class="form-control" accept="image/*">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="active" value="1" id="active" checked>
                <label class="form-check-label" for="active">Activer cet événement</label>
            </div>

            <hr>

            <h4 class="mt-4">Ajouter des médias à la galerie</h4>

            <div class="mb-3">
                <label for="gallery_photo[]">Photos (vous pouvez en sélectionner plusieurs)</label>
                <input type="file" name="gallery_photo[]" id="gallery_photo" class="form-control" accept="image/*" multiple>
            </div>

            <div class="mb-3">
                <label for="gallery_video[]">Liens de vidéos (YouTube, Vimeo, etc.)</label>
                <input type="url" name="gallery_video[]" class="form-control mb-2">
                <input type="url" name="gallery_video[]" class="form-control mb-2">
                <input type="url" name="gallery_video[]" class="form-control mb-2">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    FilePond.registerPlugin();
    FilePond.create(document.querySelector('#gallery_photo'), {
        allowMultiple: true,
        storeAsFile: true
    });
</script>
@endpush