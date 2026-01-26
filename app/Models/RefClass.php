<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefClass extends Model
{
    use HasUuids;

    protected $table = 'ref_classes';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'academic_level',
        'academic_year',
        'expertise_program_id',
        'expertise_concentration_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'academic_level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all users in this class.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'class_id');
    }

    /**
     * Get expertise program.
     */
    public function expertiseProgram(): BelongsTo
    {
        return $this->belongsTo(CoreExpertiseProgram::class, 'expertise_program_id');
    }

    /**
     * Get expertise concentration.
     */
    public function expertiseConcentration(): BelongsTo
    {
        return $this->belongsTo(CoreExpertiseConcentration::class, 'expertise_concentration_id');
    }
}
