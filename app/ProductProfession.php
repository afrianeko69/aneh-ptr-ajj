<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProfession extends Model
{
    protected $fillable = [
        'product_id',
        'profession_id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
