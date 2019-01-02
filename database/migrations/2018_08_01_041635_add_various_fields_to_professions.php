<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVariousFieldsToProfessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions', function(Blueprint $table) {
            $table->string('youtube_video_id')->nullable();
            $table->text('pay')->nullable();
            $table->text('task')->nullable();
            $table->text('knowledge')->nullable();
            $table->text('skill')->nullable();
            $table->boolean('is_content_ready')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professions', function(Blueprint $table) {
            $table->dropColumn('youtube_video_id');
            $table->dropColumn('pay');
            $table->dropColumn('task');
            $table->dropColumn('knowledge');
            $table->dropColumn('skill');
            $table->dropColumn('is_content_ready');
        });
    }
}
