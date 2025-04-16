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
<<<<<<< HEAD
    return $this->hasOne(User::class, 'id');
=======
    return $this->hasOne(Users::class, 'id');
>>>>>>> ac7c495be41d54213b953494ba0466e46c144335
}

}
