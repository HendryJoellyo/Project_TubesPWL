<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi'; // Tambahkan ini
    protected $fillable = ['nama_prodi', 'ketua_prodi_nik'];
    public function ketuaProdiProfile()
    {
        return $this->belongsTo(KetuaProdiProfile::class, 'ketua_prodi_nik', 'nik');

    }
    


}
