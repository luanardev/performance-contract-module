<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class MidYear extends Performance
{

    /**
     * @return Collection
     */
    public function getRatings(): Collection
    {
        $ratings = collect();
        $deliverables = $this->plan->deliverables;
        foreach($deliverables as $deliverable){
            if($deliverable instanceof Deliverable){
                foreach($deliverable->midYearRatings() as $rating){
                    if($rating instanceof Rating){
                        $ratings->add($rating);
                    }
                }
            }
        }
        return $ratings;
    }

    /**
     * @return mixed
     */
    public function getSelfRate(): mixed
    {
        $ratings = $this->getRatings();
        $totalSelfRate = 0;
        foreach($ratings as $rating){
            if($rating instanceof Rating){
                $totalSelfRate += $rating->self_rate;
            }
        }
        return $totalSelfRate;
    }

    /**
     * @return mixed
     */
    public function getAppraiserRate(): mixed
    {
        $ratings = $this->getRatings();
        $totalAppraiserRate = 0;
        foreach($ratings as $rating){
            if($rating instanceof Rating){
                $totalAppraiserRate += $rating->appraiser_rate;
            }
        }
        return $totalAppraiserRate;
    }

    /**
     * @return mixed
     */
    public function getAgreedRate(): mixed
    {
        $ratings = $this->getRatings();
        $totalAgreedRate = 0;
        foreach($ratings as $rating){
            if($rating instanceof Rating){
                $totalAgreedRate += $rating->agreed_rate;
            }
        }
        return $totalAgreedRate;
    }
}
