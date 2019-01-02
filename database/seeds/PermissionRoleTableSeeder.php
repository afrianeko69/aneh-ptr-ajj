<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'developer')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        $role = Role::where('name', 'user')->firstOrFail();

        $allowed_content = ['browse','read','edit'];
        
        $user_permissions[] = Permission::select('id')->where('key','browse_admin')->pluck('id')->first();
        foreach ($allowed_content as $key => $value) {
            $user_permissions[] = Permission::select('id')->where('key',[$value.'_contents'])->pluck('id')->first();
        };
        $role->permissions()->sync($user_permissions);
    }
}
