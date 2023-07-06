<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_templates')->insert([
            'template_chat' => 'NoHP\n*Halo selamat pagi*,',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('chat_templates')->insert([
            'template_chat' => 'NoHP\n_Halo selamat siang_,',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('chat_templates')->insert([
            'template_chat' => 'NoHP\n~Halo selamat sore~,',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
