<?php

use Illuminate\Database\Seeder;
use App\Provider;
use Faker\Factory;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Provider::create([
            'name' => 'Samator',
            'description' => $faker->text,
            'logo' => $faker->imageUrl
        ]);

        Provider::create([
            'name' => "I'm on my way",
            'description' => $faker->text,
            'logo' => $faker->imageUrl
        ]);

        Provider::create([
            'name' => 'Ukrida',
            'description' => $faker->text,
            'logo' => $faker->imageUrl
        ]);
    }
}
