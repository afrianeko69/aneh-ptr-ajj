<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingCodeToProductsAndProviderCodeToProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table) {
            $table->string('training_code')->nullable();
        });

        Schema::table('providers', function(Blueprint $table) {
            $table->string('provider_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn('training_code');
        });

        Schema::table('providers', function(Blueprint $table) {
            $table->dropColumn('provider_code');
        });
    }
}
