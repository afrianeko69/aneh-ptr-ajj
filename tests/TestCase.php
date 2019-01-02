<?php

namespace Tests;

use App;
use Artisan;
use DB;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Schema;
use TCG\Voyager\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $baseUrl = 'http://pintaria.dev';
    public $affiliate;
    public $affiliate_role;

    public function setUp()
    {
        parent::setUp();

        Schema::disableForeignKeyConstraints();
        $not_truncate_tables = [
            'migrations', 'data_rows', 'data_types', 'menu_items', 'menus', 'roles',
            'permissions', 'permission_role', 'contents', 'pages'
        ];

        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $truncated_tables = array_diff($tables, $not_truncate_tables);

        foreach ($truncated_tables as $table) {
            DB::table($table)->truncate();
        }

        Artisan::call('db:seed', ['--class' => 'VoyagerDummyDatabaseSeeder']);
        Schema::enableForeignKeyConstraints();

        $roles = Role::all();
        foreach($roles as $role) {
            if ($role->name === 'affiliate') {
                $this->affiliate_role = $role;
            }
        }

        $affiliate = factory(App\Affiliate::class)->create();

        $this->affiliate = factory(App\User::class)->create([
            'role_id' => $this->affiliate_role->id,
            'affiliate_id' => $affiliate->id,
            'password' => bcrypt(123456),
        ]);
    }
}
