<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->string('reviewer_name');
            $table->string('reviewer_email');
            $table->index(['reviewer_email']);
            $table->integer('product_id');
            $table->index(['product_id']);
            $table->text('review');
            $table->decimal('rating');
            $table->string('status')->default('Pending');
            $table->index(['status']);
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
        Schema::dropIfExists('rating_reviews');
    }
}
