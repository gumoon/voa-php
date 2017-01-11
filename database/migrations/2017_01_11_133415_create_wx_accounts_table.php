<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->unique();
            $table->string('nick_name')->nullable();
            $table->unsignedTinyInteger('gender')->default(0)->comment('0=未知，1=男，2=女');
            $table->string('language')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('avatar_url')->nullable();
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
        Schema::dropIfExists('wx_accounts');
    }
}
