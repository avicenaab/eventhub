<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']) || config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}