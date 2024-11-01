<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Admin\CategoryArticle;
class Sliders extends Model
{
    use HasFactory;


    protected $table = "sliders";
    protected $guarded = [];
    




    public function availableNoe(){


        $now = Carbon::now();

        
        return Sliders::whereNotNull('acceptedbyAdmin')->where('from' , "<" , $now)->where('to' , '>=' , $now)->where('paymentStatus' , '!=' ,'inPaymentQueue' )->get();
    }



    public function product(){
        return $this->belongsTo(Product::class  , 'product_id');
    }



    public function vendor(){
        return $this->belongsTo(Vendor::class , 'vendor_id');
    }

    public function article(){
        return $this->belongsTo(CategoryArticle::class , 'article_id');
    }










}
