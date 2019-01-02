<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNewsletterTableAddIsRegisteredToSendGridField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newsletters', function(Blueprint $table) {
            $table->boolean('is_registered_to_sendgrid')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newsletters', function(Blueprint $table) {
            $table->dropColumn(['is_registered_to_sendgrid']);
        });
    }
}
