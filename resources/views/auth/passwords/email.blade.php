@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Réinitialiser le mot de passe</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert" style="margin-bottom: 1.5rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email"
                   class="@error('email') is-invalid @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required autocomplete="email" autofocus>

            @error('email')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="seguro-btn">
            Envoyer le lien de réinitialisation
            <span class="arrow"></span>
        </button>
    </form>

    <div class="register-link">
        <a href="{{ route('login') }}">Retour à la connexion</a>
    </div>
</div>
@endsection