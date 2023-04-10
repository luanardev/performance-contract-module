<?php

namespace Lumis\PerformanceContract\Http\Livewire\Rating;

use Illuminate\Support\Collection;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\PerformanceContract\Entities\Indicator;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\PerformanceContract\Entities\Rating;

class RateMidYear extends LivewireUI
{
    public Plan $plan;
    public Pillar $pillar;
    public Collection $deliverables;
    public Collection $ratings;


    public function mount(Plan $plan, Pillar $pillar)
    {
        $this->plan = $plan;
        $this->pillar = $pillar;
        $this->deliverables = $this->deliverables();
        $this->ratings = $this->ratings();

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

    public function ratings(): Collection
    {
        $indicators = $this->plan->getIndicators();
        $collect = collect();
        foreach ($indicators as $indicator){
            if($indicator instanceof Indicator){
                $rating = $indicator->midYearRating();
                if($rating instanceof Rating){
                    $collect->offsetSet($indicator->id, $rating);
                }
            }
        }
        return $collect;
    }

    public function getTotalWeight()
    {
       return $this->plan->getPillarWeight($this->pillar);
    }

    public function updatedRatings($value, $key)
    {
        if(!empty($key)){

            [$indicatorKey, $property] = explode('.', $key);

            $rating = $this->ratings()->get($indicatorKey);

            if(empty($rating)){
               $rating = new Rating();
               $rating->indicator()->associate($indicatorKey);
            }
            if($property === 'self_rate'){
                $indicator = Indicator::find($indicatorKey);
                $this->rate($indicator, $rating, $value);
            }else{
                $rating->{$property} = $value?? null;
                $rating->save();
            }
        }
    }

    private function rate(Indicator $indicator, Rating $rating, $value)
    {
        $rate = (float)$value;
        if ($rate <= $indicator->weight) {
            $rating->self_rate = $rate?? null;
            $rating->save();
        } else {
            $this->toastrError("Cannot exceed a weight of {$indicator->weight} %");
        }
    }

    public function render()
    {
        return view('performancecontract::livewire.rating.rate-mid-year');
    }
}
