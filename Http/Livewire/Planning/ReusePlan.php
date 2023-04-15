<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Lumis\PerformanceContract\Entities\Deliverable;
use Lumis\PerformanceContract\Entities\Indicator;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Entities\StaffProfile;

class ReusePlan extends CopyPlan
{

    public function save()
    {

        $this->validate();

        $staff = StaffProfile::get();

        $submitted = Plan::submitted(
            $staff,
            $this->selectedAppraiser,
            $this->selectedYear
        );

        if($submitted){
            $this->toastrError('Performance contract exists');
        }
        else{
            $newPlan = new Plan();
            $newPlan->staff()->associate($staff);
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

            $this->toastrSuccess('Performance contract created');
            $this->redirectRoute('performance_contract.plan.edit', $newPlan);
        }

    }

}
