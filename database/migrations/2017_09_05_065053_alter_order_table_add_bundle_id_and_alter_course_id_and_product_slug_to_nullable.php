<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderTableAddBundleIdAndAlterCourseIdAndProductSlugToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->integer('course_id')->nullable()->change();
            $table->string('product_slug')->nullable()->change();
            $table->integer('bundle_id')->nullable();
            $table->index(['bundle_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table) {
            if(Schema::hasColumn('orders', 'bundle_id')) {
                $table->dropIndex(['bundle_id']);
                $table->dropColumn('bundle_id');
            }
        });
    }
}
