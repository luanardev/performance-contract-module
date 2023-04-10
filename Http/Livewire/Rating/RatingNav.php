<?php

namespace Lumis\PerformanceContract\Http\Livewire\Rating;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Plan;

class RatingNav extends LivewireUI
{
    public Plan $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function render()
    {
        return view('performancecontract::livewire.rating.rating-nav');
    }
}
