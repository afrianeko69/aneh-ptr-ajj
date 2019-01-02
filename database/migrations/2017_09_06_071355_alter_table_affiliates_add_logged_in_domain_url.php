<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAffiliatesAddLoggedInDomainUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function(Blueprint $table) {
            $table->string('logged_in_domain_url')->nullable()->unique();
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
            if(Schema::hasColumn('affiliates', 'logged_in_domain_url')) {
                $table->dropUnique(['logged_in_domain_url']);
                $table->dropColumn('logged_in_domain_url');
            }
        });
    }
}
