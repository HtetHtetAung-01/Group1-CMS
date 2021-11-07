<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->date('dob');
            $table->char('gender', 1);
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->string('address', 255);
            $table->string('password');
            $table->string('profile_path')->default('profile/default.png');
            $table->tinyInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps(0);
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
