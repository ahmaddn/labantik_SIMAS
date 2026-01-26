<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CorePermission extends Model
{
    use HasUuids;

    protected $table = 'core_permissions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'guard_name',
        'is_core',
        'status',
        'app_type',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_core' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The roles that belong to the permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            CoreRole::class,
            'assoc_role_permissions',
            'permission_id',
            'role_id'
        )->withPivot(['created_by', 'updated_by'])
          ->withTimestamps();
    }

    /**
     * Get all actions for the permission.
     */
    public function actions(): HasMany
    {
        return $this->hasMany(RefPermissionAction::class, 'permission_id');
    }
}
