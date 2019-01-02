<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_database',
            'browse_media',
            'browse_settings',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('pages');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('posts');

        Permission::generateFor('categories');

        Permission::generateFor('providers');

        Permission::generateFor('instructors');

        Permission::generateFor('locations');

        Permission::generateFor('learning_methods');

        Permission::generateFor('industries');
        
        Permission::generateFor('banners');

        Permission::generateFor('contents');

        Permission::generateFor('topics');

        Permission::generateFor('products');

        Permission::generateFor('videos');

        Permission::generateFor('bundles');

        Permission::generateFor('promotions');

        Permission::generateFor('rating_reviews');

        Permission::generateFor('post_tags');

        Permission::generateFor('categories_classification');

        Permission::generateFor('professions');

        Permission::generateFor('testimonies');
    }
}
