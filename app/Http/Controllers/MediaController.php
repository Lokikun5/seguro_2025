<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    // Galerie publique (site vitrine)
    public function index()
    {
        $media = Media::where('gallery_page', true)->get();
        return view('media.index', compact('media'));
    }

    // Galerie admin (back-office)
    public function adminIndex()
    {
        $photos = Media::where('type', 'photo')->get();
        $videos = Media::where('type', 'video')->get();
        return view('admin.media.index', compact('photos', 'videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:photo,video',
            'legende' => 'nullable|string',
            'gallery_page' => 'nullable|boolean',
            'event_page_id' => 'nullable|exists:events,id',
            'page_id' => 'nullable|exists:pages,id',
            'resident_page_id' => 'nullable|exists:residents,id',
        ]);

        if ($request->type === 'photo') {
            $request->validate([
                'file_name' => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
        } elseif ($request->type === 'video') {
            $request->validate([
                'file_name' => 'required|url',
            ]);
        }

        $media = new Media();
        $media->fill($request->except('file_name'));

        if ($request->type === 'photo' && $request->hasFile('file_name')) {
            $path = $request->file('file_name')->store('public/media/photos');
            $media->file_name = basename($path);
        } else {
            $media->file_name = $request->file_name; // URL pour vidéo
        }

        $media->save();

        return redirect()->route('admin.media.index')->with('success', 'Media ajouté avec succès.');
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'legende' => 'nullable|string',
            'gallery_page' => 'boolean',
        ]);

        $media->update($request->only('name', 'legende', 'gallery_page'));

        return redirect()->route('admin.media.index')->with('success', 'Media mis à jour.');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media supprimé.');
    }
}