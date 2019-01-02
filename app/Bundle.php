<?php

namespace App;

use App\Product;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{

    CONST FREE_BUNDLE = 'Gratis!';

    protected $fillable = [
        'name',
        'price',
        'start_at',
        'end_at',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'bundle_product')
            ->withPivot('sort')
            ->withTimestamps();
    }

    public function scopeActive($query) {
        $now = date('Y-m-d H:i:s');
        return $query->whereDate('start_at', '<=', $now)
                    ->whereDate('end_at', '>=', $now);
    }

    public static function bundlePrice(&$bundle, $key = 'price') {
        $bundle->bundle_formatted_price = (($bundle->{$key} == 0) ? self::FREE_BUNDLE : rupiah_number_format($bundle->{$key}));
    }

    public static function getRelatedBundle($product_id) {
        $bundles = [];

        try {
            $bundle_ids = Product::find($product_id)->bundles()->active()->pluck('id');

            $product_bundles = DB::table('bundles as b')
                    ->join('bundle_product as bp', function($query) {
                        $query->on('bp.bundle_id', '=', 'b.id');
                    })
                    ->join('products as p', function($query) {
                        $query->on('p.id', '=', 'bp.product_id');
                    })
                    ->whereIn('b.id', $bundle_ids)
                    ->select([
                        'b.name as bundle_name', 'b.price as bundle_price', 'b.id as bundle_id',
                        'p.slug', 'p.name as product_name', 'p.image'
                    ])
                    ->orderBy('bp.sort')
                    ->get();

            foreach($product_bundles as $bundle) {
                Product::productSlugURL($bundle);
                Product::productImage($bundle);
                self::bundlePrice($bundle, 'bundle_price');
                $bundles[$bundle->bundle_id]['bundle'] = (Object) [
                    'id' => $bundle->bundle_id,
                    'name' => $bundle->bundle_name,
                    'price' => $bundle->bundle_price,
                    'formatted_price' => $bundle->bundle_formatted_price,
                    'is_purchased' => false,
                ];
                $bundles[$bundle->bundle_id]['products'][] = (Object) [
                    'name' => $bundle->product_name,
                    'slug' => $bundle->slug,
                    'route_url' => $bundle->route_url,
                    'image_full_url' => $bundle->image_full_url,
                ];
            }

            return array_values($bundles);
        } catch (Exception $e) {
            return $bundles;
        }
    }
}
