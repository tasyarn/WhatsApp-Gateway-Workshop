<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->truncate();

        $members = [
            [
                'id_users' => 2,
                'nama_member' => 'Soedjatmoko',
                'no_member' => '081216095789',
                'alamat_member' => 'Tandes',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id_users' => 2,
                'nama_member' => 'Soemitro',
                'no_member' => '081336355434',
                'alamat_member' => 'Mulyorejo',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id_users' => 3,
                'nama_member' => 'Halim',
                'no_member' => '081098889213',
                'alamat_member' => 'Bratang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('members')->insert($members);

    }
}
