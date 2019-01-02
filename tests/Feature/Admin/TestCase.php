<?php

namespace Tests\Feature\Admin;

use App;
use Artisan;
use DB;
use Illuminate\Contracts\Console\Kernel;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Schema;
use TCG\Voyager\Models\Role;

class TestCase extends BaseTestCase
{
    public $baseUrl = 'http://pintaria.dev';

    public $user;

    public $normal_user;

    public $dev_role;

    public $normal_role;

    public function createApplication()
    {
        $app = require __DIR__.'/../../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

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

            if ($role->name === 'developer') {
                $this->dev_role = $role;
            }

            if ($role->name === 'user') {
                $this->normal_role = $role;
            }
        }

        $this->user = factory(App\User::class)->create([
            'role_id' => $this->dev_role->id,
            'password' => bcrypt(123456),
        ]);

        $this->normal_user = factory(App\User::class)->create([
            'role_id' => $this->normal_role->id,
            'password' => bcrypt(123456),
        ]);
    }
}