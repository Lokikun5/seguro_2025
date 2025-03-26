<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix MySQL older versions
        Schema::defaultStringLength(191);

        // Forcer l’URL utilisée dans les e-mails (utile pour Mailtrap en local)
        if (app()->environment('local')) {
            URL::forceRootUrl(config('app.url'));
        }

        Route::aliasMiddleware('is_admin', IsAdmin::class);
    }
}
