<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('anchor_id');
            $table->unsignedInteger('program_type_id');
            $table->unsignedTinyInteger('level');
            $table->string('image_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('video_url')->nullable();
            $table->text('content');
            $table->date('published_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('anchor_id')->references('id')->on('anchors');
            $table->foreign('program_type_id')->references('id')->on('program_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}