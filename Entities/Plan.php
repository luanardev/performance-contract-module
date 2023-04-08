<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\Organization\Entities\FinancialYear;

/**
 * @property string $id
 * @property string $staff_id
 * @property string $financial_year
 * @property string $plan_status
 * @property mixed $submitted_at
 * @property Collection $deliverables
 * @property Staff $staff
 * @property Staff $appraiser
 * @property FinancialYear $financialYear
 */
class Plan extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_performance_contract_plans';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'submitted_at' => 'date:Y-m-d H:i:s',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'staff_id', 'appraiser_id','financial_year', 'plan_status', 'submitted_at'
    ];

    /**
     * @return HasMany
     */
    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class, 'plan_id');
    }

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * @return BelongsTo
     */
    public function appraiser(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'appraiser_id');
    }

    /**
     * @return BelongsTo
     */
    public function financialYear(): BelongsTo
    {
        return $this->belongsTo(FinancialYear::class, 'financial_year');
    }

    /**
     * @return bool
     */
    public function hasDeliverables(): bool
    {
        return (bool) $this->deliverables()->count();
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->plan_status === "Draft";
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->plan_status === "Completed";
    }

    /**
     * @return static
     */
    public function setDraft(): static
    {
        $this->setAttribute('plan_status', 'Draft');
        return $this;
    }

    /**
     * @return static
     */
    public function completed(): static
    {
        $this->setAttribute('plan_status', 'Completed');
        return $this;
    }

    /**
     * @return static
     */
    public function submittedAt(): static
    {
        $this->setAttribute('submitted_at', now());
        return $this;
    }

    /**
     * @return int|mixed
     */
    public function totalWeight(): mixed
    {
        $totalWeight = 0;
        foreach($this->deliverables as $deliverable){
            if($deliverable instanceof Deliverable){
                $totalWeight += $deliverable->totalWeight();
            }
        }
        return $totalWeight;
    }

    /**
     * @return MidYearPerformance
     */
    public function midYearPerformance(): MidYearPerformance
    {
        return new MidYearPerformance($this);
    }

    /**
     * @return EndYearPerformance
     */
    public function endYearPerformance(): EndYearPerformance
    {
        return new EndYearPerformance($this);
    }

    /**
     * @return OverallPerformance
     */
    public function overallPerformance(): OverallPerformance
    {
        return new OverallPerformance($this);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getIndicators(): \Illuminate\Support\Collection
    {
        $indicators = collect();
        foreach($this->deliverables as $deliverable){
            foreach($deliverable->indicators as $indicator){
                $indicators->add($indicator);
            }
        }
        return $indicators;
    }

    /**
     * @param Pillar $pillar
     * @return int|mixed
     */
    public function getPillarWeight(Pillar $pillar): mixed
    {
        $deliverables = $this->deliverables()->where('pillar_id',$pillar->id)->get();
        $totalWeight = 0;
        foreach ($deliverables as $deliverable){
            if($deliverable instanceof Deliverable){
                $totalWeight += $deliverable->totalWeight();
            }
        }
        return $totalWeight;
    }

    /**
     * @param Pillar $pillar
     * @return Collection
     */
    public function getPillarDeliverables(Pillar $pillar): Collection
    {
        return $this->deliverables()
            ->where('pillar_id',$pillar->id)
            ->get();
    }

    /**
     * end date
     *
     * @return string|null
     */
    public function createdPeriod(): ?string
    {
        if (isset($this->created_at)) {
            return $this->created_at->diffForHumans();
        } else {
            return null;
        }
    }

    /**
     * end date
     *
     * @return string|null
     */
    public function updatedPeriod(): ?string
    {
        if (isset($this->updated_at)) {
            return $this->updated_at->diffForHumans();
        } else {
            return null;
        }
    }

    /**
     * end date
     *
     * @return string|null
     */
    public function submittedPeriod(): ?string
    {
        if (isset($this->submitted_at)) {
            return $this->submitted_at->diffForHumans();
        } else {
            return null;
        }
    }

    /**
     * Status
     *
     * @return string|null
     */
    public function statusBadge(): null|string
    {
        if ($this->isDraft()) {
            return "<span class='badge badge-danger py-1 text-white'>{$this->plan_status}</span>";
        } elseif ($this->isCompleted()) {
            return "<span class='badge badge-success py-1 text-white'>{$this->plan_status}</span>";
        } else {
            return null;
        }

    }

    /**
     * @param mixed $staff
     * @param mixed $appraiser
     * @param mixed $financialYear
     * @return bool
     */
    public static function submitted(mixed $staff, mixed $appraiser, mixed $financialYear): bool
    {
        if($staff instanceof Staff){
            $staff = $staff->id;
        }
        if($appraiser instanceof Staff){
            $appraiser = $appraiser->id;
        }
        if($financialYear instanceof FinancialYear){
            $financialYear = $financialYear->id;
        }
        return static::where('staff_id', $staff)
            ->where('appraiser_id', $appraiser)
            ->where('financial_year', $financialYear)
            ->exists();
    }

}
