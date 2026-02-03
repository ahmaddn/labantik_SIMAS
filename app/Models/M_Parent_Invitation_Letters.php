<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Parent_Invitation_Letters extends Model
{
    protected $table = 'm_parent_invitation_letters';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'headmaster_id',
        'student_id',
        'letter_number',
        'to',
        'purpose',
        'categories',
        'meeting_day',
        'meeting_date',
        'meeting_time',
        'meeting_place',
        'meeting_with',
        'issue_date',
        'created_by'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function student()
    {
        return $this->belongsTo(RefStudentAcademicYear::class, 'student_id');
    }

    public function headmaster()
    {
        return $this->belongsTo(User::class, 'headmaster_id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
