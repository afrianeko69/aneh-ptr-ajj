<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTableAddPromoCodePromoRewardValuePromoRewardValueTypePromoRewardNominalPriceAfterPromoReward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->string('promo_code')->nullable();
            $table->index(['promo_code']);
            $table->double('promo_reward_value')->nullable();
            $table->string('promo_reward_value_type')->nullable();
            $table->double('promo_reward_nominal')->nullable();
            $table->double('price_after_promo_reward')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn([
                'promo_code', 'promo_reward_value', 'promo_reward_value_type',
                'promo_reward_nominal', 'price_after_promo_reward'
            ]);
        });
    }
}
