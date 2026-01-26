<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefAgenda extends Model
{
    use HasUuids;

    protected $table = 'ref_agenda';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'date',
        'day',
        'content',
        'attachment',
        'attendance',
        'evidence',
        'reason',
        'status',
        'approved_by',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'attendance' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the agenda.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the schedule.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(RefSchedule::class, 'schedule_id');
    }
}