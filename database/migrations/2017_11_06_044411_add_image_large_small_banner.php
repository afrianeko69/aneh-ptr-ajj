<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageLargeSmallBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'image_large')) {
                $table->string('image_large')->nullable();
            }
            if (!Schema::hasColumn('banners', 'image_small')) {
                $table->string('image_small')->nullable();
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
        Schema::table('banners', function (Blueprint $table) {
            if (Schema::hasColumn('banners', 'image_large')) {
                $table->dropColumn('image_large');
            }
            if (Schema::hasColumn('banners', 'image_small')) {
                $table->dropColumn('image_small');
            }
        });
    }
}
