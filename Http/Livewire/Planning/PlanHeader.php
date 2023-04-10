<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Plan;

class PlanHeader extends LivewireUI
{
    public Plan $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function getSession(): string
    {
        return $this->plan->financialYear->name;
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.plan-header');
    }
}
