<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
        INSERT INTO `kabupatens` (`id`, `provinsi_id`, `nama`, `alt_name`, `lat`, `long`) VALUES
(1501, 15, 'KABUPATEN KERINCI', 'KABUPATEN KERINCI', -2.03333, 101.533),
(1502, 15, 'KABUPATEN MERANGIN', 'KABUPATEN MERANGIN', -2.06933, 102.133),
(1503, 15, 'KABUPATEN SAROLANGUN', 'KABUPATEN SAROLANGUN', -2.3, 102.65),
(1504, 15, 'KABUPATEN BATANG HARI', 'KABUPATEN BATANG HARI', -1.75, 103.117),
(1505, 15, 'KABUPATEN MUARO JAMBI', 'KABUPATEN MUARO JAMBI', -1.55214, 103.822),
(1506, 15, 'KABUPATEN TANJUNG JABUNG TIMUR', 'KABUPATEN TANJUNG JABUNG TIMUR', -1.13198, 103.618),
(1507, 15, 'KABUPATEN TANJUNG JABUNG BARAT', 'KABUPATEN TANJUNG JABUNG BARAT', -1.1544, 103.244),
(1508, 15, 'KABUPATEN TEBO', 'KABUPATEN TEBO', -1.45576, 102.375),
(1509, 15, 'KABUPATEN BUNGO', 'KABUPATEN BUNGO', -1.50222, 101.96),
(1571, 15, 'KOTA JAMBI', 'KOTA JAMBI', -1.61667, 103.65),
(1572, 15, 'KOTA SUNGAI PENUH', 'KOTA SUNGAI PENUH', -2.10896, 101.322);
        ");
    }
}
