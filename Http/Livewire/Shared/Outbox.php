<?php

namespace Lumis\PerformanceContract\Http\Livewire\Shared;

use Illuminate\Database\Eloquent\Builder;
use Luanardev\LivewireAlert\WithLivewireAlert;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\PerformanceContract\Entities\Outbox as Shared;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Outbox extends DataTableComponent
{
    use WithLivewireAlert;

    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setColumnSelectDisabled();
        $this->setPaginationEnabled();
        $this->setBulkActionsEnabled();

        $this->setBulkActions([
            'deleteAction' => 'Delete'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Receiver')->label(function(Shared $row, Column $column){
                return $row->receiver->fullname();
            }),
            Column::make('Item')->label(function(Shared $row, Column $column){
                return $row->plan->getName().' Performance Contract';
            }),
            Column::make('Period')->label(function(Shared $row, Column $column){
                return $row->createdPeriod();
            }),
        ];
    }

    public function deleteAction()
    {
        if ($this->getSelectedCount() > 0) {
            foreach ($this->getSelected() as $key) {
                Shared::destroy($key);
            }
            $this->toastr('Deleted successfully');
        }
    }


    public function builder(): Builder
    {
        return Shared::getByStaff($this->staff)
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
