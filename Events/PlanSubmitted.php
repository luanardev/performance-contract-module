<?php

namespace Lumis\PerformanceContract\Events;

use Illuminate\Queue\SerializesModels;

class PlanSubmitted
{
    use SerializesModels;

    public Plan $plan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
