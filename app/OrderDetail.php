<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'course_id',
        'product_slug',
        'quantity',
        'price',
        'discounted_price', // The price after calculate discount if any discount and valid date
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function order() {
        return $this->belongsTo('App\Order');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_slug', 'slug');
    }
}
