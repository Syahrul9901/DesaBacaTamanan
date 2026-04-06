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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Create covers directory if it doesn't exist
        if (!is_dir(public_path('covers'))) {
            mkdir(public_path('covers'), 0755, true);
        }
    }
}
