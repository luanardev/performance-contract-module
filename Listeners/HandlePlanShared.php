<?php

namespace Lumis\PerformanceContract\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\PerformanceContract\Events\PlanShared;
use Lumis\PerformanceContract\Notifications\PerformanceContractShared;

class HandlePlanShared implements ShouldQueue
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
     * @param  PlanShared  $event
     * @return void
     */
    public function handle(PlanShared $event): void
    {
        $plan = $event->plan;
        $receiver = $event->plan->receiver;

        // notify receiver of the plan
        $notification = new PerformanceContractShared($plan);
        Notification::send($receiver, $notification);
    }
}
