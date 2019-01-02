<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class ProductTryout extends Model
{
    protected $fillable = [
        'product_id',
        'button_name',
        'embed_link',
        'sort',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function product() {
        return $this->belongsTo(App\Product::class);
    }
}
