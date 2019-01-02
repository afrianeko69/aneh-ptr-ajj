<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexSearches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE category_classifications ADD FULLTEXT category_classifications_fulltext_index(name)');
        DB::statement('ALTER TABLE industries ADD FULLTEXT industries_fulltext_index(name)');
        DB::statement('ALTER TABLE professions ADD FULLTEXT professions_fulltext_index(name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professions', function(Blueprint $table) {
            $table->dropIndex(['fulltext']);
        });
        Schema::table('industries', function(Blueprint $table) {
            $table->dropIndex(['fulltext']);
        });
        Schema::table('category_classifications', function(Blueprint $table) {
            $table->dropIndex(['fulltext']);
        });
    }
}
