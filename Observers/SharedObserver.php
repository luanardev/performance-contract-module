<?php

namespace Lumis\PerformanceContract\Observers;

use Lumis\PerformanceContract\Entities\Outbox;
use Lumis\PerformanceContract\Entities\Shared;

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
