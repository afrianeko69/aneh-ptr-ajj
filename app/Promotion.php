<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'promo_code',
        'description',
        'discount_type',
        'discount_value',
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at'
    ];

    CONST DISCOUNT_TYPE_PERCENTAGE = 'Percentage';
    CONST DISCOUNT_TYPE_AMOUNT = 'Amount';

    public function product() {
        return $this->belongsToMany(App\Product::class, 'promotion_products')->withTimestamps();
    }

    public function bundle() {
        return $this->belongsToMany(App\Bundle::class, 'promotion_bundles')->withTimestamps();
    }

    public function scopeActive($query) {
        $now = date('Y-m-d H:i:s');

        return $query->where('start_at', '<=', $now)
                    ->where('end_at', '>=', $now);
    }

    public static function checkPromoCode($promo_code, $id, $type) {
        $reward = [
            'status' => 400,
            'message' => 'Kode Promo tidak ditemukan atau sudah tidak berlaku',
            'body' => [
                'is_valid' => false,
                'value' => null,
                'type' => null
            ]
        ];

        $promo = self::where('promo_code', $promo_code)
                    ->active()
                    ->select([
                        'id', 'discount_type', 'discount_value'
                    ])
                    ->first();

        if(!$promo) {
            return $reward;
        }

        $valid_item = null;
        switch ($type) {
            case 'product':
                $valid_item = $promo->product()->where('id', $id)
                                ->select(['id'])
                                ->first();
                break;

            case 'bundle':
                $valid_item = $promo->bundle()->where('id', $id)
                                ->select(['id'])
                                ->first();
                break;
        }

        if(!$valid_item) {
            return $reward;
        }

        $reward['status'] = 200;
        $reward['message'] = 'found';
        $reward['body'] = [
            'is_valid' => true,
            'value' => $promo->discount_value,
            'type' => $promo->discount_type
        ];

        return $reward;
    }
}
