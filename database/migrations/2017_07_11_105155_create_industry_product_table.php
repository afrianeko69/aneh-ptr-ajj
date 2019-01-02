<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_product', function (Blueprint $table)
        {
            $table->increments('industry_product_id');
            $table->integer('industry_id')->unsigned();
            $table->index(['industry_id']);
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
        Schema::dropIfExists('industry_product');
    }
}
