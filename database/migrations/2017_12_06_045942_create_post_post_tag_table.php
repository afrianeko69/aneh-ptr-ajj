<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('posts', function(Blueprint $table) {
            $table->string('post_tag')->nullable();
        });

        Schema::create('post_post_tag', function (Blueprint $table)
        {
            $table->increments('post_post_tag_id');
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('post_tag_id')->unsigned();
            $table->foreign('post_tag_id')->references('id')->on('post_tags')->onDelete('cascade');
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
        Schema::dropIfExists('post_post_tag');
        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn('post_tag');
        });
    }
}
