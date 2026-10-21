<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Treasurer extends Model
{
    protected $table = 'm_treasurers';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'employee_id',
        'name',
        'nip',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public function employee()
    {
        return $this->belongsTo(CoreEmployee::class, 'employee_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
