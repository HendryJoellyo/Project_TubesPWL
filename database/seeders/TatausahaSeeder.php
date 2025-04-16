<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TatausahaSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Tata_Usaha',
            'email' => 'tatus@gmail.com',
            'password' => Hash::make('tatus123'),
            'role' => 'tata_usaha',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
  