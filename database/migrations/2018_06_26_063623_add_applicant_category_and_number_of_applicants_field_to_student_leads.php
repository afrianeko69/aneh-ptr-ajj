<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplicantCategoryAndNumberOfApplicantsFieldToStudentLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_leads', function(Blueprint $table) {
            $table->string('applicant_category')->nullable();
            $table->unsignedSmallInteger('number_of_applicants')->nullable()->comment('only filled if applicant_category is Perusahaan');
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
            $table->dropColumn('applicant_category');
            $table->dropColumn('number_of_applicants');
        });
    }
}
