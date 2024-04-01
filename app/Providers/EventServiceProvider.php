<?php

namespace App\Providers;

use App\Events\ProjectLoaded;
use App\Events\UserRegistered;
use App\Listeners\AwardPointsForController;
use App\Listeners\AwardPointsForCounselor;
use App\Listeners\AwardPointsForMember;
use App\Listeners\AwardPointsForSeniorAccountant;
use App\Listeners\AwardReferralPoints;
use App\Listeners\RunOptimizationTasks;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // UserRegistered::class => [
        //     AwardPointsForMember::class,
        //     AwardPointsForSeniorAccountant::class,
        //     AwardPointsForCounselor::class,
        //     AwardPointsForController::class,
        //     // Add other listeners here
        // ],
        // UserRegistered::class => [
        //     AwardReferralPoints::class,
        // ],
        // ProjectLoaded::class => [
        //     RunOptimizationTasks::class,
        // ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
