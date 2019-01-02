<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserReferralCodeIdToStudentLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_leads', function(Blueprint $table) {
            $table->unsignedInteger('user_referral_code_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_leads', function(Blueprint $table) {
            $table->dropColumn('user_referral_code_id');
        });
    }
}
