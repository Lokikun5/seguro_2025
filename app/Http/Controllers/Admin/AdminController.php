<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ResidentRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // On récupère tous les utilisateurs

        $residentRequests = ResidentRequest::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('users', 'residentRequests'));
    }

    public function updateResidentRequest(Request $request, $id)
    {
        $residentRequest = ResidentRequest::findOrFail($id);
        $residentRequest->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Demande mise à jour.');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,user,rédacteur',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->back()->with('success', 'Nouvel utilisateur ajouté avec succès.');
    }

}
