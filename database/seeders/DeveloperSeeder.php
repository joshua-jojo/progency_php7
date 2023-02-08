<?php

namespace Database\Seeders;

use App\Models\Agen;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $id = User::create([
        //     'nama' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt(123123123),
        //     'role' => 'admin',
        // ]);
        $id = User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'password' => bcrypt(123123123),
            'role' => 'super admin',
        ]);

        // for ($i = 1; $i <= 10; $i++) {
        //     $id = User::create([
        //         'nama' => "Agen $i",
        //         'email' => "agen$i@agen.com",
        //         'password' => bcrypt(123123123),
        //         'role' => 'agen',
        //     ])->id;
        //     Agen::create([
        //         'tempat_lahir' => 'jambi',
        //         'rating' => 'non-grade',
        //         'tempat_lahir' => '2000-03-05',
        //         'jenis_kelamin' => 'pria',
        //         'user_id' => $id,
        //         'nik' => rand(10000, 100000),
        //         'foto' => 'base_data/profile.png',
        //         'status_terverifikasi' => 'aktif',
        //         'telp' => rand(10000, 100000),
        //     ]);
        // }

        // for ($i = 1; $i <= 1; $i++) {
        //     $id = User::create([
        //         'nama' => "Developer $i",
        //         'email' => "developer$i@developer.com",
        //         'password' => bcrypt(123123123),
        //         'role' => 'developer',
        //     ])->id;
        //     Developer::create([
        //         'user_id' => $id,
        //         'telp' => rand(10000, 100000),
        //         'logo' => 'base_data/profile.png',
        //     ]);
        // }
    }
}
