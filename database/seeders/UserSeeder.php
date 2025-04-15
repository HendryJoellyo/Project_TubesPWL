<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Kaprodi
        DB::table('users')->insert([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@example.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tata Usaha
        DB::table('users')->insert([
            'name' => 'Tata Usaha',
            'email' => 'tatus@example.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
