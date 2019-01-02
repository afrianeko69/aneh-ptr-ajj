<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderDetailsTableAddPriceAndDiscountedPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function(Blueprint $table) {
            $table->double('price')->nullable();
            $table->double('discounted_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function(Blueprint $table) {
            $table->dropColumn(['price', 'discounted_price']);
        });
    }
}
