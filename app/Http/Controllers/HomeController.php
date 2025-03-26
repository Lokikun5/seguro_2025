<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Resident;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Collect the 3 most recent residents
        $residents = Resident::where('active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get(['first_name', 'last_name', 'nationality', 'performance', 'profile_pic', 'resident_slug']);

        $events = Event::where('active', true)
            ->orderBy('start_date', 'desc')
            ->take(3)
            ->get(['title','start_date','profile_pic','slug','performance'])
        ;

        $articles = Page::where('active', true)
            ->where('type', 'article')
            ->take(3)
            ->get(['title', 'profile_pic', 'slug' ,'meta_description','created_at' ]);


        // Return the 'welcome' view with residents
        return view('welcome', compact('residents','events','articles'));
    }
}
