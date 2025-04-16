<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi'; // Tambahkan ini
    protected $fillable = ['nama_prodi'];
   
    
    public function ketuaProdiProfile(): HasOne
{
    return $this->hasOne(KetuaProdiProfile::class, 'prodi_id', 'id');
}

}
