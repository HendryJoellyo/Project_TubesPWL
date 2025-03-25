<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat'; // Nama tabel dalam database

    protected $fillable = [
        'mahasiswa_nrp',
        'jenis_surat',
        'status',
        'file_surat',
    ];

    // Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaProfile::class, 'mahasiswa_nrp', 'nrp');
    }

    // Enum Jenis Surat
    public static function jenisSuratList()
    {
        return [
            'keterangan_aktif' => 'Surat Keterangan Aktif',
            'pengantar_tugas' => 'Surat Pengantar Tugas',
            'keterangan_lulus' => 'Surat Keterangan Lulus',
            'laporan_hasil_studi' => 'Surat Laporan Hasil Studi',
        ];
    }

    // Enum Status Surat
    public static function statusSuratList()
    {
        return [
            'diajukan' => 'Diajukan',
            'disetujui_kaprodi' => 'Disetujui Kaprodi',
            'disetujui_manager' => 'Disetujui Manager',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ];
    }
}
