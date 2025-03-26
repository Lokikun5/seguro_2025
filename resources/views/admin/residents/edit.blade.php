@extends('layouts.app')

@section('title', 'Modifier un résident')

@section('content')
<div class="admin-layout">
    @include('components.admin.sidebar')

    <main class="admin-content">
        <h1 class="mb-4">Modifier un résident</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.residents.update', $resident) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $resident->first_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $resident->last_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="nationality">Nationalité</label>
                <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $resident->nationality) }}" required>
            </div>

            <div class="mb-3">
                <label for="performance">Discipline / Performance</label>
                <input type="text" name="performance" class="form-control" value="{{ old('performance', $resident->performance) }}" required>
            </div>

            <div class="mb-3">
                <label for="introduce">Introduction</label>
                <input type="text" name="introduce" class="form-control" value="{{ old('introduce', $resident->introduce) }}" required>
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $resident->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="profile_pic">Photo de profil</label>
                @if($resident->profile_pic)
                    <div class="mb-2">
                        <img src="{{ asset($resident->profile_pic) }}" alt="{{ $resident->first_name }}" width="80">
                    </div>
                @endif
                <input type="file" name="profile_pic" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="linkedin_slug">Lien LinkedIn</label>
                <input type="text" name="linkedin_slug" class="form-control" value="{{ old('linkedin_slug', $resident->linkedin_slug) }}">
            </div>

            <div class="mb-3">
                <label for="instagram_slug">Lien Instagram</label>
                <input type="text" name="instagram_slug" class="form-control" value="{{ old('instagram_slug', $resident->instagram_slug) }}">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ old('active', $resident->active) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Activer ce résident</label>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </main>
</div>
@endsection