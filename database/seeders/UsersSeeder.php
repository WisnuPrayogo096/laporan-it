<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@ummhospital.com',
                'email_verified_at' => now(),
                'password' => bcrypt('spa@17082013'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ]
        ]);
    }
}