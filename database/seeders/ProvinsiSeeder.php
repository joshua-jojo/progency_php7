<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO provinsis (id, nama, alt_name, lat, `long`) VALUES (15, 'JAMBI', 'JAMBI', -1.611570, 102.779700);
        ");
    }
}
