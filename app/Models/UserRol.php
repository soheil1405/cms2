<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    use HasFactory;


    protected $table = "rol_user";
    public function alladmins()
    {
        return $this->hasMany(User::class , 'user_id');
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
