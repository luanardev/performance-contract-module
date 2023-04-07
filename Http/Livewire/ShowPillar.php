<?php

namespace Lumis\PerformanceContract\Http\Livewire;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;

class ShowPillar extends LivewireUI
{
    public Plan $plan;
    public Pillar $pillar;

    public function mount(Plan $plan, Pillar $pillar)
    {
        $this->plan = $plan;
        $this->pillar = $pillar;

    }

    public function deliverables(): Collection
    {
        return $this->plan->getPillarDeliverables($this->pillar);
    }

    public function getTotalWeight()
    {
        return $this->plan->getPillarWeight($this->pillar);
    }

    public function hasDeliverables(): bool
    {
        return (bool) $this->plan->deliverables->count();

    }

    public function render()
    {
        return view('performancecontract::livewire.show-pillar');
    }
}
