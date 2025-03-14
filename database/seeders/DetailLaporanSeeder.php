<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailLaporanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detail_laporan')->insert([
            [
                'nmr_laporan' => '20250218133245',
                'waktu_dihubungi' => NOW(),
                'ruangan_unit' => 'IT',
                'petugas_pelapor' => 'petugas IT',
                'jenis_kerusakan' => 'Hardware',
                'permasalahan' => 'Keyboard laptop tidak berfungsi',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'nmr_laporan' => '20250218133246',
                'waktu_dihubungi' => NOW(),
                'ruangan_unit' => 'IT',
                'petugas_pelapor' => 'petugas IT',
                'jenis_kerusakan' => 'Hardware',
                'permasalahan' => 'Keyboard laptop tidak berfungsi',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'nmr_laporan' => '20250218133248',
                'waktu_dihubungi' => NOW(),
                'ruangan_unit' => 'IT',
                'petugas_pelapor' => 'petugas IT',
                'jenis_kerusakan' => 'Hardware',
                'permasalahan' => 'Keyboard laptop tidak berfungsi',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'nmr_laporan' => '20250218133247',
                'waktu_dihubungi' => NOW(),
                'ruangan_unit' => 'IT',
                'petugas_pelapor' => 'petugas IT',
                'jenis_kerusakan' => 'Hardware',
                'permasalahan' => 'Keyboard laptop tidak berfungsi',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        ]);
    }
}
