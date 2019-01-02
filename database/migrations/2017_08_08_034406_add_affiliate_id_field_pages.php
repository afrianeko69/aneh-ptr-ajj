<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAffiliateIdFieldPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'affiliate_id')) {
                $table->integer('affiliate_id')->default('0')->after('id');
                $table->index(['affiliate_id']);
            }
            $table->dropUnique('pages_slug_unique');
            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            if(Schema::hasColumn('pages', 'affiliate_id')) {
                $table->dropIndex(['affiliate_id']);
                $table->dropColumn('affiliate_id');
            }
            $table->unique(['slug']);
            $table->dropIndex(['slug']);
        });
    }
}
