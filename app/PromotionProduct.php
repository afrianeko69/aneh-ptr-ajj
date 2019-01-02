<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionProduct extends Model
{
    protected $fillable = [
        'promotion_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
