<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBundleProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_product',  function(Blueprint $table) {
            $table->increments('bundle_product_id')->unsigned();
            $table->integer('bundle_id');
            $table->index(['bundle_id']);
            $table->integer('product_id');
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
        Schema::dropIfExists('bundle_product');
    }
}
