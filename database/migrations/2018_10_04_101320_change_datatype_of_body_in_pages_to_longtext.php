<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDatatypeOfBodyInPagesToLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Using raw query because of a bug in doctrine/dbal
        DB::statement('ALTER TABLE pages MODIFY COLUMN body LONGTEXT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE pages MODIFY COLUMN body TEXT NULL');
    }
}
