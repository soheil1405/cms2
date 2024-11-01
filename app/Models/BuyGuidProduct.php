<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyGuidProduct extends Model
{
    use HasFactory;
    
    protected $table = "buy_guid_products";
    protected $guarded = [];



    public function creator(){
        return $this->belongsTo(User::class , 'creator_id') ;
    }


    public function category(){
        return $this->belongsTo(Category::class , 'category_id') ;
        
    }
}
