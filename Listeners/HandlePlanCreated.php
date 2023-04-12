<?php

namespace Lumis\PerformanceContract\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\PerformanceContract\Events\PlanCreated;
use Lumis\PerformanceContract\Notifications\PerformanceContractCreated;

class HandlePlanCreated implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PlanCreated  $event
     * @return void
     */
    public function handle(PlanCreated $event): void
    {
        $plan = $event->plan;
        $staff = $event->plan->staff;

        // notify the staff who created the plan
        $notification = new PerformanceContractCreated($plan);
        Notification::send($staff, $notification);
    }
}
