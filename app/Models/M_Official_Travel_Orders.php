<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class M_Official_Travel_Orders extends Model
{
    use HasUuids;

    protected $table = 'm_official_travel_orders';

    protected $fillable = [
        'headmaster_id',
        'treasurer_id',
        'letter_number',
        'base',
        'purpose',
        'departure_from',
        'departure_to',
        'departure_date',
        'departure_time',
        'departure_place',
        'return_date',
        'duration_days',
        'issue_date',
        'budget_resource',
        'code',
        'acc',
        'created_by',
        'download_count',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date'    => 'date',
        'issue_date'     => 'date',
        'download_count' => 'integer',
    ];

    public function treasurer()
    {
        return $this->belongsTo(User::class, 'treasurer_id');
    }

    public function headmaster()
    {
        return $this->belongsTo(User::class, 'headmaster_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function employees()
    {
        return $this->hasMany(M_Travel_Order_Participans::class, 'travel_order_id');
    }
    public function followers()
    {
        return $this->hasMany(M_Travel_Order_Followers::class, 'travel_order_id');
    }

    // =============================================
    // ACCESSORS - Kalkulasi total biaya
    // =============================================

    /**
     * Total Uang Harian
     */
    public function getTotalDailyAllowanceAttribute(): float
    {
        return (float) $this->dailyAllowances->sum('total_amount');
    }

    /**
     * Total Uang Saku
     */
    public function getTotalPocketMoneyAttribute(): float
    {
        return (float) ($this->pocketMoney?->amount ?? 0);
    }

    /**
     * Total Penginapan
     */
    public function getTotalAccommodationAttribute(): float
    {
        return (float) $this->accommodations->sum('total_amount');
    }

    /**
     * Total Transport
     */
    public function getTotalTransportAttribute(): float
    {
        return (float) $this->transports->sum('amount');
    }

    /**
     * Total Uang Representatif
     */
    public function getTotalRepresentativeAttribute(): float
    {
        return (float) ($this->representativeAllowance?->amount ?? 0);
    }

    /**
     * Jumlah Total Keseluruhan
     */
    public function getGrandTotalAttribute(): float
    {
        return $this->total_daily_allowance
            + $this->total_pocket_money
            + $this->total_accommodation
            + $this->total_transport
            + $this->total_representative;
    }

    // =============================================
    // RELATIONS
    // =============================================
    public function dailyAllowances(): HasMany
    {
        return $this->hasMany(M_TravelDailyAllowance::class, 'travel_order_id');
    }

    public function pocketMoney(): HasOne
    {
        return $this->hasOne(M_TravelPocketMoney::class, 'travel_order_id');
    }

    public function accommodations(): HasMany
    {
        return $this->hasMany(M_TravelAccommodation::class, 'travel_order_id');
    }

    public function transports(): HasMany
    {
        return $this->hasMany(M_TravelTransport::class, 'travel_order_id');
    }

    public function representativeAllowance(): HasOne
    {
        return $this->hasOne(M_TravelRepresentativeAllowance::class, 'travel_order_id');
    }
}
