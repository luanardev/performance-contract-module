<?php

namespace Lumis\PerformanceContract\Http\Livewire\Planning;

use Illuminate\Database\Eloquent\Builder;
use Luanardev\LivewireAlert\WithLivewireAlert;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\Shared;
use Lumis\StaffManagement\DataViews\StaffView;
use Lumis\StaffManagement\Entities\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SharePlan extends DataTableComponent
{
    use WithLivewireAlert;

    public Plan $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    private function staff(): Staff
    {
        return $this->plan->staff;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('employee_number');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setColumnSelectDisabled();
        $this->setPaginationEnabled();
        $this->setBulkActionsEnabled();

        $this->setBulkActions([
            'shareAction' => 'Share'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'employee_number'),
            Column::make('Fullname'),
            Column::make('Position'),
        ];
    }

    public function shareAction()
    {
        if ($this->getSelectedCount() > 0) {
            foreach ($this->getSelected() as $key) {
                $staff = Staff::getByNumber($key);
                $this->shareWith($staff);
            }
            $this->toastr("Plan shared to {$this->getSelectedCount()} colleagues");
            $this->redirectRoute('performance_contract.plan.show', $this->plan);
        }
    }

    private function shareWith(Staff $staff)
    {
        $share = new Shared();
        $share->sender()->associate($this->plan->staff);
        $share->receiver()->associate($staff);
        $share->plan()->associate($this->plan);
        $share->save();
    }

    public function builder(): Builder
    {
        $departmentId = $this->staff()->employment->department_id;
        $sectionId = $this->staff()->employment->section_id;

        return StaffView::query()
            ->whereNot('id', $this->plan->staff_id)
            ->where('department_id', $departmentId)
            ->where('section_id', $sectionId)
            ->when($this->getSearch(),
                fn(Builder $query, $term) => $query->search($term)
            );
    }

    protected function getListeners(): array
    {
        return[
            'refresh' => '$refresh'
        ];
    }

}
