<?php

use Illuminate\Database\Seeder;
use App\Industry;

class IndustryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::create([
            'name' => 'Agriculture'
        ]);

        Industry::create([
            'name' => 'Business'
        ]);

        Industry::create([
            'name' => 'Communication'
        ]);

        Industry::create([
            'name' => 'Accounting'
        ]);
    }
}
