<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProductCategoryFulltextSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE products ADD FULLTEXT products_fulltext_index(name, description)');
        DB::statement('ALTER TABLE categories ADD FULLTEXT categories_fulltext_index(name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropIndex(['fulltext']);
        });
        Schema::table('categories', function(Blueprint $table) {
            $table->dropIndex(['fulltext']);
        });
    }
}
