<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Entities\StaffProfile;

class CreatePlan extends LivewireUI
{
    public mixed $financialYears;
    public mixed $staffMembers;
    public mixed $searchAppraiser;
    public mixed $selectedAppraiser;
    public mixed $selectedYear;
    public mixed $showDropdown = true;

    public function __construct()
    {
        parent::__construct();
        $this->selectedYear = null;
        $this->selectedAppraiser = null;
        $this->staffMembers = collect();
        $this->searchAppraiser = null;
        $this->financialYears = FinancialYear::latest()->limit(5)->get();
    }

    public function updatedSearchAppraiser($value)
    {
        $this->toggleDropdown();
        if(!empty($value)){
            $this->staffMembers = Staff::search($value)->get();
        }
    }

    public function selectAppraiser(Staff $staff)
    {
        $this->selectedAppraiser = $staff;
        $this->searchAppraiser = $staff->fullname()." ({$staff->employment->getPosition()})";
        $this->toggleDropdown();
    }

    private function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

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
            $plan = new Plan();
            $plan->staff()->associate($staff);
            $plan->financialYear()->associate($this->selectedYear);
            $plan->appraiser()->associate($this->selectedAppraiser);
            $plan->setDraft();
            $plan->save();
            $this->toastrSuccess('Performance contract created');
            $this->redirectRoute('performance_contract.plan.edit', $plan);
        }

    }

    public function rules()
    {
        return [
          'selectedYear' => 'required',
          'searchAppraiser' => 'required'
        ];
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.create-plan');
    }

}
