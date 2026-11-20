<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('APP_ENV') !== 'local') {
            $this->app->useStoragePath($_ENV['APP_STORAGE'] ?? base_path('storage'));
            }}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
