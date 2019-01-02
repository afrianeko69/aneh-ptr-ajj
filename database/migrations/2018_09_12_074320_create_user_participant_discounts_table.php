<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserParticipantDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_participant_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_number')->nullable();
            $table->integer('product_id')->nullable();
            $table->decimal('discounted_price')->nullable();
            $table->boolean('is_same_provider')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();

            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_participant_discounts');
    }
}
