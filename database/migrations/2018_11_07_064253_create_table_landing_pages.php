<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLandingPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('meta_description')->nullable();
            $table->text('main_title')->nullable();
            $table->text('main_description')->nullable();
            $table->string('main_image')->nullable();
            $table->text('feature_title')->nullable();
            $table->text('feature_description')->nullable();
            $table->text('testimony_title')->nullable();
            $table->text('testimony_description')->nullable();
            $table->text('university_title')->nullable();
            $table->text('footer_content')->nullable();
            $table->text('footer_note')->nullable();
            $table->boolean('is_content_ready')->default(false);
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
        Schema::dropIfExists('landing_pages');
    }
}
