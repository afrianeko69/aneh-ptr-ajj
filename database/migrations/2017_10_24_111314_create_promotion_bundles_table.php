<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_bundles', function(Blueprint $table) {
            $table->increments('promotion_bundle_id');
            $table->integer('promotion_id');
            $table->integer('bundle_id');
            $table->timestamps();

            $table->index(['promotion_id']);
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
        Schema::dropIfExists('promotion_bundles');
    }
}
