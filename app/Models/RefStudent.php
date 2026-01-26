<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefStudent extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_students';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'no',
        'student_id',
        'student_number',
        'national_student_number',
        'national_identification_number',
        'full_name',
        'birth_place_date',
        'gender',
        'religion',
        'child_status',
        'birth_order',
        'siblings',
        'step_siblings',
        'adopted_siblings',
        'blood_type',
        'height_cm',
        'weight_kg',
        'address',
        'hobby',
        'aspiration',
        'guardian_name',
        'guardian_education',
        'guardian_occupation',
        'guardian_income',
        'guardian_phone',
        'mother_name',
        'mother_education',
        'mother_occupation',
        'mother_income',
        'mother_phone',
        'custodian_name',
        'custodian_education',
        'custodian_occupation',
        'custodian_income',
        'custodian_phone',
        'previous_school',
        'diploma_number',
        'diploma_date',
        'skhun_number',
        'skhun_date',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'no' => 'integer',
        'siblings' => 'integer',
        'step_siblings' => 'integer',
        'adopted_siblings' => 'integer',
        'height_cm' => 'integer',
        'weight_kg' => 'integer',
        'guardian_income' => 'integer',
        'mother_income' => 'integer',
        'custodian_income' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'national_identification_number',
        'guardian_income',
        'mother_income',
        'custodian_income',
    ];

    /**
     * Get the user that owns the student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    


    /**
     * Get all academic years for the student.
     */
    public function academicYears(): HasMany
    {
        return $this->hasMany(RefStudentAcademicYear::class, 'student_id');
    }

    /**
     * Get current academic year record.
     */
    public function currentAcademicYear(): HasMany
    {
        $currentYear = date('Y');
        return $this->hasMany(RefStudentAcademicYear::class, 'student_id')
            ->where('academic_year', 'like', "{$currentYear}%");
    }

    /**
     * Get current class through academic year relationship.
     */
    public function currentClass(): BelongsTo
    {
        $currentAcademicYear = $this->currentAcademicYear()->first();

        if ($currentAcademicYear && $currentAcademicYear->class_id) {
            return $this->belongsTo(RefClass::class, 'class_id');
        }

        return $this->belongsTo(RefClass::class, 'class_id')->whereNull('id');
    }

    /**
     * Get BMI (Body Mass Index).
     *
     * @return float|null
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->height_cm || !$this->weight_kg) {
            return null;
        }

        $heightInMeters = $this->height_cm / 100;
        return round($this->weight_kg / ($heightInMeters * $heightInMeters), 1);
    }

    /**
     * Get BMI category.
     *
     * @return string|null
     */
    public function getBmiCategoryAttribute(): ?string
    {
        $bmi = $this->getBmiAttribute();

        if (!$bmi) {
            return null;
        }

        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    /**
     * Get total siblings count.
     *
     * @return int
     */
    public function getTotalSiblingsAttribute(): int
    {
        return ($this->siblings ?? 0) + ($this->step_siblings ?? 0) + ($this->adopted_siblings ?? 0);
    }

    /**
     * Get primary guardian contact.
     *
     * @return array
     */
    public function getPrimaryGuardianAttribute(): array
    {
        // Prioritize guardian, then mother, then custodian
        if ($this->guardian_name) {
            return [
                'name' => $this->guardian_name,
                'education' => $this->guardian_education,
                'occupation' => $this->guardian_occupation,
                'income' => $this->guardian_income,
                'phone' => $this->guardian_phone,
                'type' => 'Guardian'
            ];
        } elseif ($this->mother_name) {
            return [
                'name' => $this->mother_name,
                'education' => $this->mother_education,
                'occupation' => $this->mother_occupation,
                'income' => $this->mother_income,
                'phone' => $this->mother_phone,
                'type' => 'Mother'
            ];
        } elseif ($this->custodian_name) {
            return [
                'name' => $this->custodian_name,
                'education' => $this->custodian_education,
                'occupation' => $this->custodian_occupation,
                'income' => $this->custodian_income,
                'phone' => $this->custodian_phone,
                'type' => 'Custodian'
            ];
        }

        return [];
    }

    /**
     * Get family income total.
     *
     * @return int
     */
    public function getFamilyIncomeAttribute(): int
    {
        return ($this->guardian_income ?? 0) +
            ($this->mother_income ?? 0) +
            ($this->custodian_income ?? 0);
    }

    /**
     * Get formatted family income.
     *
     * @return string
     */
    public function getFormattedFamilyIncomeAttribute(): string
    {
        $income = $this->getFamilyIncomeAttribute();

        if ($income === 0) {
            return 'Tidak tersedia';
        }

        return 'Rp ' . number_format($income, 0, ',', '.');
    }

    /**
     * Scope to search students by name, student number, or national student number.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('full_name', 'like', "%{$search}%")
                ->orWhere('student_number', 'like', "%{$search}%")
                ->orWhere('national_student_number', 'like', "%{$search}%")
                ->orWhere('student_id', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to filter students by gender.
     */
    public function scopeByGender($query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope to filter students by religion.
     */
    public function scopeByReligion($query, string $religion)
    {
        return $query->where('religion', $religion);
    }

    /**
     * Scope to filter students by blood type.
     */
    public function scopeByBloodType($query, string $bloodType)
    {
        return $query->where('blood_type', $bloodType);
    }

    /**
     * Scope to filter students by academic year.
     */
    public function scopeByAcademicYear($query, string $academicYear)
    {
        return $query->whereHas('academicYears', function ($query) use ($academicYear) {
            $query->where('academic_year', $academicYear);
        });
    }

    /**
     * Scope to filter students by class in specific academic year.
     */
    public function scopeByClass($query, string $classId, string $academicYear = null)
    {
        return $query->whereHas('academicYears', function ($query) use ($classId, $academicYear) {
            $query->where('class_id', $classId);

            if ($academicYear) {
                $query->where('academic_year', $academicYear);
            }
        });
    }

    /**
     * Scope to get active students (with user accounts).
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('user_id')
            ->whereHas('user');
    }

    /**
     * Scope to get students with recent activity.
     */
    public function scopeRecentActivity($query, int $days = 30)
    {
        return $query->whereHas('user', function ($query) use ($days) {
            $query->where('last_login', '>=', now()->subDays($days));
        });
    }

    /**
     * Check if student has complete profile.
     *
     * @return bool
     */
    public function hasCompleteProfile(): bool
    {
        $requiredFields = [
            'full_name',
            'student_number',
            'gender',
            'religion',
            'address',
            'guardian_name',
            'guardian_phone'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get current grade level.
     *
     * @return int|null
     */
    public function getCurrentGradeLevel(): ?int
    {
        $currentAcademicYear = $this->currentAcademicYear()->first();

        if ($currentAcademicYear && $currentAcademicYear->class) {
            return $currentAcademicYear->class->academic_level;
        }

        return null;
    }

    /**
     * Get student age (approximate from birth_place_date if available).
     *
     * @return int|null
     */
    public function getAgeAttribute(): ?int
    {
        // This is a basic implementation since birth_place_date is stored as string
        // You might want to parse the date format used in your system
        if (!$this->birth_place_date) {
            return null;
        }

        // Try to extract year from birth_place_date string
        if (preg_match('/(\d{4})/', $this->birth_place_date, $matches)) {
            $birthYear = (int) $matches[1];
            return date('Y') - $birthYear;
        }

        return null;
    }
}
