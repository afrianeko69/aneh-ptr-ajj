<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // We have to separate the drop case in migration for sqlite issues
        // link: https://github.com/laravel/framework/issues/2979
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'parent_id')) {
                $table->dropForeign(['parent_id']);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['parent_id']);
        });

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropUnique(['slug']);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['slug']);
        });

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'order')) {
                $table->dropColumn(['order']);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->integer('parent_id')->unsigned()->nullable()->default(null);
                $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            }

            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable();
                $table->unique(['slug']);
            }

            if (!Schema::hasColumn('categories', 'order')) {
                $table->integer('order')->default(1);
            }

            if (Schema::hasColumn('categories', 'name')) {
                $table->dropUnique(['name']);
            }
        });
    }
}
