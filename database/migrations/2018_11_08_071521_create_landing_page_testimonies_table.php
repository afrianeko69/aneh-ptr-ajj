<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageTestimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_testimonies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('landing_page_id')->unsigned();
            $table->string('person_name')->nullable();
            $table->string('person_title')->nullable();
            $table->string('person_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['landing_page_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_page_testimonies');
    }
}
