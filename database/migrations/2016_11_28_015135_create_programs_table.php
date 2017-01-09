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
            $table->increments('id')->comment('节目ID');
            $table->string('name', 100)->comment('节目名称')->default('');
            $table->text('intro')->comment('节目介绍');
            $table->unsignedTinyInteger('type')->comment('节目类型，0=其他类型；1=视频节目；2=音频节目；3=音视频节目')->default(0);
            $table->unsignedTinyInteger('status')->comment('节目目前状态，0为正常；1为已停播；99为节目在平台已下线')->default(0);
            $table->timestamps();
            $table->softDeletes();
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
