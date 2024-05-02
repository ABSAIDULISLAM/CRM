<?php

namespace App\Providers;

use App\Events\ProjectLoaded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

            // View::composer(['admin.lead.index', 'admin.lead.create', 'admin.lead.edit', 'admin.lead.view', 'admin.Lead.search'], function ($view) {
            //     if (Auth::check()) {
            //         if (auth()->user()->role_as == 'admin') {
            //             $myRoute = 'Admin.';
            //         } elseif (auth()->user()->role_as == 'office_staff') {
            //             $myRoute = 'Office.';
            //         } elseif (auth()->user()->role_as == 'marketing_staff') {
            //             $myRoute = 'Marketing.';
            //         } else {
            //             $myRoute = 'User.';
            //         }

            //         $view->with('myRoute', $myRoute);
            //     }
            // });
        }
        // for load with artisan commands for project faster
        // event(new ProjectLoaded());
    }
}
