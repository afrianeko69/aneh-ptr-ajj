<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionBundle extends Model
{
    protected $fillable = [
        'promotion_id',
        'bundle_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
