<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_universities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('landing_page_id')->unsigned();
            $table->text('name')->nullable();
            $table->smallInteger('sort')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('landing_page_universities');
    }
}
