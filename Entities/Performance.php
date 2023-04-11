<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

abstract class Performance
{
    /**
     * @var Plan
     */
    protected Plan $plan;

    /**
     * @param Plan $plan
     */
    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @return int|mixed
     */
    public function getTotalWeight(): mixed
    {
        return $this->plan->totalWeight();
    }

    /**
     * @return int|mixed
     */
    public abstract function getSelfRate(): mixed;

    /**
     * @return int|mixed
     */
    public abstract function getAppraiserRate(): mixed;

    /**
     * @return int|mixed
     */
    public abstract function getAgreedRate(): mixed;

    /**
     * @return Collection
     */
    public abstract function getRatings(): Collection;


}
