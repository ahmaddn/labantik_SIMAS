<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Detail_Cover_Letters extends Model
{
    protected $table = 'm_detail_cover_letters';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'cover_letter_id',
        'document_sent',
        'qty',
        'notes',
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


    public function coverLetter()
    {
        return $this->belongsTo(M_Cover_Letters::class, 'cover_letter_id');
    }
}
