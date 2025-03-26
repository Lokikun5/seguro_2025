@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Connexion</h1>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   required autocomplete="email" autofocus>

            @error('email')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password"
                   class="@error('password') is-invalid @enderror"
                   required autocomplete="current-password">

            @error('password')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-options">
            <label class="remember-me">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Se souvenir de moi
            </label>

            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit" class="seguro-btn">
            Connexion
            <span class="arrow"></span>
        </button>
        <div class="register-link">
    <span>Pas encore de compte ?</span>
   <a href="{{ route('register') }}">Créer un compte</a>

</div>
    </form>
</div>
@endsection