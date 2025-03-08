<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasItSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('petugas_it')->insert([
            [
                'nomor_petugas' => '6289680724800',
                'nama_petugas_it' => 'Romzi Fadach',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_petugas' => '6287860044334',
                'nama_petugas_it' => 'Eko Wahyu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_petugas' => '6282235382030',
                'nama_petugas_it' => 'Wisnu Prayogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}