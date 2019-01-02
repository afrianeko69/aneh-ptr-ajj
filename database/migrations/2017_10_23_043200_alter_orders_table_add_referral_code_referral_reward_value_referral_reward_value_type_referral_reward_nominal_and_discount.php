<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTableAddReferralCodeReferralRewardValueReferralRewardValueTypeReferralRewardNominalAndDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->string('referral_code')->nullable();
            $table->double('referral_reward_value')->nullable();
            $table->string('referral_reward_value_type')->nullable();
            $table->double('referral_reward_nominal')->nullable();
            $table->double('product_discount_nominal')->nullable();
            $table->double('price_after_discount')->nullable();
            $table->double('total_product_price')->nullable();
            $table->double('price_after_referral_reward')->nullable();
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
                'referral_code', 'referral_reward_value', 'referral_reward_value_type',
                'referral_reward_nominal', 'product_discount_nominal', 'price_after_discount',
                'total_product_price', 'price_after_referral_reward'
            ]);
        });
    }
}
