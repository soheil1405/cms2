<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArticles extends Model
{
    use HasFactory;
    protected $guarded = [];





    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function scopeInQueueArticles($query){

        return $query->where('status' , '!=' , '1');
    }

}
