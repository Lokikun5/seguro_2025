@extends('layouts.app')

@section('title', 'Ajouter une page')

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Ajouter une page</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="meta_title">Meta Titre (Longueur idéale : entre 50 et 60 caractères espaces inclus)</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" required>
            </div>

            <div class="mb-3">
                <label for="meta_description">Meta Description ( Longueur idéale : entre 150 et 160 caractères)</label>
                <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}" required>
            </div>

            <div class="mb-3">
                <label for="slug">Slug (url de la page)</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
            </div>

            <div class="mb-3">
                <label for="type">Type de page</label>
                <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
            </div>

            <div class="mb-3">
                <label for="introduce">Introduction</label>
                <input type="text" name="introduce" class="form-control" value="{{ old('introduce') }}" required>
            </div>

            <div class="mb-3">
                <textarea name="description" class="form-control tinymce-editor" rows="5" required>
                    {{ old('description', $page->description ?? '') }}
                </textarea>
                @include('components.admin.tinymce')
            </div>

            <div class="mb-3">
                <label for="profile_pic">Photo de profil</label>
                <input type="file" name="profile_pic" class="form-control" accept="image/*">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="active" value="1" id="active" checked>
                <label class="form-check-label" for="active">Activer cette page</label>
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