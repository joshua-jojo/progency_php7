<?php

namespace Database\Seeders;

use App\Models\MasterPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterPerusahaan::create([
            'nama' => 'Koba Progency',
            'logo' => 'base_data/logo-black.png',
        ]);
    }
}
