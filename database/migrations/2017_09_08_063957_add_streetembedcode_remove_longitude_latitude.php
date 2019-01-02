<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStreetembedcodeRemoveLongitudeLatitude extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn(['longitude', 'latitude']);
            if (!Schema::hasColumn('affiliates', 'streetview_embed_code')) {
                $table->text('streetview_embed_code')->nullable();
            }
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            if (!Schema::hasColumn('affiliates', 'longitude')) {
                $table->string('longitude')->nullable();
            }
            if (!Schema::hasColumn('affiliates', 'latitude')) {
                $table->string('latitude')->nullable();
            }
            if (Schema::hasColumn('affiliates', 'streetview_embed_code')) {
                $table->dropColumn('streetview_embed_code')->nullable();
            }
        });
    }
}
