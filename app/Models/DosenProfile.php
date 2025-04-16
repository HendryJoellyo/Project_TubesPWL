<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenProfile extends Model
{
    use HasFactory;
    
    protected $table = 'dosen_profiles'; // Sesuai dengan nama tabel
    
    protected $fillable = [
        'nik',
        'name',
        'tanggal_lahir',
        'email',
        'password',
    ];
}

