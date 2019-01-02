<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsProductReadyAndAlterDefaultValueOfDescriptionSlugOnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_content_ready')->default(1);
            $table->index(['is_content_ready']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if(Schema::hasColumn('products', 'is_content_ready')) {
                $table->dropIndex(['is_content_ready']);
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if(Schema::hasColumn('products', 'is_content_ready')) {
                $table->dropColumn('is_content_ready');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->change();
        });
    }
}
