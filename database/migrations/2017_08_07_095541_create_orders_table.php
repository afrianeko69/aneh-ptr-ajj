<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->index(['email']);
            $table->string('phone');
            $table->integer('user_id');
            $table->index(['user_id']);
            $table->integer('course_id');
            $table->index(['course_id']);
            $table->string('product_slug');
            $table->index(['product_slug']);
            $table->string('transaction_id')->nullable();
            $table->index(['transaction_id']);
            $table->string('order_number')->unique();
            $table->string('invoice_number')->unique();
            $table->double('amount');
            $table->integer('quantity')->unsigned();
            $table->string('currency');
            $table->string('tax_type');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
