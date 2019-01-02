<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_product', function (Blueprint $table)
        {
            $table->increments('instructor_product_id');
            $table->integer('instructor_id')->unsigned();
            $table->index(['instructor_id']);
            $table->integer('product_id')->unsigned();
            $table->index(['product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_product');
    }
}
