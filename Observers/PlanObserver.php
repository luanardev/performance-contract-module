<?php

namespace Lumis\PerformanceContract\Observers;

use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Events\PlanCreated;
use Lumis\PerformanceContract\Events\PlanSubmitted;

class PlanObserver
{


    /**
     * Handle the "created" event.
     *
     * @param Plan $plan
     * @return void
     */
    public function created(Plan $plan): void
    {
        PlanCreated::dispatch($plan);
    }

    /**
     * Handle the "updated" event.
     *
     * @param Plan $plan
     * @return void
     */
    public function updated(Plan $plan): void
    {
        if($plan->isCompleted()){
            PlanSubmitted::dispatch($plan);
        }

    }

    /**
     * Handle the "deleted" event.
     *
     * @param Plan $plan
     * @return void
     */
    public function deleted(Plan $plan): void
    {

    }


}
