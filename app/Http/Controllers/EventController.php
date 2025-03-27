<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Media;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        $events = Event::where('active', true)
            ->orderBy('start_date', 'desc')
            ->get();
        return view('events.index', compact('events'));
    }

    public function adminIndex()
    {
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' =>'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'profile_pic' => 'nullable|file|image|max:2048',
            'introduce' => 'required|string|max:255',
            'description' => 'required|string',
            'active' => 'required|boolean',
            'slug' => 'required|string|max:255',
            'start_date'=>'required|date',
            'performance'=>'required|string|max:255',
            'gallery_photo.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*' => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/events');
            $data['profile_pic'] = 'storage/events/' . basename($path);
        }

        $event = Event::create($data);

        // Galerie photo
        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $photo) {
                $path = $photo->store('public/media/photos');
                Media::create([
                    'name' => 'Photo de ' . $event->title,
                    'type' => 'photo',
                    'file_name' => basename($path),
                    'event_page_id' => $event->id,
                ]);
            }
        }

        // Galerie vidéo
        if ($request->filled('gallery_video')) {
            foreach ($request->gallery_video as $url) {
                if ($url) {
                    Media::create([
                        'name' => 'Vidéo de ' . $event->title,
                        'type' => 'video',
                        'file_name' => $url,
                        'event_page_id' => $event->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Événement  "'.$event->title. '" ajouté avec succès.');
    }

    public function show($slug)
    {
        Carbon::setLocale('fr');
        $event = Event::where('slug', $slug)->firstOrFail();
        $media = $event->media()->get();
        return view('events.show', compact('event', 'media'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' =>'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'profile_pic' => 'nullable|file|image|max:2048',
            'introduce' => 'required|string|max:255',
            'description' => 'required|string',
            'active' => 'required|boolean',
            'slug' => 'required|string|max:255',
            'start_date'=>'required|date',
            'performance'=>'required|string|max:255',
            'gallery_photo.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_video.*' => 'nullable|url',
        ]);

        $data = $request->except('profile_pic', 'gallery_photo', 'gallery_video');

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('public/events');
            $data['profile_pic'] = 'storage/events/' . basename($path);
        }

        $event->update($data);

        // Galerie photo
        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $file) {
                $path = $file->store('public/media/photos');
                Media::create([
                    'name' => 'Photo de ' . $event->title,
                    'file_name' => basename($path),
                    'type' => 'photo',
                    'event_page_id' => $event->id,
                ]);
            }
        }

        // Galerie vidéo
        if ($request->filled('gallery_video')) {
            foreach ($request->gallery_video as $videoUrl) {
                if ($videoUrl) {
                    Media::create([
                        'name' => 'Vidéo de ' . $event->title,
                        'file_name' => $videoUrl,
                        'type' => 'video',
                        'event_page_id' => $event->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Événement "' .$event->title. '" mis à jour avec succès.');
    }

    public function toggleActive(Request $request, Event $event)
    {
        $event->update(['active' => $request->input('active')]);
        return response()->json(['success' => true]);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Événement "'.$event->title. '" supprimé avec succès.');
    }
}