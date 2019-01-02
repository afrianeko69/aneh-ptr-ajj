<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBundleTableRemoveDiscountAddBundleValidDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
        * Importants Notes: This migration must be separated for testing purposes
        * Because it will cause the field not showed up on the test and cause the test failed
        * Link: https://stackoverflow.com/questions/42165587/laravel-table-has-no-column-named
        * Link for sqlite lifecycle: https://stackoverflow.com/questions/6172815/sqlite-alter-table-add-multiple-columns-in-a-single-statement
        */
        Schema::table('bundles', function(Blueprint $table) {
            $table->dropColumn(['discount', 'discount_start_at', 'discount_end_at']);
        });

        Schema::table('bundles', function(Blueprint $table) {
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bundles', function(Blueprint $table) {
            $table->dropColumn(['start_at', 'end_at']);
            $table->double('discount')->nullable();
            $table->dateTime('discount_start_at')->nullable();
            $table->dateTime('discount_end_at')->nullable();
        });
    }
}
