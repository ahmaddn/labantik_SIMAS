<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CoreRole;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_users';

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
        'avatar',
        'name',
        'email',
        'email_verified_at',
        'password',
        'last_login',
        'remember_token',
        'class_id',
        'academic_year',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the employee record associated with the user.
     */
    public function employee(): HasOne
    {
        return $this->hasOne(CoreEmployee::class, 'user_id');
    }

    /**
     * Get the student record associated with the user.
     */
    public function student(): HasOne
    {
        return $this->hasOne(RefStudent::class, 'user_id');
    }

    /**
     * Get the class that the user belongs to.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(RefClass::class, 'class_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            CoreRole::class,
            'assoc_user_roles',
            'user_id',
            'role_id'
        )->withPivot(['app_type', 'created_by', 'updated_by'])
            ->withTimestamps();
    }

    /**
     * Get all agendas for the user.
     */
    public function agendas(): HasMany
    {
        return $this->hasMany(RefAgenda::class, 'user_id');
    }

    /**
     * Get all schedules for the user.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(RefSchedule::class, 'id_users');
    }

    /**
     * Check if user has a specific role.
     *
     * @param string $roleName
     * @param string|null $appType
     * @return bool
     */
    public function hasRole(string $roleName, string $appType = null): bool
    {
        $query = $this->roles()->where(function ($query) use ($roleName) {
            $query->where('name', $roleName)
                ->orWhere('code', $roleName);
        });

        if ($appType) {
            $query->wherePivot('app_type', $appType);
        }

        return $query->exists();
    }

    /**
     * Check if user has any of the given roles.
     *
     * @param array $roles
     * @param string|null $appType
     * @return bool
     */
    public function hasAnyRole(array $roles, string $appType = null): bool
    {
        $query = $this->roles()->where(function ($query) use ($roles) {
            $query->whereIn('name', $roles)
                ->orWhereIn('code', $roles);
        });

        if ($appType) {
            $query->wherePivot('app_type', $appType);
        }

        return $query->exists();
    }

    /**
     * Check if user has a specific permission.
     *
     * @param string $permissionName
     * @param string|null $actionName
     * @return bool
     */
    public function hasPermission(string $permissionName, string $actionName = null): bool
    {
        $roles = $this->roles()->with(['permissions' => function ($query) use ($permissionName) {
            $query->where('name', $permissionName);
        }, 'permissions.actions' => function ($query) use ($actionName) {
            if ($actionName) {
                $query->where('action_name', $actionName);
            }
        }])->get();

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name === $permissionName) {
                    if (!$actionName) {
                        return true;
                    }

                    foreach ($permission->actions as $action) {
                        if ($action->action_name === $actionName) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * Get user's full profile data.
     *
     * @return array
     */
    public function getFullProfile(): array
    {
        $profile = $this->toArray();

        // Add employee data if exists
        if ($this->employee) {
            $profile['employee'] = $this->employee->toArray();
        }

        // Add student data if exists
        if ($this->student) {
            $profile['student'] = $this->student->toArray();
        }

        // Add class data if exists
        if ($this->class) {
            $profile['class'] = $this->class->toArray();
        }

        // Add roles
        $profile['roles'] = $this->roles->toArray();

        return $profile;
    }

    /**
     * Get user type based on associated records.
     *
     * @return string
     */
    public function getUserType(): string
    {
        if ($this->employee) {
            return 'employee';
        }

        if ($this->student) {
            return 'student';
        }

        return 'user';
    }

    /**
     * Scope to filter users by role.
     */
    public function scopeWithRole($query, string $roleName, string $appType = null)
    {
        return $query->whereHas('roles', function ($query) use ($roleName, $appType) {
            $query->where(function ($query) use ($roleName) {
                $query->where('name', $roleName)
                    ->orWhere('code', $roleName);
            });

            if ($appType) {
                $query->wherePivot('app_type', $appType);
            }
        });
    }

    /**
     * Scope to filter users by academic year.
     */
    public function scopeByAcademicYear($query, string $academicYear)
    {
        return $query->where('academic_year', $academicYear);
    }

    /**
     * Scope to filter active users (users with recent login).
     */
    public function scopeActive($query, int $days = 30)
    {
        return $query->where('last_login', '>=', now()->subDays($days));
    }

    /**
     * Get the avatar URL.
     *
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Return default avatar or gravatar
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=150&d=mp';
    }
}
