<?php

namespace App\Models\Admin;

use App\Models\Product;
use App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductComments extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "product_comments";
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo(Product::class );
    }



    public function AllAnswers(){
        return $this->hasMany(ProductComments::class, 'MainParent')->where('is_active' , 1);
    }


    public function answers(){
        return $this->hasMany(ProductComments::class, 'answered_to')->where('is_active' , 1);
    }


    public function Parent(){
        return $this->hasOne(ProductComments::class, 'answered_to')->whereNotNull('answered_to');
    }




    public function vendor(){
        return $this->belongsTo(Vendor::class , 'vendor_id');
    } 
    
    
}
