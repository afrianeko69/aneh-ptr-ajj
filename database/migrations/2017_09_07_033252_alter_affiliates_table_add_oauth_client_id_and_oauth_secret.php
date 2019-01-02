<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAffiliatesTableAddOauthClientIdAndOauthSecret extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function(Blueprint $table) {
            $table->integer('oauth_client_id')->nullable();
            $table->index(['oauth_client_id']);
            $table->string('oauth_secret')->nullable();
            $table->index(['oauth_secret']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliates', function(Blueprint $table) {
            $table->dropIndex(['oauth_client_id']);
            $table->dropIndex(['oauth_secret']);
            $table->dropColumn(['oauth_client_id', 'oauth_secret']);
        });
    }
}
