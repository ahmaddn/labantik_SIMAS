<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoreExpertiseProgram extends Model
{
    use HasUuids;

    protected $table = 'core_expertise_programs';
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
     * Get classes under this program.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(RefClass::class, 'expertise_program_id');
    }
}