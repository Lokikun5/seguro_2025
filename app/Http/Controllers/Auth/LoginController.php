<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traite la tentative de connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }

    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
