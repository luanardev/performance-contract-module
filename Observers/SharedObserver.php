<?php

namespace Lumis\PerformanceContract\Observers;

use Lumis\PerformanceContract\Entities\Outbox;
use Lumis\PerformanceContract\Entities\Shared;
use Lumis\PerformanceContract\Events\PlanShared;

class SharedObserver
{


    /**
     * Handle the "created" event.
     *
     * @param Shared $shared
     * @return void
     */
    public function created(Shared $shared): void
    {
        $outbox = new Outbox();
        $outbox->fill($shared->getAttributes());
        $outbox->save();

        PlanShared::dispatch($shared);
    }

    /**
     * Handle the "updated" event.
     *
     * @param Shared $shared
     * @return void
     */
    public function updated(Shared $shared): void
    {


    }

    /**
     * Handle the "deleted" event.
     *
     * @param Shared $shared
     * @return void
     */
    public function deleted(Shared $shared): void
    {

    }


}
