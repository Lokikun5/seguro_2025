<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // On récupère tous les utilisateurs
        return view('admin.dashboard', compact('users'));
    }
}
