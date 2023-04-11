<?php

namespace Lumis\PerformanceContract\Http\Livewire\Appraisal;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\EndYear;
use Lumis\PerformanceContract\Entities\MidYear;
use Lumis\PerformanceContract\Entities\Overall;
use Lumis\PerformanceContract\Entities\Plan;

class Performance extends LivewireUI
{
    public Plan $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function midYear(): MidYear
    {
        return $this->plan->midYearPerformance();
    }

    public function endYear(): EndYear
    {
        return $this->plan->endYearPerformance();
    }

    public function overall(): Overall
    {
        return $this->plan->overallPerformance();
    }

    public function render()
    {
        return view('performancecontract::livewire.appraisal.performance');
    }
}
