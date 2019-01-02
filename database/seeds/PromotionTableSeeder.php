<?php

use App\Bundle;
use App\Product;
use App\Promotion;
use Illuminate\Database\Seeder;

class PromotionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BundleTableSeeder::class);

        $now = date('Y-m-d H:i:s');
        $active_promotion = factory(App\Promotion::class)->create();
        $not_active_promotion = factory(App\Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '-7 days'))
        ]);

        $product_slug = [
            'zurich-proteksi-education-program', 'dasar-pemrograman',
            'data-science-technology-series'
        ];
        $product = Product::whereIn('slug', $product_slug)
                    ->select(['id'])
                    ->get();

        if(!$product->isEmpty()){
            $active_promotion->product()->sync($product);
        }

        $bundle_name = [
            'Data science package', 'Dasar Pemrograman'
        ];

        $bundles = Bundle::whereIn('name', $bundle_name)
                    ->select(['id'])
                    ->get();

        if(!$bundles->isEmpty()) {
            $not_active_promotion->bundle()->sync($bundles);
        }
    }
}
