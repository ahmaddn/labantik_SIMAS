<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_Travel_Order_Followers extends Model
{
    protected $table = 'm_travel_order_followers';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'travel_order_id',
        'follower_id',
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

    public function travelOrder()
    {
        return $this->belongsTo(M_Official_Travel_Orders::class, 'travel_order_id');
    }


    public function follower()
    {
        return $this->belongsTo(CoreEmployee::class, 'follower_id');
    }
}
