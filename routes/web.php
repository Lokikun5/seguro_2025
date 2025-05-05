<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Resident;
use App\Models\Event;
use App\Models\Page;
use App\Models\Media;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/les-residents/', [ResidentController::class, 'index'])->name('residents.index');
Route::get('/resident/{slug}', [ResidentController::class, 'show'])->name('residents.show');
Route::get('/les-événements-de-la-resistance/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/page/{slug}',[PageController::class, 'show'])->name('page.show');
Route::get('/article',[PageController::class, 'index'])->name('pages.index');
Route::get('/presentation-resistance', function () {
    return view('presentation');
})->name('presentation');
Route::resource('media', MediaController::class);
Route::get('/cercle-des-amis', function(){ return view('friends_circle');})->name('friends_circle');
Route::get('/devenir-resident', function(){ return view('become_resident');})->name('become_resident');
Route::get('/inspiration', function(){ return view('inspiration');})->name('inspiration');
Route::get('/faire-un-don', function(){ return view('make_a_donation');})->name('make_a_donation');

Route::get('/gallery', [MediaController::class, 'index'])->name('gallery.index');
Route::redirect('/media', '/gallery', 301);
// Route vers la page de login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour le traitement de la connexion
Route::post('login', [LoginController::class, 'login']);

// Route pour la déconnexion
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes([
    'register' => true, // ← autorise l'inscription
    'reset' => true,
    'verify' => true,
]);


// Page protégée après login + email vérifié
Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');



    Route::get('/sitemap.xml', function () {
        $sitemap = Sitemap::create()
            // Routes statiques
            ->add(Url::create(route('welcome'))->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create(route('residents.index'))->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create(route('events.index'))->setPriority(0.8)->setChangeFrequency('weekly'))
            ->add(Url::create(route('pages.index'))->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create(route('presentation'))->setPriority(0.6)->setChangeFrequency('monthly'))
            ->add(Url::create(route('friends_circle'))->setPriority(0.6)->setChangeFrequency('monthly'))
            ->add(Url::create(route('become_resident'))->setPriority(0.6)->setChangeFrequency('monthly'))
            ->add(Url::create(route('inspiration'))->setPriority(0.5)->setChangeFrequency('monthly'))
            ->add(Url::create(route('make_a_donation'))->setPriority(0.7)->setChangeFrequency('monthly'))
            ->add(Url::create(route('gallery.index'))->setPriority(0.7)->setChangeFrequency('monthly'));
    
        // Pages dynamiques : residents
        foreach (Resident::where('active', true)->get() as $resident) {
            $sitemap->add(
                Url::create(route('residents.show', ['slug' => $resident->resident_slug]))
                    ->setLastModificationDate($resident->updated_at)
                    ->setChangeFrequency('monthly')
                    ->setPriority(0.7)
            );
        }
    
        // Pages dynamiques : events
        foreach (Event::where('active', true)->get() as $event) {
            $sitemap->add(
                Url::create(route('events.show', ['slug' => $event->slug]))
                    ->setLastModificationDate($event->updated_at)
                    ->setChangeFrequency('monthly')
                    ->setPriority(0.7)
            );
        }
    
        // Pages dynamiques : articles
        foreach (Page::where('active', true)->get() as $page) {
            $url = Url::create(route('page.show', ['slug' => $page->slug]))
                ->setChangeFrequency('monthly')
                ->setPriority(0.6);
        
            if ($page->updated_at) {
                $url->setLastModificationDate($page->updated_at);
            }
        
            $sitemap->add($url);
        }
        
    
        return $sitemap->toResponse(request());
    });


    Route::get('/admin/dashboard', function () {
        return 'Bienvenue admin';
    })->middleware(['auth'])->name('admin.dashboard');
    
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->middleware(['auth'])->name('user.dashboard');

    Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
      
        Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

        Route::get('/devenir-resident', [App\Http\Controllers\UserController::class, 'becomeResident'])->name('become-resident');
        Route::post('/devenir-resident', [App\Http\Controllers\UserController::class, 'submitResidentRequest'])->name('become-resident.submit');


    });
    
    
    
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'is_admin'])  // ✅ Protection par rôle
    ->name('admin.dashboard');

    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/media', [MediaController::class, 'adminIndex'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

         // Résidents
        Route::get('/residents', [ResidentController::class, 'adminIndex'])->name('residents.index');
        Route::get('/residents/create', [ResidentController::class, 'create'])->name('residents.create');
        Route::post('/residents', [ResidentController::class, 'store'])->name('residents.store');
        Route::get('/residents/{resident}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
        Route::put('/residents/{resident}', [ResidentController::class, 'update'])->name('residents.update');
        Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])->name('residents.destroy');
        Route::patch('/residents/{resident}/toggle-active', [ResidentController::class, 'toggleActive'])->name('residents.toggle-active');

        Route::get('/events', [EventController::class, 'adminIndex'])->name('events.index');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::patch('/events/{event}/toggle-active', [EventController::class, 'toggleActive'])->name('events.toggle-active');

        // Pages
        Route::get('/pages', [PageController::class, 'adminIndex'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
        Route::patch('/pages/{page}/toggle-active', [PageController::class, 'toggleActive'])->name('pages.toggle-active');

        
        Route::delete('/admin/media/{media}', [MediaController::class, 'destroy'])->name('admin.media.destroy');

        Route::put('/resident-requests/{id}', [AdminController::class, 'updateResidentRequest'])->name('resident-requests.update');
        Route::post('/users', [AdminController::class, 'createUser'])->name('users.store');
    });
    