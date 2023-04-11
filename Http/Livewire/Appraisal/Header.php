<?php

namespace Lumis\PerformanceContract\Http\Livewire\Appraisal;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Plan;

class Header extends LivewireUI
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
        return view('performancecontract::livewire.appraisal.header');
    }
}
