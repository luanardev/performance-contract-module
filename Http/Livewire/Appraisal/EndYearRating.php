<?php

namespace Lumis\PerformanceContract\Http\Livewire\Appraisal;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;

class EndYearRating extends LivewireUI
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
        return view('performancecontract::livewire.appraisal.end-year-rating');
    }
}
