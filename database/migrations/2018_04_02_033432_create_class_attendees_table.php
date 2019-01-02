<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lms_klass_id');
            $table->bigInteger('lms_course_id');
            $table->bigInteger('user_id');
            $table->index(['user_id']);
            $table->string('lms_course_name');
            $table->string('slug');
            $table->index(['slug']);
            $table->float('attendance_completion_percentage')->default(0);
            $table->string('lms_custom_url')->nullable();
            $table->string('certificate_number')->nullable()->unique();
            $table->dateTime('certificate_published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_attendees');
    }
}
