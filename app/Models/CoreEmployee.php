<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoreEmployee extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_employees';

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
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'religion',
        'blood_type',
        'residential_address',
        'rt',
        'rw',
        'village',
        'sub_district',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'official_email',
        'ktp_number',
        'bpjs_number',
        'npwp_number',
        'karpeg_number',
        'karis_number',
        'karsu_number',
        'employee_status',
        'asn_type',
        'pns_type',
        'pns_position',
        'job_name',
        'job_type',
        'functional_position',
        'specialization',
        'additional_task',
        'additional_task_2',
        'instance',
        'opd',
        'education_initial',
        'education_last',
        'education_last_year',
        'tmt_pppk',
        'tmt_opd',
        'tmt_position',
        'tmt_rank_start',
        'tmt_rank_end',
        'tmt_salary_increase',
        'rank_start',
        'rank_end',
        'basic_salary',
        'bank_account',
        'bank_name',
        'nip',
        'nuptk',
        'bapertarum',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'education_last_year' => 'integer',
        'tmt_pppk' => 'date',
        'tmt_opd' => 'date',
        'tmt_position' => 'date',
        'tmt_rank_start' => 'date',
        'tmt_rank_end' => 'date',
        'tmt_salary_increase' => 'date',
        'basic_salary' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ktp_number',
        'bpjs_number',
        'npwp_number',
        'bank_account',
        'basic_salary',
    ];

    /**
     * Get the user that owns the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all documents for the employee.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(RefEmployeeDocument::class, 'employee_id');
    }

    /**
     * Get employee's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->residential_address,
            $this->rt ? "RT {$this->rt}" : null,
            $this->rw ? "RW {$this->rw}" : null,
            $this->village,
            $this->sub_district,
            $this->city,
            $this->province,
            $this->postal_code,
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Get employee's age.
     *
     * @return int|null
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->birth_date) {
            return null;
        }

        return $this->birth_date->diffInYears(now());
    }

    /**
     * Get employee status label.
     *
     * @return string
     */
    public function getEmployeeStatusLabelAttribute(): string
    {
        $statusLabels = [
            'PPPK' => 'Pegawai Pemerintah dengan Perjanjian Kerja',
            'PNS' => 'Pegawai Negeri Sipil',
            'Honor' => 'Pegawai Honorer',
        ];

        return $statusLabels[$this->employee_status] ?? $this->employee_status;
    }

    /**
     * Get years of service.
     *
     * @return int|null
     */
    public function getYearsOfServiceAttribute(): ?int
    {
        $startDate = $this->tmt_pppk ?? $this->tmt_opd;
        
        if (!$startDate) {
            return null;
        }

        return $startDate->diffInYears(now());
    }

    /**
     * Get formatted salary.
     *
     * @return string
     */
    public function getFormattedSalaryAttribute(): string
    {
        if (!$this->basic_salary) {
            return 'Tidak tersedia';
        }

        return 'Rp ' . number_format($this->basic_salary, 0, ',', '.');
    }

    /**
     * Get employee's primary email (official email first, then personal email).
     *
     * @return string|null
     */
    public function getPrimaryEmailAttribute(): ?string
    {
        return $this->official_email ?? $this->email ?? $this->user->email;
    }

    /**
     * Scope to filter employees by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('employee_status', $status);
    }

    /**
     * Scope to filter employees by gender.
     */
    public function scopeByGender($query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope to filter employees by marital status.
     */
    public function scopeByMaritalStatus($query, string $status)
    {
        return $query->where('marital_status', $status);
    }

    /**
     * Scope to filter employees by job type.
     */
    public function scopeByJobType($query, string $jobType)
    {
        return $query->where('job_type', $jobType);
    }

    /**
     * Scope to filter employees by instance.
     */
    public function scopeByInstance($query, string $instance)
    {
        return $query->where('instance', $instance);
    }

    /**
     * Scope to search employees by name or NIP.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nuptk', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to get active employees (with recent activity).
     */
    public function scopeActive($query)
    {
        return $query->whereHas('user', function ($query) {
            $query->where('last_login', '>=', now()->subDays(30));
        });
    }

    /**
     * Scope to get employees with specific education level.
     */
    public function scopeByEducationLevel($query, string $educationLevel)
    {
        return $query->where('education_last', 'like', "%{$educationLevel}%");
    }

    /**
     * Check if employee is PNS.
     *
     * @return bool
     */
    public function isPNS(): bool
    {
        return $this->employee_status === 'PNS';
    }

    /**
     * Check if employee is PPPK.
     *
     * @return bool
     */
    public function isPPPK(): bool
    {
        return $this->employee_status === 'PPPK';
    }

    /**
     * Check if employee is Honor.
     *
     * @return bool
     */
    public function isHonor(): bool
    {
        return $this->employee_status === 'Honor';
    }

    /**
     * Get next salary increase date.
     *
     * @return \Carbon\Carbon|null
     */
    public function getNextSalaryIncreaseAttribute(): ?\Carbon\Carbon
    {
        if (!$this->tmt_salary_increase) {
            return null;
        }

        // Typically salary increase every 2 years for PNS/PPPK
        return $this->tmt_salary_increase->addYears(2);
    }
}