<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMusicFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('music_files', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('updated_at');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('music_files', function (Blueprint $table) {
            $table->dropForeign('music_files_user_id_foreign');
        });
    }
}
