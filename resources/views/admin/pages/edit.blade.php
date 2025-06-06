@extends('layouts.app')

@section('title', 'Modifier la page')

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Modifier la page</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="meta_title">Meta Titre</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}" required>
            </div>

            <div class="mb-3">
                <label for="meta_description">Meta Description</label>
                <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $page->meta_description) }}" required>
            </div>

            <div class="mb-3">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
            </div>

            <div class="mb-3">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-control" value="{{ old('type', $page->type) }}" required>
            </div>

            <div class="mb-3">
                <label for="introduce">Introduction</label>
                <input type="text" name="introduce" class="form-control" value="{{ old('introduce', $page->introduce) }}" required>
            </div>

            <div class="mb-3">
                <textarea name="description" class="form-control tinymce-editor" rows="5" required>
                    {{ old('description', $page->description ?? '') }}
                </textarea>
                @include('components.admin.tinymce')
            </div>

            <div class="mb-3">
                <label for="profile_pic">Photo de profil</label>
                @if($page->profile_pic)
                    <div class="mb-2">
                        <img src="{{ $page->profile_pic }}" alt="{{ $page->title }}" width="100">
                    </div>
                @endif
                <input type="file" name="profile_pic" class="form-control" accept="image/*">
            </div>

            <div class="form-check mb-4">
                <input type="hidden" name="active" value="0">
                <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ old('active', $page->active) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Activer cette page</label>
            </div>

            <hr>

            <h4 class="mt-4">Ajouter des médias</h4>

            <div class="mb-3">
                <label for="gallery_photo">Photos (vous pouvez en sélectionner plusieurs)</label>
                <input type="file" name="gallery_photo[]" id="gallery_photo" accept="image/*" multiple>
            </div>

            <div class="mb-3">
                <label for="gallery_video[]">Liens de vidéos (YouTube, Vimeo...)</label>
                <input type="url" name="gallery_video[]" class="form-control mb-2">
                <input type="url" name="gallery_video[]" class="form-control mb-2">
                <input type="url" name="gallery_video[]" class="form-control mb-2">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Mettre à jour</button>
        </form>

        {{-- Galerie photo --}}
        @if($page->media->where('type', 'photo')->isNotEmpty())
            <hr>
            <h4 class="mt-4">Photos existantes</h4>
            <div class="d-flex flex-wrap gap-3">
                @foreach($page->media->where('type', 'photo') as $photo)
                    <div class="text-center">
                        <img src="{{ asset('storage/media/photos/' . $photo->file_name) }}" alt="Photo" width="100">
                        <form action="{{ route('admin.media.destroy', $photo) }}" method="POST" onsubmit="return confirm('Supprimer cette photo ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Galerie vidéo --}}
        @if($page->media->where('type', 'video')->isNotEmpty())
            <hr>
            <h4 class="mt-4">Vidéos existantes</h4>
            <div class="d-flex flex-wrap gap-3">
                @foreach($page->media->where('type', 'video') as $video)
                    <div class="text-center">
                        <iframe width="200" height="120" src="{{ $video->file_name }}" frameborder="0" allowfullscreen></iframe>
                        <form action="{{ route('admin.media.destroy', $video) }}" method="POST" onsubmit="return confirm('Supprimer cette vidéo ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Supprimer</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
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