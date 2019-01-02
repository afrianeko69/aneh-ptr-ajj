<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
            'name' => 'Teknik'
        ]);

        Topic::create([
            'name' => 'Psikologi'
        ]);

        Topic::create([
            'name' => 'Peternakan'
        ]);

        Topic::create([
            'name' => 'MIPA'
        ]);
    }
}
