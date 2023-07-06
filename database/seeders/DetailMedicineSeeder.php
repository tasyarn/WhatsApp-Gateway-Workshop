<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_medicines')->truncate();

        $detail_medicines = [
            [
                'id_members' => '1',
                'id_medicines' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '1',
                'id_medicines' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '1',
                'id_medicines' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '2',
                'id_medicines' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '2',
                'id_medicines' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '3',
                'id_medicines' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_members' => '3',
                'id_medicines' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        DB::table('detail_medicines')->insert($detail_medicines);
    }
}
