<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Data_Correction_Letters extends Model
{
    protected $table = 'm_data_correction_letters';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'headmaster_id',
        'student_id',
        'letter_number',
        'graduation_year',
        'correction_type',
        'field_name',
        'incorrect_data',
        'correct_data',
        'reference_document',
        'comparison_note',
        'issue_date',
        'created_by',
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
