<?php

namespace Lumis\PerformanceContract\Entities;

use Illuminate\Database\Eloquent\Builder;
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
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $plan_id
 * @property Staff $sender
 * @property Staff $receiver
 * @property Plan $plan
 */
class Shared extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_performance_contract_shared';

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
        'sender_id', 'receiver_id','plan_id'
    ];


    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'sender_id');
    }

    /**
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'receiver_id');
    }

    /**
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id');
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
     * @param Staff $staff
     * @return Builder
     */
    public static function getByStaff(Staff $staff): Builder
    {
        return static::where('receiver_id', $staff->id);
    }

}
