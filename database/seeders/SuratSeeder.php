<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert beberapa jenis surat ke dalam tabel surat
        DB::table('surat')->insert([
            [
                'id' => '1', 
                'jenis_surat' => 'keterangan_aktif', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'jenis_surat' => 'pengantar_tugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',  
                'jenis_surat' => 'keterangan_lulus',  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '4',  
                'jenis_surat' => 'laporan_hasil_studi', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
