<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMusicFilesToMusicFileOnMusicFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('music_files', function (Blueprint $table) {
            $table->renameColumn('music_files', 'music_file');
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
            $table->renameColumn('music_file', 'music_files');
        });
    }
}
