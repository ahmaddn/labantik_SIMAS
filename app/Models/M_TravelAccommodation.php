<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class M_TravelAccommodation extends Model
{
    use HasUuids;

    protected $table = 'm_travel_accommodations';

    protected $fillable = [
        'travel_order_id',
        'category_id',
        'hotel_name',
        'price_per_night',
        'duration_nights',
        'total_amount',
        'note',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'duration_nights' => 'integer',
        'total_amount'    => 'decimal:2',
    ];

    // =============================================
    // BOOT - Auto hitung total_amount
    // =============================================

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->price_per_night && $model->duration_nights) {
                $model->total_amount = $model->price_per_night * $model->duration_nights;
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(M_TravelCostCategory::class, 'category_id');
    }
}
