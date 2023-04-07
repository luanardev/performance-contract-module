<?php

namespace Lumis\PerformanceContract\Http\Livewire;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Deliverable;
use Lumis\PerformanceContract\Entities\Indicator;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\Pillar;

class EditPillar extends LivewireUI
{
    public Plan $plan;
    public Pillar $pillar;
    public Collection $deliverables;
    public Collection $indicators;


    public function mount(Plan $plan, Pillar $pillar)
    {
        $this->plan = $plan;
        $this->pillar = $pillar;
        $this->deliverables = $this->deliverables();
        $this->indicators = $this->indicators();

    }

    public function deliverables(): Collection
    {
        $deliverables = $this->plan->getPillarDeliverables($this->pillar);
        $collect = collect();
        foreach ($deliverables as $deliverable){
            $collect->offsetSet($deliverable->id, $deliverable);
        }
        return $collect;
    }

    public function indicators(): Collection
    {
        $indicators = $this->plan->getIndicators();
        $collect = collect();
        foreach ($indicators as $indicator){
            $collect->offsetSet($indicator->id, $indicator);
        }
        return $collect;
    }

    public function getTotalWeight()
    {
       return $this->plan->getPillarWeight($this->pillar);
    }

    public function hasDeliverables(): bool
    {
        return (bool) $this->deliverables()->count();

    }

    public function updatedDeliverables($value, $key): void
    {
        if(!empty($value) && !empty($key)){

            [$primaryKey, $property] = explode('.', $key);

            $deliverable = Deliverable::find($primaryKey);
            $deliverable->{$property} = $value;
            $deliverable->update();

        }
    }

    public function updatedIndicators($value, $key)
    {
        if(!empty($value) && !empty($key)){

            [$primaryKey, $property] = explode('.', $key);

            $indicator= Indicator::find($primaryKey);

            $totalWeight = $this->plan->totalWeight();
            $totalWeight = $totalWeight - $indicator->weight;
            $totalWeight = $totalWeight + (float)$value;

            // Check whether new total weight is greater than 100%
            if($totalWeight > 100){
                return $this->toastrError('Total Weight cannot exceed 100%');
            }else{
                $indicator->{$property} = $value;
                $indicator->update();
                $this->emitRefresh();
            }
        }
    }

    public function createDeliverable()
    {
        $deliverable = new Deliverable();
        $deliverable->plan()->associate($this->plan);
        $deliverable->pillar()->associate($this->pillar);
        $deliverable->save();
        $deliverable->indicators()->save( new Indicator());
    }

    public function deleteDeliverable($deliverableId)
    {
        Deliverable::destroy($deliverableId);
    }

    public function addIndicator($deliverableId)
    {
        $indicator = new Indicator();
        $indicator->deliverable()->associate($deliverableId);
        $indicator->save();
    }

    public function deleteIndicator($indicatorId)
    {
        $indicator = Indicator::find($indicatorId);
        $indicator->delete();
    }

    protected function rules()
    {
        return [
            'deliverables.*' => 'required',
            'indicators.*' => 'required',
        ];
    }

    public function render()
    {
        return view('performancecontract::livewire.edit-pillar');
    }
}
