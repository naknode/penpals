<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('language');
            $table->enum('fluency', ['beginner', 'intermediate', 'advanced', 'fluent', 'native', 'conversational', 'working fluency', 'professional fluency']);
            $table->enum('type', ['learning', 'speaks']);
            $table->timestamps();

            $table->unique(['user_id', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
