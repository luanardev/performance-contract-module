<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $indicator_id
 * @property string $rating_type
 * @property float $self_rate
 * @property string $outcome
 * @property float $appraiser_rate
 * @property string $appraiser_comment
 * @property float $agreed_rate
 * @property Indicator $indicator
 */
class Rating extends Model
{
    use HasFactory, HasUuids;

    const RATING_MIDYEAR = 'MidYear';
    const RATING_ENDYEAR = 'EndYear';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_performance_contract_ratings';

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
        'indicator_id',  'rating_type', 'self_rate', 'outcome',
        'appraiser_rate', 'appraiser_comment', 'agreed_rate'
    ];

    /**
     * @return BelongsTo
     */
    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class, 'indicator_id');
    }

    /**
     * @return static
     */
    public function midYearRating(): static
    {
        $this->setAttribute('rating_type', static::RATING_MIDYEAR);
        return $this;
    }

    /**
     * @return static
     */
    public function endYearRating(): static
    {
        $this->setAttribute('rating_type', static::RATING_ENDYEAR);
        return $this;
    }
}
