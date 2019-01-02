<?php

use App\Profession;
use Illuminate\Database\Seeder;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::firstOrCreate([
            'name' => 'Akuntan',
            'sort' => 1
        ]);

        Profession::firstOrCreate([
            'name' => 'Dokter',
            'sort' => 2
        ]);

        Profession::firstOrCreate([
            'name' => 'Notaris',
            'sort' => 3
        ]);
    }
}
