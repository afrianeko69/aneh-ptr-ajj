<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAffiliateIdFieldContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            if (!Schema::hasColumn('contents', 'affiliate_id')) {
                $table->integer('affiliate_id')->default('0')->after('id');
                $table->index(['affiliate_id']);
            }
            $table->dropUnique('contents_title_unique');
            $table->index(['title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('contents', function (Blueprint $table) {
            if(Schema::hasColumn('contents', 'affiliate_id')) {
                $table->dropIndex(['affiliate_id']);
                $table->dropColumn('affiliate_id');
            }
            $table->unique(['title']);
            $table->dropIndex(['title']);
        });
    }
}
