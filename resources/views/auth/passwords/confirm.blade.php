@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Confirmation du mot de passe</h1>

    <p style="margin-bottom: 2rem;">
        Merci de confirmer votre mot de passe avant de continuer.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password"
                   class="@error('password') is-invalid @enderror"
                   name="password"
                   required autocomplete="current-password">

            @error('password')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="seguro-btn">
            Confirmer
            <span class="arrow"></span>
        </button>

        @if (Route::has('password.request'))
            <div class="register-link" style="margin-top: 1.5rem;">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>
        @endif
    </form>
</div>
@endsection