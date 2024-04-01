<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class RunOptimizationTasks implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {
        // Run your desired commands upon project load
        // Artisan::call('optimize');
        // Artisan::call('view:clear');
        // Artisan::call('route:clear');
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
    }
}
