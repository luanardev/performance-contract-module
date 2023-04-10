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
 * @property string $deliverable_id
 * @property string $name
 * @property string $target
 * @property float $weight
 * @property Deliverable $deliverable
 * @property Collection $ratings
 */
class Indicator extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_performance_contract_indicators';

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
        'deliverable_id', 'name', 'target','weight'
    ];

    /**
     * @return BelongsTo
     */
    public function deliverable(): BelongsTo
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id');
    }

    /**
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'indicator_id');
    }

    /**
     * @return bool
     */
    public function hasRatings(): bool
    {
        return (bool)$this->ratings->count();
    }

    /**
     * @return Model|null
     */
    public function midYearRating(): Model|null
    {
        return $this->ratings()->where('rating_type', Rating::RATING_MIDYEAR)->first();
    }

    /**
     * @return Model|null
     */
    public function endYearRating(): Model|null
    {
        return $this->ratings()->where('rating_type', Rating::RATING_ENDYEAR)->first();
    }


}
