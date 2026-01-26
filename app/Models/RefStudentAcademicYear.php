<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefStudentAcademicYear extends Model
{
    use HasUuids;

    protected $table = 'ref_student_academic_years';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'student_id',
        'class_id',
        'academic_year',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActiveAcademicYear($query)
    {
        $activeConfig = P_Configs::where('is_active', true)->first();

        if (!$activeConfig) {
            return $query->whereNull('id'); // Return empty query jika tidak ada config aktif
        }

        return $query->where('academic_year', $activeConfig->academic_year);
    }
    public function scopeAcademicYear(Builder $builder, string $academicYear)
    {
        return $builder->where('academic_year', $academicYear);
    }

    /**
     * Get the student.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(RefStudent::class, 'student_id');
    }

    /**
     * Get the class.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(RefClass::class, 'class_id');
    }

    public function recaps()
    {
        return $this->hasMany(P_Recaps::class, 'ref_student_id', 'student_id');
    }

    public function pRecaps()
    {
        return $this->hasMany(P_Recaps::class, 'ref_student_id', 'student_id');
    }

    public function violations()
    {
        return $this->hasManyThrough(
            P_Violations::class, // model tujuan
            P_Recaps::class,     // model perantara
            'ref_student_id',    // FK di p_recaps → ref_students
            'id',                // PK di p_violations
            'id',                // PK di ref_students
            'p_violation_id'     // FK di p_recaps → p_violations
        );
    }
}
