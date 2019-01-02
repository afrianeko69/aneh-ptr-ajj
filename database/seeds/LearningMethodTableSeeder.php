<?php

use Illuminate\Database\Seeder;
use App\LearningMethod;

class LearningMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LearningMethod::create([
            'name' => 'Online'
        ]);

        LearningMethod::create([
            'name' => 'Offline'
        ]);
    }
}
