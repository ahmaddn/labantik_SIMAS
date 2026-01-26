<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefSchedule extends Model
{
    use HasUuids;

    protected $table = 'ref_schedule';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_curriculum',
        'id_users',
        'id_course',
        'id_classes',
        'date',
        'start_time',
        'end_time',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user (teacher).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    /**
     * Get the class.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(RefClass::class, 'id_classes');
    }

    /**
     * Get agendas for this schedule.
     */
    public function agendas(): HasMany
    {
        return $this->hasMany(RefAgenda::class, 'schedule_id');
    }
}