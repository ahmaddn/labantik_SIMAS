<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_TravelCostCategory extends Model
{
    use HasUuids;

    protected $table = 'm_travel_cost_categories';

    protected $fillable = [
        'name',
        'type',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
    ];

    // =============================================
    // SCOPES
    // =============================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAccommodation($query)
    {
        return $query->where('type', 'accommodation');
    }

    public function scopeTransport($query)
    {
        return $query->where('type', 'transport');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // =============================================
    // RELATIONS
    // =============================================

    public function accommodations(): HasMany
    {
        return $this->hasMany(M_TravelAccommodation::class, 'category_id');
    }

    public function transports(): HasMany
    {
        return $this->hasMany(M_TravelTransport::class, 'category_id');
    }
}
