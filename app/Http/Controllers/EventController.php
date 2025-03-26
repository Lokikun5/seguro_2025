<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        \Carbon\Carbon::setLocale('fr');
        $events = Event::where('active', true)
            ->orderBy('start_date', 'desc')
            ->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' =>'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'profile_pic' => 'required|string|max:255',
            'introduce' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'active' => 'required|boolean',
            'slug' => 'required|string|max:255',
            'start_date'=>'required|date',
            'performance'=>'required|string|max:255',
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show($slug)
    {
        \Carbon\Carbon::setLocale('fr');
        $event = Event::where('slug', $slug)->firstOrFail();
        $media = $event->media()->get();
        return view('events.show', compact('event', 'media'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' =>'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'profile_pic' => 'required|string|max:255',
            'introduce' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'active' => 'required|boolean',
            'slug' => 'required|string|max:255',
            'start_date'=>'required|date',
            'performance'=>'required|string|max:255',
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

}
