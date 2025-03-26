@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Réinitialiser le mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}" class="login-form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email"
                   class="@error('email') is-invalid @enderror"
                   name="email"
                   value="{{ $email ?? old('email') }}"
                   required autocomplete="email" autofocus>

            @error('email')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password"
                   class="@error('password') is-invalid @enderror"
                   name="password"
                   required autocomplete="new-password">

            @error('password')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirmer le mot de passe</label>
            <input id="password-confirm" type="password"
                   name="password_confirmation"
                   required autocomplete="new-password">
        </div>

        <button type="submit" class="seguro-btn">
            Réinitialiser le mot de passe
            <span class="arrow"></span>
        </button>
    </form>
</div>
@endsection