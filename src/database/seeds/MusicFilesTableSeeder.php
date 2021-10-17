<?php

use Illuminate\Database\Seeder;

class MusicFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        [
            'id' => '23',
            'music_file' => 'mp3files/メジャーリーグファンファーレ.mp3',
            'cover_image' => 'images/sample.png',
            'title' => 'seeder test',
            'genre' => 'j-pop',
            'emotions' => 'joy',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => '1',
            'uesr_name' => 'seeder test',
        ];
    }
}
