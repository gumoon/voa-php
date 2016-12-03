<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_type')->comment('节目类型');
            $table->string('title', 100)->comment('标题');
            $table->date('publish_date')->comment('发布日期');
            $table->string('image_url', 255)->comment('头图链接');
            $table->string('media_url', 255)->comment('多媒体链接');
            $table->text('summary')->comment('简介');
            $table->unsignedInteger('author_id')->comment('作者');
            $table->text('new_words')->comment('新单词');
            $table->text('detail')->comment('json格式的更多信息');
            $table->unsignedTinyInteger('status')->comment('是否显示');
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
        Schema::dropIfExists('program_infos');
    }
}
