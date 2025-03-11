<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetuaProdiProfile extends Model
{
    use HasFactory;

    protected $table = 'ketua_prodi_profiles';
    protected $primaryKey = 'nik';
    public $incrementing = false; // Karena nik adalah string dan primary key
    protected $fillable = ['nik', 'name', 'email', 'tanggal_lahir', 'prodi_id', 'password'];



    public function prodi()
{
    return $this->belongsTo(Prodi::class, 'prodi_id');
}


}
