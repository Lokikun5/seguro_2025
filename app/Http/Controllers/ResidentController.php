<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::where('active', true)->orderBy('created_at', 'desc')->get();
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
            'gallery_photo.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*' => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');
        $defaultPhoto = 'images/residents/seguro-default.webp';

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/residents');
            $data['profile_pic'] = 'storage/residents/' . basename($path);
        } else {
            $data['profile_pic'] = $defaultPhoto;
        }

        $data['meta_title'] = $request->input('meta_title') ?? $data['first_name'] . ' ' . $data['last_name'];
        $data['meta_description'] = $request->input('meta_description') ?? $data['introduce'];

        $resident = Resident::create($data);

        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $photo) {
                $path = $photo->store('public/media/photos');
                Media::create([
                    'name' => 'Photo de ' . $resident->first_name,
                    'type' => 'photo',
                    'file_name' => basename($path),
                    'resident_page_id' => $resident->id,
                ]);
            }
        }

        if ($request->gallery_video) {
            foreach ($request->gallery_video as $url) {
                if ($url) {
                    Media::create([
                        'name' => 'Vidéo de ' . $resident->first_name,
                        'type' => 'video',
                        'file_name' => $url,
                        'resident_page_id' => $resident->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.residents.index')->with('success', 'Résident ajouté avec succès.');
    }

    public function show($slug)
    {
        $resident = Resident::where('resident_slug', $slug)->firstOrFail();
        $media = $resident->media()->get();
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
            'gallery_photo.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*' => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');
        $defaultPhoto = 'images/residents/seguro-default.webp';

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/residents');
            $data['profile_pic'] = 'storage/residents/' . basename($path);
        } elseif (!$resident->profile_pic || !file_exists(public_path($resident->profile_pic))) {
            $data['profile_pic'] = $defaultPhoto;
        }

        $data['meta_title'] = $request->input('meta_title') ?? $data['first_name'] . ' ' . $data['last_name'];
        $data['meta_description'] = $request->input('meta_description') ?? $data['introduce'];

        $resident->update($data);

        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $file) {
                $path = $file->store('public/media/photos');
                Media::create([
                    'name' => 'Photo de ' . $resident->first_name,
                    'file_name' => basename($path),
                    'type' => 'photo',
                    'resident_page_id' => $resident->id,
                ]);
            }
        }

        if ($request->filled('gallery_video')) {
            foreach ($request->gallery_video as $videoUrl) {
                if ($videoUrl) {
                    Media::create([
                        'name' => 'Vidéo de ' . $resident->first_name,
                        'file_name' => $videoUrl,
                        'type' => 'video',
                        'resident_page_id' => $resident->id,
                    ]);
                }
            }
        }

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