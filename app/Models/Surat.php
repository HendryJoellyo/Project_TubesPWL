<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'mahasiswa_nrp',
        'jenis_surat',
        'status',
        'file_surat'
    ];

    // Relasi ke Mahasiswa (jika NRP-nya dari mahasiswa_profiles)
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaProfile::class, 'mahasiswa_nrp', 'nrp');
    }

    // Relasi ke approvals (disetujui/ditolak oleh kaprodi atau tu)
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    // Relasi ke uploads (TU mengunggah surat)
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}
