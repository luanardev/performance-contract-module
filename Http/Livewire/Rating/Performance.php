<?php

namespace Lumis\PerformanceContract\Http\Livewire\Rating;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\EndYearPerformance;
use Lumis\PerformanceContract\Entities\MidYearPerformance;
use Lumis\PerformanceContract\Entities\OverallPerformance;
use Lumis\PerformanceContract\Entities\Plan;

class Performance extends LivewireUI
{
    public Plan $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function midYear(): MidYearPerformance
    {
        return $this->plan->midYearPerformance();
    }

    public function endYear(): EndYearPerformance
    {
        return $this->plan->endYearPerformance();
    }

    public function overall(): OverallPerformance
    {
        return $this->plan->overallPerformance();
    }

    public function render()
    {
        return view('performancecontract::livewire.rating.performance');
    }
}
