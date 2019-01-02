<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' => 'Jakarta Selatan'
        ]);

        Location::create([
            'name' => 'Jakarta Timur'
        ]);

        Location::create([
            'name' => 'Jakarta Barat'
        ]);

        Location::create([
            'name' => 'Jakarta Pusat'
        ]);

        Location::create([
            'name' => 'Jakarta Utara'
        ]);
    }
}
