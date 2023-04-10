<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Deliverable;
use Lumis\PerformanceContract\Entities\Indicator;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Entities\Staff;

class CopyPlan extends LivewireUI
{
    public mixed $financialYear;
    public mixed $appraiser;
    public mixed $financialYears;
    public mixed $staffMembers;
    public mixed $plan;

    public function __construct()
    {
        parent::__construct();
        $this->financialYear = null;
        $this->appraiser = null;
        $this->plan = null;
        $this->financialYears = FinancialYear::all();
        $this->staffMembers = Staff::all();
    }

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function save()
    {
        $this->validate();

        $submitted = Plan::submitted(
            $this->plan->staff,
            $this->appraiser,
            $this->financialYear
        );

        if($submitted){
            $this->toastrError('Performance contract exists');
        }
        else{
            $newPlan = new Plan();
            $newPlan->staff()->associate($this->plan->staff);
            $newPlan->financialYear()->associate($this->financialYear);
            $newPlan->appraiser()->associate($this->appraiser);
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
            $this->redirectRoute('performance_contract.edit', [$newPlan]);
        }

    }

    public function rules()
    {
        return [
            'financialYear' => 'required',
            'appraiser' => 'required'
        ];
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.copy-plan');
    }
}
