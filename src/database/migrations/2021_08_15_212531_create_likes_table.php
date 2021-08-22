<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('music_file_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->OnDelete('cascade');
            $table->foreign('music_file_id')
                  ->references('id')->on('music_files')
                  ->OnDelete('cascade');

                  $table->unique(['user_id', 'music_file_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
