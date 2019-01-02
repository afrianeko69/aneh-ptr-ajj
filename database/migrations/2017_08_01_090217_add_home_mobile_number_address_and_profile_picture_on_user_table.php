<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHomeMobileNumberAddressAndProfilePictureOnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('home_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            if(Schema::hasColumn('users', 'home_number')) {
                $table->dropColumn('home_number');
            }
        });

        Schema::table('users', function(Blueprint $table) {
            if(Schema::hasColumn('users', 'phone_number')) {
                $table->dropColumn('phone_number');
            }
        });

        Schema::table('users', function(Blueprint $table) {
            if(Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
        });

        Schema::table('users', function(Blueprint $table) {
            if(Schema::hasColumn('users', 'profile_picture')) {
                $table->dropColumn('profile_picture');
            }
        });
    }
}
