<?php

namespace Lumis\PerformanceContract\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\Shared;
use Lumis\PerformanceContract\Events\PlanCreated;
use Lumis\PerformanceContract\Events\PlanShared;
use Lumis\PerformanceContract\Events\PlanSubmitted;
use Lumis\PerformanceContract\Listeners\HandlePlanCreated;
use Lumis\PerformanceContract\Listeners\HandlePlanShared;
use Lumis\PerformanceContract\Listeners\HandlePlanSubmitted;
use Lumis\PerformanceContract\Observers\PlanObserver;
use Lumis\PerformanceContract\Observers\SharedObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        PlanCreated::class => [
            HandlePlanCreated::class,
        ],

        PlanSubmitted::class => [
            HandlePlanSubmitted::class,
        ],

        PlanShared::class => [
            HandlePlanShared::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(
            PlanObserver::class
        );

        Shared::observe(
            SharedObserver::class
        );
    }


}
