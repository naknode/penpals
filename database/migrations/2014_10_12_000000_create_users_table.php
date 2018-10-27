<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('beta')->default(true);
            $table->unsignedInteger('reputation')->default(0);
            $table->unsignedInteger('integrity')->default(0);
            $table->string('avatar_path')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('robot')->default(true);
            $table->string('confirmation_token', 25)->nullable()->unique();
            $table->rememberToken();
            $table->text('biography')->nullable();
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
        Schema::dropIfExists('users');
    }
}
