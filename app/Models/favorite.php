<?php

namespace App\Models;

use App\Models\Admin\CategoryArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;

    protected $table = "favorites";
    protected $guarded = [];




    public function products(){
        return $this->belongsTo(Product::class , 'product_id')->whereNotNull('acceptedbyAdmin');
    }

    public function Product(){
        return $this->belongsTo(Product::class , 'product_id');
    }
    public function story(){
        return $this->belongsTo(Story::class , 'story_id');
    }

    public function vendors(){
        return $this->belongsTo(Vendor::class , 'vendor_iddd');
    }

    public function CategoryArticle(){
        return $this->belongsTo(CategoryArticle::class , 'categoryArticle_id');
    }




}