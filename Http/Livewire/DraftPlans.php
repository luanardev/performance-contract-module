<?php

namespace Lumis\PerformanceContract\Http\Livewire;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\StaffPlan;
use Lumis\StaffManagement\Entities\Staff;

class DraftPlans extends LivewireUI
{
    /**
     * @var Collection
     */
    public Collection $draftPlans;

    public function __construct()
    {
        parent::__construct();
        $this->draftPlans = collect();
    }

    public function mount(Staff $staff, FinancialYear $financialYear)
    {
        $staffPlan = new StaffPlan($staff, $financialYear);
        $this->draftPlans = $staffPlan->getRecentDrafts();
    }

    public function delete(Plan $plan)
    {
        $plan->delete();
        $this->toastr('Draft deleted');
        $this->redirect(route('performance_contract.home'));
    }

    public function render()
    {
        return view('performancecontract::livewire.draft-plans');
    }
}
