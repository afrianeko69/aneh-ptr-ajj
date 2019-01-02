<?php

use Illuminate\Database\Seeder;
use App\Instructor;
use Faker\Factory;

class InstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Instructor::create([
            'name' => $faker->name,
            'title' => $faker->title,
            'email' => $faker->email,
            'description' => $faker->text,
            'profile_picture' => $faker->imageUrl
        ]);

        Instructor::create([
            'name' => $faker->name,
            'title' => $faker->title,
            'email' => $faker->email,
            'description' => $faker->text,
            'profile_picture' => $faker->imageUrl
        ]);

        Instructor::create([
            'name' => $faker->name,
            'title' => $faker->title,
            'email' => $faker->email,
            'description' => $faker->text,
            'profile_picture' => $faker->imageUrl
        ]);
    }
}
