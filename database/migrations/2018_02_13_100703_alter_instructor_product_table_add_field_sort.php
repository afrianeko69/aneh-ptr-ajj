<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInstructorProductTableAddFieldSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructor_product', function(Blueprint $table){
            $table->integer('sort')->nullable();
            $table->boolean('is_showed')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructor_product', function(Blueprint $table) {
            $table->dropColumn(['sort', 'is_showed']);
        });
    }
}
