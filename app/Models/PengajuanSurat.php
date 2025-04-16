<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    // Tambahkan baris ini:
    protected $table = 'uploads';

    // Tambahkan ini juga agar kolom bisa diisi massal
    protected $fillable = ['surat_id', 'uploaded_by'];

    // app/Models/PengajuanSurat.php
public function surat()
{
    return $this->belongsTo(Surat::class);
}

<<<<<<< HEAD
public function user()
{
    return $this->belongsTo(User::class);
}

public function upload()
{
    return $this->hasOne(\App\Models\Upload::class, 'pengajuan_surat_id');
}

=======
>>>>>>> ac7c495be41d54213b953494ba0466e46c144335
}
