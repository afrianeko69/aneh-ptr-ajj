<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_topic', function (Blueprint $table)
        {
            $table->increments('product_topic_id');
            $table->integer('topic_id')->unsigned();
            $table->index(['topic_id']);
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
        Schema::dropIfExists('product_topic');
    }
}
