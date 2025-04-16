<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataUsahaProfile extends Model
{
    use HasFactory;
    protected $primaryKey = 'nik';
    public $incrementing = false; // kalau `nip` bukan auto-increment

    protected $table = 'tata_usaha_profiles'; // Sesuai dengan nama tabel
    
    protected $fillable = [
        'nik',
        'name',
        'tanggal_lahir',
        'email',
        'password',
    ];

    public function prodi()
{
    return $this->belongsTo(Prodi::class, 'prodi_id');
}
}

