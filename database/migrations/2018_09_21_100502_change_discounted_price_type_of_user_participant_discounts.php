<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDiscountedPriceTypeOfUserParticipantDiscounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_participant_discounts', function (Blueprint $table) {
            $table->decimal('discounted_price', 16, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_participant_discounts', function (Blueprint $table) {
            $table->decimal('discounted_price')->nullable()->change();
        });
    }
}
