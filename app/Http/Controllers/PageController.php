<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::where('active', true)->orderBy('created_at', 'desc')->get();
        return view('page.index', compact('pages'));
    }

    public function adminIndex()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }


    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'meta_title'        => 'required|string|max:255',
            'meta_description'  => 'required|string|max:255',
            'profile_pic'       => 'nullable|file|image|max:2048',
            'introduce'         => 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|string|max:255',
            'active'            => 'required|boolean',
            'slug'              => 'required|string|max:255|unique:pages,slug',
            'gallery_photo.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*'   => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');

        // ✅ Upload profil
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/pages');
            $data['profile_pic'] = 'storage/pages/' . basename($path);
        }

        // ✅ Slug forcé (au cas où)
        $data['slug'] = Str::slug($request->slug);

        $page = Page::create($data);

        // ✅ Galerie photo
        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $file) {
                $path = $file->store('public/media/photos');
                Media::create([
                    'name'       => 'Photo de ' . $page->title,
                    'type'       => 'photo',
                    'file_name'  => basename($path),
                    'page_id'    => $page->id,
                ]);
            }
        }

        // ✅ Galerie vidéo
        if ($request->filled('gallery_video')) {
            foreach ($request->gallery_video as $url) {
                if ($url) {
                    Media::create([
                        'name'       => 'Vidéo de ' . $page->title,
                        'type'       => 'video',
                        'file_name'  => $url,
                        'page_id'    => $page->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page ajoutée avec succès.');
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $media = $page->media()->get();
        $otherPages = Page::where('id', '!=', $page->id)
        ->where('active', true)
        ->inRandomOrder()
        ->limit(6)
        ->get();
        return view('page.show', compact('page', 'media','otherPages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'meta_title'        => 'required|string|max:255',
            'meta_description'  => 'required|string|max:255',
            'profile_pic'       => 'nullable|file|image|max:2048',
            'introduce'         => 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|string|max:255',
            'active'            => 'required|boolean',
            'slug'              => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'gallery_photo.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*'   => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/pages');
            $data['profile_pic'] = 'storage/pages/' . basename($path);
        }

        $data['slug'] = Str::slug($request->slug);
        $page->update($data);

        // ✅ Ajouter nouvelles photos
        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $file) {
                $path = $file->store('public/media/photos');
                Media::create([
                    'name'      => 'Photo de ' . $page->title,
                    'type'      => 'photo',
                    'file_name' => basename($path),
                    'page_id'   => $page->id,
                ]);
            }
        }

        // ✅ Ajouter nouvelles vidéos
        if ($request->filled('gallery_video')) {
            foreach ($request->gallery_video as $url) {
                if ($url) {
                    Media::create([
                        'name'      => 'Vidéo de ' . $page->title,
                        'type'      => 'video',
                        'file_name' => $url,
                        'page_id'   => $page->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour : ' . $page->title);
    }

    public function toggleActive(Request $request, Page $page)
    {
        $page->update(['active' => $request->input('active')]);
        return response()->json(['success' => true]);
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page supprimée avec succès.');
    }
    
}