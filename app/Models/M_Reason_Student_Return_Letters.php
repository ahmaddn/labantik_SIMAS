<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Reason_Student_Return_Letters extends Model
{
    protected $table = 'm_reason_student_return_letters';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'student_return_letter_id',
        'reason',
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

    public function studentReturn()
    {
        return $this->belongsTo(M_Student_Return_Letters::class, 'student_return_letter_id');
    }
}
