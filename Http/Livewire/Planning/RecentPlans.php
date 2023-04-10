<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\StaffPlan;
use Lumis\StaffManagement\Entities\Staff;

class RecentPlans extends LivewireUI
{
    /**
     * @var Collection
     */
    public Collection $recentPlans;

    public function __construct()
    {
        parent::__construct();
        $this->recentPlans = collect();
    }

    public function mount(Staff $staff, FinancialYear $financialYear)
    {
        $staffPlan = new StaffPlan($staff, $financialYear);
        $this->recentPlans = $staffPlan->getRecentPlans();
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.recent-plans');
    }
}
