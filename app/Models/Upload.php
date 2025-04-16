<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $table = 'uploads'; // Tambahkan ini
    protected $fillable = ['surat_id', 'status'];
   
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
    

}
