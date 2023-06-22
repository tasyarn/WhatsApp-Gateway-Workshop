<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Manajemen',
            'no' => '08123456789',
            'role' => 0,
            'password' => bcrypt('manajemen1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
