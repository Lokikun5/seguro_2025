<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('residents.index', compact('residents'));
    }

    public function adminIndex()
    {
        $residents = Resident::orderBy('created_at', 'desc')->get();
        return view('admin.residents.index', compact('residents'));
    }

    public function create()
    {
        return view('admin.residents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'performance' => 'required|string|max:255',
            'introduce' => 'required|string',
            'description' => 'required|string',
            'profile_pic' => 'nullable|file|image|max:2048',
            'linkedin_slug' => 'nullable|string|max:255',
            'instagram_slug' => 'nullable|string|max:255',
            'active' => 'required|boolean',
        ]);

        $data = $request->except('profile_pic');

        $defaultPhoto = 'images/residents/seguro-default.webp';

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/residents');
            $data['profile_pic'] = 'storage/residents/' . basename($path);
        } else {
            $data['profile_pic'] = $defaultPhoto;
        }

        Resident::create($data);

        return redirect()->route('admin.residents.index')->with('success', 'Résident ajouté avec succès.');
    }

    public function show($slug)
    {
        $resident = Resident::where('resident_slug', $slug)->firstOrFail();
        $media = $resident->media()->where('resident_page_id', $resident->id)->get();
        return view('residents.show', compact('resident', 'media'));
    }

    public function edit(Resident $resident)
    {
        return view('admin.residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'performance' => 'required|string|max:255',
            'introduce' => 'required|string',
            'description' => 'required|string',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'linkedin_slug' => 'nullable|string|max:255',
            'instagram_slug' => 'nullable|string|max:255',
            'active' => 'required|boolean',
        ]);

        $data = $request->except('profile_pic');
        $defaultPhoto = 'images/residents/seguro-default.webp';

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/residents');
            $data['profile_pic'] = 'storage/residents/' . basename($path);
        } elseif (!$resident->profile_pic || !file_exists(public_path($resident->profile_pic))) {
            $data['profile_pic'] = $defaultPhoto;
        }

        $resident->update($data);

        return redirect()->route('admin.residents.index')->with('success', 'Résident mis à jour.');
    }

    public function toggleActive(Request $request, Resident $resident)
    {
        $resident->update(['active' => $request->input('active')]);
        return response()->json(['success' => true]);
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();
        return redirect()->route('admin.residents.index')->with('success', 'Résident supprimé.');
    }
}