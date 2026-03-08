<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class M_TravelDailyAllowance extends Model
{
    use HasUuids;

    protected $table = 'm_travel_daily_allowances';

    protected $fillable = [
        'travel_order_id',
        'employee_name',
        'amount_per_day',
        'days',
        'total_amount',
    ];

    protected $casts = [
        'amount_per_day' => 'decimal:2',
        'days'           => 'integer',
        'total_amount'   => 'decimal:2',
    ];

    // =============================================
    // BOOT - Auto hitung total_amount
    // =============================================

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->amount_per_day && $model->days) {
                $model->total_amount = $model->amount_per_day * $model->days;
            }
        });
    }

    // =============================================
    // RELATIONS
    // =============================================

    public function travelOrder(): BelongsTo
    {
        return $this->belongsTo(M_Official_Travel_Orders::class, 'travel_order_id');
    }
}
