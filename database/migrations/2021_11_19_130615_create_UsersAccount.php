<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsersAccount', function (Blueprint $table) {
            $table->increments('users_id');
            $table->string('users_email', 50);
            $table->string('users_password');
            $table->string('users_name', 50);
            $table->string('users_phone', 15);
            $table->tinyInteger('users_role');
            $table->string('users_avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsersAccount');
    }
}
