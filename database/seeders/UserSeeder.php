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
        $users = [
            [
                'nama' => 'Manajemen',
                'no' => '08123456789',
                'role' => 0,
                'password' => bcrypt('manajemen1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pegawai',
                'no' => '081351798490',
                'role' => 1,
                'password' => bcrypt('pegawai1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'Pegawai Pegawai',
                'no' => '085899721589',
                'role' => 1,
                'password' => bcrypt('pegawai1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
