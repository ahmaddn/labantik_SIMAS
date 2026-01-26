<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefPermissionAction extends Model
{
    use HasUuids;

    protected $table = 'ref_permission_actions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'permission_id',
        'action_name',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the permission that owns the action.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(CorePermission::class, 'permission_id');
    }
}
