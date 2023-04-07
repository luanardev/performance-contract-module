<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $plan_id
 * @property string $name
 * @property Plan $plan
 * @property Pillar $pillar
 * @property Collection $indicators
 */
class Deliverable extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_performance_contract_deliverables';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'plan_id', 'pillar_id', 'name'
    ];

    /**
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * @return BelongsTo
     */
    public function pillar(): BelongsTo
    {
        return $this->belongsTo(Pillar::class, 'pillar_id');
    }

    /**
     * @return HasMany
     */
    public function indicators(): HasMany
    {
        return $this->hasMany(Indicator::class, 'deliverable_id');
    }

    /**
     * @return bool
     */
    public function hasIndicators(): bool
    {
        return (bool)$this->indicators()->count();
    }

    /**
     * @return int|mixed
     */
    public function totalWeight(): mixed
    {
        return $this->indicators()->sum('weight');
    }

    /**
     * @return int
     */
    public function totalIndicators(): int
    {
        return $this->indicators()->count();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function midYearRatings(): \Illuminate\Support\Collection
    {
        $ratings = collect();
        foreach($this->indicators as $indicator){
            if($indicator instanceof Indicator){
                $ratings->add($indicator->midYearRating());
            }
        }
        return $ratings;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function endYearRatings(): \Illuminate\Support\Collection
    {
        $ratings = collect();
        foreach($this->indicators as $indicator){
            if($indicator instanceof Indicator){
                $ratings->add($indicator->endYearRating());
            }
        }
        return $ratings;
    }

}
