<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardPublishedAtToUserParticipantsAndDropAttendeeCardIdInClassAttendee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_participants', function (Blueprint $table) {
            $table->dateTime('card_published_at')->nullable();
        });

        Schema::table('class_attendees', function (Blueprint $table) {
            $table->dropColumn('attendee_card_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_participants', function (Blueprint $table) {
            $table->dropColumn('card_published_at');
        });

        Schema::table('class_attendees', function (Blueprint $table) {
            $table->string('attendee_card_id')->nullable();
        });
    }
}
