@extends('layouts.app')

@section('title', 'Ajouter un résident')

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Ajouter un résident</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.residents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nationality">Nationalité</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="performance">Discipline / Performance</label>
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
                <label for="profile_pic">Photo de profil</label>
                <input type="file" name="profile_pic" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="linkedin_slug">Lien LinkedIn</label>
                <input type="text" name="linkedin_slug" class="form-control">
            </div>

            <div class="mb-3">
                <label for="instagram_slug">Lien Instagram</label>
                <input type="text" name="instagram_slug" class="form-control">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="active" value="1" id="active" checked>
                <label class="form-check-label" for="active">Activer ce résident</label>
            </div>

            <hr>

            <h4 class="mt-4">Galerie média</h4>

            <div class="mb-3">
                <label for="gallery_photo">Ajouter des photos (vous pouvez en sélectionner plusieurs)</label>
                <input type="file" name="gallery_photo[]" id="gallery_photo" accept="image/*" multiple>
            </div>

            <div class="mb-3">
                <label for="gallery_video[]">Ajouter des liens de vidéos (YouTube, Vimeo, etc.)</label>
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