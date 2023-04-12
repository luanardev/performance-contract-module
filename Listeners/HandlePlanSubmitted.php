<?php

namespace Lumis\PerformanceContract\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\PerformanceContract\Events\PlanSubmitted;
use Lumis\PerformanceContract\Notifications\PerformanceContractSubmission;
use Lumis\PerformanceContract\Notifications\PerformanceContractSubmitted;

class HandlePlanSubmitted implements ShouldQueue
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
     * @param  PlanSubmitted  $event
     * @return void
     */
    public function handle(PlanSubmitted $event): void
    {
        $plan = $event->plan;
        $staff = $event->plan->staff;
        $appraiser = $event->plan->appraiser;

        // notify the staff who submitted the plan
        $staffNotification = new PerformanceContractSubmitted($plan);
        Notification::send($staff, $staffNotification);

        // notify appraiser about the submitted plan
        $appraiserNotification = new PerformanceContractSubmission($plan);
        Notification::send($appraiser, $appraiserNotification);

    }
}
