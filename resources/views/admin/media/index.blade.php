@extends('layouts.app')
@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Galerie (photos et vidéos)</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Formulaire d'ajout d'image -->
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            <h4>Ajouter une nouvelle image</h4>
            <div class="mb-3">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="file_name">Fichier image</label>
                <input type="file" name="file_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="legende">Légende</label>
                <input type="text" name="legende" class="form-control">
            </div>
            <input type="hidden" name="type" value="photo">
            <input type="hidden" name="gallery_page" value="1">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <!-- Liste des images -->
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Légende</th>
                    <th>Afficher dans galerie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $item)
                    <tr class="vh20">
                        <td><img src="{{ $item->file_url }}" alt="{{ $item->name }}" width="100"></td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('admin.media.update', $item) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="legende" value="{{ $item->legende }}" class="form-control">
                        </td>
                        <td>
                            <input type="hidden" name="gallery_page" value="0">
                            <input type="checkbox" name="gallery_page" value="1" {{ $item->gallery_page ? 'checked' : '' }}>
                        </td>
                        <td>
                            <div class="media-action-buttons">
                                <button type="submit" class="btn btn-sm btn-success">Mettre à jour</button>
                            </form>

                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette image ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulaire d'ajout de vidéo -->
        <form action="{{ route('admin.media.store') }}" method="POST" class="mb-5">
            @csrf
            <h4>Ajouter une nouvelle vidéo</h4>
            <div class="mb-3">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="file_name">Lien YouTube</label>
                <input type="url" name="file_name" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
            </div>
            <div class="mb-3">
                <label for="legende">Légende</label>
                <input type="text" name="legende" class="form-control">
            </div>
            <input type="hidden" name="type" value="video">
            <input type="hidden" name="gallery_page" value="1">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <!-- Liste des vidéos -->
        <h2 class="mb-3">Vidéos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vidéo</th>
                    <th>Nom</th>
                    <th>Légende</th>
                    <th>Afficher dans galerie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $item)
                    <tr class="vh30">
                        <td>
                            <iframe width="200" height="113" src="{{ $item->file_url }}" frameborder="0" allowfullscreen></iframe>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('admin.media.update', $item) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="legende" value="{{ $item->legende }}" class="form-control">
                        </td>
                        <td>
                            <input type="hidden" name="gallery_page" value="0">
                            <input type="checkbox" name="gallery_page" value="1" {{ $item->gallery_page ? 'checked' : '' }}>
                        </td>
                        <td>
                            <div class="media-action-buttons">
                                <button type="submit" class="btn btn-sm btn-success">Mettre à jour</button>
                            </form>

                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette vidéo ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection
