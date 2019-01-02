<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrNew([
            'name' => 'Category 1',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Category 1',
            ])->save();
        }

        $category = Category::firstOrNew([
            'name' => 'Category 2',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Category 2',
            ])->save();
        }
    }
}
