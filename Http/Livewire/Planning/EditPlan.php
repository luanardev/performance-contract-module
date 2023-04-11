<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;

class EditPlan extends LivewireUI
{
    public Plan $plan;
    public Collection $pillars;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->pillars = Pillar::all();
    }

    public function submit()
    {
        if($this->plan->totalWeight() < 100){
            $this->toastrError('Performance contract incomplete');
        }else{
            $this->plan->completed()->submittedAt()->update();
            $this->toastr('Performance contract submitted');
            $this->redirectRoute('performance_contract.plan.show', $this->plan);
        }
    }

    public function delete()
    {
        $this->plan->delete();
        $this->toastr('Performance contract deleted');
        $this->redirectRoute('performance_contract.home');
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.edit-plan');
    }


}
