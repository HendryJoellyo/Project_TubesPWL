<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaProfile extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_profiles'; // Sesuai dengan nama tabel di database

    protected $primaryKey = 'nrp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nrp',
        'name',
        'tanggal_lahir',
        'email',
        'password',
        'prodi_id',
    ];

    // Relasi ke tabel prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
