<?php

namespace Database\Seeders;

use App\Models\Perumahan;
use App\Models\PerumahanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerumahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipe_rumah = [
            '21/24',
            '36',
            '45',
            '54',
            '60',
            '70',
            '90',
            '120',
            '140-200',
        ];

        $daya_listrik = [
            'CL 2 = 450 VA',
            'CL 4 = 900 VA',
            'CL 6 = 1300 VA',
            'CL 10 = 2200 VA',
            'CL 16 = 3500 VA',
        ];

        $jenis = [
            'subsidi',
            'non-subsidi'
        ];

        $sertifikat = [
            'Sertifikat Hak Milik (SHM)',
            'Hak Guna Bangunan (HGB)',
            'Girik atau Petok',
            'Serta Akta Jual Beli (AJB)',
            'Sertifikat Hak Satuan Rumah Susun (SHSRS)',
        ];

        $status = [
            'tersedia',
            'dp',
            'sold',
        ];
        $garasi = [
            'Tersedia',
            'Tidak Tersedia',
        ];
        $kondisi = [
            'baru', 'bekas'
        ];
        for ($i = 0; $i < 20; $i++) {
            $perumahan = Perumahan::create([
                'developer_id' => 1,
                'kode' => "p" . $i + 1,
                'nama' => "Rumah " . ($i + 1),
                'tipe' => $tipe_rumah[rand(0, count($tipe_rumah) - 1)],
                'blok' => rand(1, 10),
                'alamat' => '-',
                'jenis' => $jenis[rand(0, count($jenis) - 1)],
                'sertifikat' => $sertifikat[rand(0, count($sertifikat) - 1)],
                'harga' => rand(1, 10) * 100000000,
                'deskripsi' => '-',
                'status' =>  $status[rand(0, count($status) - 1)],
                'cover' => 'base_data/profile.png',
                'kondisi' =>  $kondisi[rand(0, count($kondisi) - 1)],
            ]);
            PerumahanDetail::create([
                'perumahan_id' => $perumahan->id,
                'cluster' => rand(1, 10),
                'kamar_tidur' => rand(1, 3),
                'kamar_mandi' => rand(1, 3),
                'lantai' => rand(1, 2),
                'luas_tanah' => rand(100, 200),
                'luas_bangunan' => rand(10, 50),
                'garasi' => 'tersedia',
                'tahun_dibangun' => rand(2000, 2022),
                'fasilitas' => '-',
                'daya_listrik' => $daya_listrik[rand(0, count($daya_listrik) - 1)],
            ]);
        }
    }
}
