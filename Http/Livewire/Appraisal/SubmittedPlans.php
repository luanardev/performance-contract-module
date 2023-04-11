<?php

namespace Lumis\PerformanceContract\Http\Livewire\Appraisal;

use Illuminate\Database\Eloquent\Builder;
use Luanardev\LivewireAlert\WithLivewireAlert;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\Shared;
use Lumis\StaffManagement\DataViews\StaffView;
use Lumis\StaffManagement\Entities\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SubmittedPlans extends DataTableComponent
{
    use WithLivewireAlert;

    public Staff $appraiser;
    public FinancialYear $financialYear;

    public function mount(Staff $appraiser, FinancialYear $financialYear)
    {
        $this->appraiser = $appraiser;
        $this->financialYear = $financialYear;
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchDisabled();
        $this->setColumnSelectDisabled();
        $this->setPaginationDisabled();
        $this->setBulkActionsDisabled();

        $this->setTableRowUrl(function($row) {
            return route('performance_contract.appraisal.show', $row);
        });
    }

    public function columns(): array
    {
        return [
            Column::make('ID')->label(function(Plan $row, Column $column){
                return $row->staff->employee_number;
            }),
            Column::make('Name')->label(function(Plan $row, Column $column){
                return $row->staff->fullname();
            }),
            Column::make('Position')->label(function(Plan $row, Column $column){
                return $row->staff->employment->getPosition();
            }),
            Column::make('')->label(function(Plan $row, Column $column){
                return $row->submittedPeriod();
            }),
        ];
    }

    public function builder(): Builder
    {
        return Plan::query()
            ->whereNot("staff_id", $this->appraiser->id)
            ->where("appraiser_id", $this->appraiser->id)
            ->where("financial_year", $this->financialYear->id);
    }

    protected function getListeners(): array
    {
        return[
            'refresh' => '$refresh'
        ];
    }



}
