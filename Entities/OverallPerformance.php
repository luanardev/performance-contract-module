<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OverallPerformance extends EndYearPerformance
{

    /**
     * @return float
     */
    public function getFinalRate(): float
    {
        $totalWeight = ( $this->getTotalWeight() - $this->getNotRated() );
        $totalAgreedRate = $this->getTotalAgreedRate();
        return round(number_format(($totalAgreedRate/$totalWeight) * 5, 2));

    }

    /**
     * @return int
     */
    public function getNotRated(): int
    {
        $ratings = $this->getRatings();
        return $ratings->where('status', Rating::STATUS_UNRATED)->count();
    }

    /**
     * @return string|null
     */
    public function getOverallRating(): ?string
    {
        $finalScore = $this->getFinalRate();
        $rating = null;

        if($finalScore <= 1.9){
            $rating = 'Below Standard';
        }
        elseif($finalScore <= 2.9){
            $rating = 'Need Improvement';
        }
        elseif($finalScore <= 3.49){
            $rating = 'Meeting Standard';
        }
        elseif($finalScore <= 3.9){
            $rating = 'Exceeding Standard';
        }
        elseif($finalScore <= 5.0){
            $rating = 'Outstanding';
        }
        return $rating;
    }

}
