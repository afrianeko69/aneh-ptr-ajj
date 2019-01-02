<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_leads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->index(['email']);
            $table->string('url');
            $table->string('reference_name')->nullable();
            $table->string('reference_email')->nullable();
            $table->index(['reference_email']);
            $table->string('phone');
            $table->string('location');
            $table->string('product');
            $table->string('interest');
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
        Schema::dropIfExists('student_leads');
    }
}
