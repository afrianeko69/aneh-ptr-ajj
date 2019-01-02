<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_notifications', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('masked_card')->nullable();
            $table->string('approval_code')->nullable();
            $table->string('bank')->nullable();
            $table->string('eci')->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->double('gross_amount')->nullable();
            $table->string('order_id');
            $table->index(['order_id']);
            $table->string('payment_type')->nullable();
            $table->text('signature_key')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('status_message')->nullable();
            $table->timestamps();
            $table->text('json')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_notifications');
    }
}
