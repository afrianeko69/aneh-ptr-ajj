<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReferralCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_referral_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                  ->unsigned();
            $table->index(['user_id']);
            $table->string('referral_code')
                  ->unique()
                  ->nullable();
            $table->boolean('is_default')
                  ->default(0)
                  ->comment('This is used to define the user generated referral code based on their name');
            $table->index(['is_default']);
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
        Schema::dropIfExists('user_referral_codes');
    }
}
