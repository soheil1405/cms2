<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsLinks extends Model
{
    use HasFactory;
    
    protected $table = "news_links";
    protected $guarded = [];



    public function creator(){
        return $this->belongsTo(User::class , 'creator_id');
    }
}
