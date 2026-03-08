<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class M_TravelTransport extends Model
{
    use HasUuids;

    protected $table = 'm_travel_transports';

    protected $fillable = [
        'travel_order_id',
        'category_id',
        'amount',
        'airline_name',
        'booking_code',
        'ticket_number',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // =============================================
    // SCOPES
    // =============================================

    public function scopeAirplane($query)
    {
        return $query->whereHas('category', fn($q) => $q->where('name', 'Pesawat'));
    }

    // =============================================
    // ACCESSORS
    // =============================================

    /**
     * Cek apakah transport ini menggunakan pesawat
     */
    public function getIsAirplaneAttribute(): bool
    {
        return $this->category?->name === 'Pesawat';
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
