<?php

namespace Lumis\PerformanceContract\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lumis\PerformanceContract\Entities\Shared;

class PlanShared
{
    use Dispatchable,SerializesModels;

    public Shared $plan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Shared $plan)
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
