<?php

namespace Database\Seeders;

use App\Models\Pertanyaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaan = [
            'Bisakah menceritakan soal diri anda?',
            'Kenapa kami harus mempekerjakan anda?',
            'Berapa gaji yang anda harapkan?',
            'Apa yang anda lihat dari dirimu 3 sampai 5 tahun lagi?',
            'Apa kelemahan terbesarmu?',
        ];
        foreach ($pertanyaan as $key => $value) {
            Pertanyaan::create(['pertanyaan' => $value]);
        }
    }
}
