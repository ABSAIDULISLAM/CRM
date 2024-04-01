<?php

namespace App\Providers;

use App\Events\ProjectLoaded;
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
        {
            // \Debugbar::disable();
        }
        // for load with artisan commands for project faster
        // event(new ProjectLoaded());
    }
}
