<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL; // <- tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa load routes/api.php
        if (file_exists(base_path('routes/api.php'))) {
            Route::prefix('api')
                 ->middleware('api')
                 ->group(base_path('routes/api.php'));
        }

        // Paksa Laravel gunakan HTTPS di production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
