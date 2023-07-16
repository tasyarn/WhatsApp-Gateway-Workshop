<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'nama_perusahaan' => 'WA Gateway',
            'no_penerima_pesan' => '62',
            'no_penerima_pesan_2' => '62',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
