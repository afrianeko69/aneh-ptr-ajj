<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceStudentLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('student_leads', function(Blueprint $table) {
            $table->string('source_id')->nullable();
            $table->string('source_from')->nullable();
            $table->text('source_name')->nullable();
            $table->string('source_medium')->nullable();
            $table->text('source_term')->nullable();
            $table->text('source_content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('student_leads', function(Blueprint $table) {
            $table->dropColumn('source_id');
            $table->dropColumn('source_from');
            $table->dropColumn('source_name');
            $table->dropColumn('source_medium');
            $table->dropColumn('source_term');
            $table->dropColumn('source_content');
        });
    }
}
