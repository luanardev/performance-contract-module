<?php

namespace Lumis\PerformanceContract\Http\Livewire;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;

class ShowPlan extends LivewireUI
{
    public Plan $plan;
    public Collection $pillars;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->pillars = Pillar::all();
    }

    public function render()
    {
        return view('performancecontract::livewire.show-plan');
    }
}
