<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;


class Banner extends Model
{
    protected $fillable = [
        'product_id'
    ];

    public function productId()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
