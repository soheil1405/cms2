<?php

namespace App\Models\Admin;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SpecialProducts extends Model
{
    use HasFactory ;
protected $table = "table_special_products";
    protected $guarded = [];





    public function Product(){
        return $this->belongsTo(Product::class) ;
    }

}
