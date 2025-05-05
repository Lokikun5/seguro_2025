<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResidencyRequestMail;
use App\Models\ResidentRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

        public function becomeResident()
    {
        $today = Carbon::today();

        // ✅ Mise à jour automatique des statuts expirés
        ResidentRequest::where('user_id', Auth::id())
            ->where('end_date', '<', $today)
            ->where('status', '!=', 'terminee')
            ->update(['status' => 'terminee']);

        // ✅ Récupération de toutes les demandes de l'utilisateur
        $allRequests = ResidentRequest::where('user_id', Auth::id())
            ->orderByDesc('start_date')
            ->get();

        // ✅ Tri par statut : en_attente/validée vs. terminée
        $futureRequests = $allRequests->filter(fn($r) => $r->status !== 'terminee');
        $pastRequests = $allRequests->filter(fn($r) => $r->status === 'terminee');

        return view('user.become-resident', compact('futureRequests', 'pastRequests'));
    }



        public function submitResidentRequest(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'formules' => 'required|array|min:1',
        ]);

        // ✅ Création en base
        ResidentRequest::create([
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'formules' => $request->formules,
            'status'     => 'en_attente',
        ]);

        // ✅ Envoi de mail
        $data = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'formules' => $request->formules,
        ];

        //Mail::to('quadjovie.antonio@gmail.com')->send(new ResidencyRequestMail($data));
        Mail::to('fondationvillaseguro@gmail.com')->send(new ResidencyRequestMail($data));

        // ✅ Redirection
        return redirect()->route('user.become-resident')->with('success', 'Votre demande a été envoyée avec succès !');
    }
    

}
