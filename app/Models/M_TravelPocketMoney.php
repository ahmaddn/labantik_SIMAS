<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class M_TravelPocketMoney extends Model
{
    use HasUuids;

    protected $table = 'm_travel_pocket_moneys';

    protected $fillable = [
        'travel_order_id',
        'amount',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // =============================================
    // RELATIONS
    // =============================================

    public function travelOrder(): BelongsTo
    {
        return $this->belongsTo(M_Official_Travel_Orders::class, 'travel_order_id');
    }
}
