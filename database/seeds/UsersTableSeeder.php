<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'developer')->firstOrFail();
            User::create([
                'name'           => 'Developer',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'user')->firstOrFail();
            User::create([
                'name'           => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'affiliate')->firstOrFail();
            User::create([
                'name'           => 'Affiliate',
                'email'          => 'affiliate@affiliate.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);
        }
    }
}
