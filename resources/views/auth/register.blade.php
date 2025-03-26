@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Créer un compte</h1>

    <form method="POST" action="{{ route('register') }}" class="login-form">

        @csrf

        <div class="form-group">
            <label for="name">Nom</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required>
            @error('password') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirmer le mot de passe</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="seguro-btn">S'inscrire</button>
    </form>
</div>
@endsection