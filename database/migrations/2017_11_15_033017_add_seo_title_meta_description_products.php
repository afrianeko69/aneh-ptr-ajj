<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoTitleMetaDescriptionProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'seo_title')) {
                $table->text('seo_title')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'seo_title')) {
                $table->dropColumn('seo_title');
            }
            if (Schema::hasColumn('products', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
        });
    }
}
