<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramAccessRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_access_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wx_user_id');
            $table->unsignedInteger('program_id');
            $table->timestamp('created_at');
            $table->foreign('wx_user_id')->references('id')->on('wx_users');
            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_access_records');
    }
}
