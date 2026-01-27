<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Official_Travel_Orders extends Model
{
    protected $table = 'm_official_travel_orders';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'headmaster_id',
        'letter_number',
        'purpose',
        'departure_from',
        'departure_date',
        'departure_place',
        'return_date',
        'duration_days',
        'issue_date',
        'budget_resource',
        'code',
        'acc',
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

    public function headmaster()
    {
        return $this->belongsTo(User::class, 'headmaster_id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
