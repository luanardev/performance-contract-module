<?php

namespace Lumis\PerformanceContract\Http\Livewire\Report;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Entities\Staff;

class Summary extends LivewireUI
{

    public Staff $appraiser;
    public Collection $financialYears;
    public Collection $plans;
    public mixed $selectedYear;
    public mixed $financialYear;

    public function __construct()
    {
        parent::__construct();
        $this->plans = collect();
        $this->financialYears = $this->financialYears();
        $this->selectedYear = null;
        $this->financialYear = null;
    }

    public function mount(Staff $appraiser)
    {
        $this->appraiser = $appraiser;
    }

    public function financialYears()
    {
        return FinancialYear::latest()->limit(2)->get();
    }

    public function plans(): Collection
    {
        return $this->plans;
    }

    public function viewable(): bool
    {
        return (bool) $this->plans->count();
    }

    public function submit()
    {
        if(!empty($this->selectedYear)){
            $this->plans = Plan::appraisedBy($this->appraiser)
                ->where('financial_year', $this->selectedYear)
                ->get();
            $this->financialYear = FinancialYear::find($this->selectedYear);
        }
    }

    protected function rules()
    {
        return [
            'selectedYear' => 'required'
        ];
    }

    public function render()
    {
        return view('performancecontract::livewire.report.summary');
    }
}
