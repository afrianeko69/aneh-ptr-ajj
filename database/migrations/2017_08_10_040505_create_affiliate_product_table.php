<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_product', function (Blueprint $table)
        {
            $table->integer('affiliate_id')->unsigned();
            $table->index(['affiliate_id']);
            $table->integer('product_id')->unsigned();
            $table->index(['product_id']);
            $table->primary(['affiliate_id', 'product_id']);
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
        Schema::dropIfExists('affiliate_product');
    }
}
