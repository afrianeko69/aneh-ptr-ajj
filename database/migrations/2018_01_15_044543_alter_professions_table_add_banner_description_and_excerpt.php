<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProfessionsTableAddBannerDescriptionAndExcerpt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions', function(Blueprint $table) {
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
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
            $table->dropColumn(['banner', 'description', 'excerpt']);
        });
    }
}
