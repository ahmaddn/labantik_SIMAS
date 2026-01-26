<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoreExpertiseConcentration extends Model
{
    use HasUuids;

    protected $table = 'core_expertise_concentrations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'avatar',
        'name',
        'slug',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get classes under this concentration.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(RefClass::class, 'expertise_concentration_id');
    }
}