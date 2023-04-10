<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\StaffPlan;
use Lumis\StaffManagement\Entities\Staff;

class PreviousPlans extends LivewireUI
{
    /**
     * @var Collection
     */
    public Collection $previousPlans;

    public function __construct()
    {
        parent::__construct();
        $this->previousPlans = collect();
    }

    public function mount(Staff $staff)
    {
        $staffPlan = new StaffPlan($staff);
        $this->previousPlans = $staffPlan->getArchivePlans();
    }

    public function render()
    {
        return view('performancecontract::livewire.planning.previous-plans');
    }
}
