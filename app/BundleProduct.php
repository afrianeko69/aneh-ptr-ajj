<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BundleProduct extends Model
{
    protected $table = 'bundle_product';

    protected $fillable = [
        'product_id',
        'bundle_id',
        'sort',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


}
