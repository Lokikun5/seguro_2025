<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'regex:/^[0-9\s\-\+\(\)]{10,}$/'],
            'email'      => ['required', 'email:rfc,dns'],
            'message'    => ['required', 'string', 'min:150'], // ~30 mots ≈ 150 caractères
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.regex' => 'Le numéro doit contenir au moins 10 chiffres.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Le format de l\'adresse email est invalide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 30 mots (~150 caractères).',
        ]);        

        Mail::to('fondationvillaseguro@gmail.com') // ← adresse de destination
            ->send(new ContactMessage($validated));

        return redirect()->to(url()->previous() . '#contact')->with('success', 'Votre message a bien été envoyé.');

    }
}