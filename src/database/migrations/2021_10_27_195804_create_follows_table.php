<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('following_id')->nullable();
            $table->unsignedBigInteger('followed_id')->nullable();
            $table->timestamps();

            $table->foreign('following_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('followed_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

                  $table->unique(['following_id', 'followed_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
