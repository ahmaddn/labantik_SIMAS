<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoreRole extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_roles';

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
        'name',
        'code',
        'description',
        'app_type',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The users that belong to the role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'assoc_user_roles',
            'role_id',
            'user_id'
        )->withPivot(['app_type', 'created_by', 'updated_by'])
          ->withTimestamps();
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            CorePermission::class,
            'assoc_role_permissions',
            'role_id',
            'permission_id'
        )->withPivot(['created_by', 'updated_by'])
          ->withTimestamps();
    }

    /**
     * Check if role has a specific permission.
     *
     * @param string $permissionName
     * @param string|null $actionName
     * @return bool
     */
    public function hasPermission(string $permissionName, string $actionName = null): bool
    {
        $permission = $this->permissions()
            ->where('name', $permissionName)
            ->first();

        if (!$permission) {
            return false;
        }

        if (!$actionName) {
            return true;
        }

        return $permission->actions()
            ->where('action_name', $actionName)
            ->exists();
    }

    /**
     * Scope to filter roles by app type.
     */
    public function scopeByAppType($query, string $appType)
    {
        return $query->where('app_type', $appType);
    }

    /**
     * Scope to filter active roles.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get role display name.
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: $this->code;
    }
}