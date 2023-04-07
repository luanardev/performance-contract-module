<?php

namespace Lumis\PerformanceContract\Http\Livewire;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;

class CreatePlan extends LivewireUI
{

    public mixed $financialYear;
    public mixed $appraiser;
    public mixed $financialYears;
    public mixed $staffMembers;

    public function __construct()
    {
        parent::__construct();
        $this->financialYear = null;
        $this->appraiser = null;
        $this->financialYears = FinancialYear::all();
        $this->staffMembers = Staff::all();
    }

    public function save()
    {
        $this->validate();
        $staff = StaffProfile::get();

        $submitted = Plan::submitted($staff, $this->appraiser, $this->financialYear);
        if($submitted){
            $this->toastrError('Performance contract exists');
        }else{
            $plan = new Plan();
            $plan->staff()->associate($staff);
            $plan->financialYear()->associate($this->financialYear);
            $plan->appraiser()->associate($this->appraiser);

            $plan->setDraft();
            $plan->save();
            $this->toastrSuccess('Performance contract created');
            return $this->redirectRoute('performance_contract.edit', [$plan]);
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
        return view('performancecontract::livewire.create-plan');
    }

}
