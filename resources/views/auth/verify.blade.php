@section('noindex', 'noindex, nofollow')

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Vérification de votre adresse email</h1>

    @if (session('status') == 'verification-link-sent' || session('resent'))
        <div class="alert alert-success" role="alert" style="margin-bottom: 1.5rem;">
            Un nouveau lien de vérification a été envoyé à votre adresse email.
        </div>
    @endif

    <p>
        Merci de vous être inscrit ! Avant de continuer, veuillez vérifier votre adresse email en cliquant sur le lien que nous vous avons envoyé.
    </p>

    <p style="margin-bottom: 2rem;">
        Si vous n'avez pas reçu l'email, cliquez ci-dessous pour en recevoir un nouveau.
    </p>

    <form method="POST" action="{{ route('verification.resend') }}" class="login-form">
        @csrf
        <button type="submit" class="seguro-btn">Renvoyer l'email de vérification</button>
    </form>

    <div class="register-link" style="margin-top: 2rem;">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Se déconnecter
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection