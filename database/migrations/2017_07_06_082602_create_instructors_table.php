<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstructorsTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('instructors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->string('email')->nullable()->unique();
            $table->text('description', 65535);
            $table->string('profile_picture');
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
        Schema::dropIfExists('instructors');
    }

}
