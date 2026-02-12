<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Cover_Letters extends Model
{
    protected $table = 'm_cover_letters';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'headmaster_id',
        'letter_number',
        'issue_date',
        'towards',
        'created_by',
        'download_count'
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

    public function headmaster()
    {
        return $this->belongsTo(User::class, 'headmaster_id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function details()
    {
        return $this->hasMany(M_Detail_Cover_Letters::class, 'cover_letter_id');
    }
}
