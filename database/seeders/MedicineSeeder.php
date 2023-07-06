<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data from the table
        DB::table('medicines')->truncate();

        $medicines = [
            [
                'nama_obat' => 'Aspirin',
                'harga_obat' => 10000,
                'stok_obat' => 100,
                'status_obat' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_obat' => 'Paracetamol',
                'harga_obat' => 5000,
                'stok_obat' => 200,
                'status_obat' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'harga_obat' => 8000,
                'stok_obat' => 150,
                'status_obat' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('medicines')->insert($medicines);
    }
}
