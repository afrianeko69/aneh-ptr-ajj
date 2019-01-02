<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->dateTime('discount_start_at')->nullable();
            $table->dateTime('discount_end_at')->nullable();
            $table->string('products')->nullable();
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
        Schema::dropIfExists('bundles');
    }
}
