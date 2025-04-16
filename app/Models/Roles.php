<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles'; // Tambahkan ini
    protected $fillable = ['id', 'name'];
   
    
    public function  Users(): HasOne
{
    return $this->hasOne(Users::class, 'id');
}

}
