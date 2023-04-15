<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Deliverable;
use Lumis\PerformanceContract\Entities\Indicator;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Entities\Staff;

class CopyPlan extends CreatePlan
{

    public mixed $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }


    public function save()
    {
        $this->validate();

        $submitted = Plan::submitted(
            $this->plan->staff,
            $this->selectedAppraiser,
            $this->selectedYear
        );

        if($submitted){
            $this->toastrError('Performance contract exists');
        }
        else{
            $newPlan = new Plan();
            $newPlan->staff()->associate($this->plan->staff);
            $newPlan->financialYear()->associate($this->selectedYear);
            $newPlan->appraiser()->associate($this->selectedAppraiser);
            $newPlan->save();

            foreach($this->plan->deliverables as $deliverable) {

                $newDeliverable = new Deliverable();
                $newDeliverable->name = $deliverable->name;
                $newDeliverable->plan()->associate($newPlan);
                $newDeliverable->pillar()->associate($deliverable->pillar);
                $newDeliverable->save();

                foreach($deliverable->indicators as $indicator){
                    $newIndicator = new Indicator();
                    $newIndicator->name = $indicator->name;
                    $newIndicator->target = $indicator->target;
                    $newIndicator->weight = $indicator->weight;
                    $newIndicator->deliverable()->associate($newDeliverable);
                    $newIndicator->save();
                }
            }

            $this->toastrSuccess('Performance contract copied');
            $this->redirectRoute('performance_contract.plan.edit', $newPlan);
        }

    }

}
