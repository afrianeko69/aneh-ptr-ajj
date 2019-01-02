<?php

use App\Bundle;
use App\Product;
use Illuminate\Database\Seeder;

class BundleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $this->call(ProductTableSeeder::class);

        $products_slug = [
            'zurich-proteksi-education-program', 'dasar-pemrograman',
            'data-science-technology-series'
        ];

        $product_ids = [];
        foreach($products_slug as $slug) {
            $product = Product::where('slug', $slug)->first(['id']);
            if($product) {
                $product_ids[] = $product->id;
            }
        }

        $bundle = Bundle::firstOrNew([
            'name' => 'Data science package'
        ]);
        if(!$bundle->exists) {
            $bundle->fill([
                'price' => 5000000,
                'start_at' => date('Y-m-d H:i:s', strtotime($now . '-5 days')),
                'end_at' => date('Y-m-d H:i:s', strtotime($now . '+5 days'))
            ])->save();
            $bundle->products()->attach($product_ids);
        }

        $bundle = Bundle::firstOrNew([
            'name' => 'Dasar Pemrograman'
        ]);
        if(!$bundle->exists) {
            $bundle->fill([
                'price' => 1250000,
                'start_at' => date('Y-m-d H:i:s', strtotime($now . '-2 days')),
                'end_at' => date('Y-m-d H:i:s', strtotime($now . '+3 days'))
            ])->save();
            $bundle->products()->attach($product_ids);
        }
    }
}
