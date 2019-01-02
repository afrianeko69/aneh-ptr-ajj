<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLongitudeLatitudeAffiliate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            if (!Schema::hasColumn('affiliates', 'longitude')) {
                $table->string('longitude')->nullable();
            }
            if (!Schema::hasColumn('affiliates', 'latitude')) {
                $table->string('latitude')->nullable();
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
            if (Schema::hasColumn('affiliates', 'longitude')) {
                $table->dropColumn('longitude');
            }
            if (Schema::hasColumn('affiliates', 'latitude')) {
                $table->dropColumn('latitude');
            }
        });
    }
}
