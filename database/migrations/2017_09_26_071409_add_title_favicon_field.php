<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleFaviconField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            if (!Schema::hasColumn('affiliates', 'site_title')) {
                $table->string('site_title')->nullable();
            }

            if (!Schema::hasColumn('affiliates', 'favicon')) {
                $table->string('favicon')->nullable();
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
            if (Schema::hasColumn('affiliates', 'site_title')) {
                $table->dropColumn('site_title');
            }
            if (Schema::hasColumn('affiliates', 'favicon')) {
                $table->dropColumn('favicon');
            }
        });
    }
}
