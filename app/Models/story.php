<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class story extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "stories";
    protected $guarded = [];
    



    public function vendor(){
        return $this->belongsTo(Vendor::class , 'vendor_id');
    }



    public function product(){
        return $this->belongsTo(Product::class , 'product_id');        
    }



    public function availables(){
        
        
        $to = Carbon::now();


        $from = Carbon::now()->subHours(24);

        
        return story::whereNotNull('acceptedbyAdmin')->where('paymentStatus' , "!=" , "inPaymentQueue")->whereBetween('created_at', [$from, $to])
        ->where('sendBy' , 'vendor')
        ->get();
    }



    public function isActive() : bool{
        

        $to = Carbon::now();

        $from = Carbon::now()->subHours(24);


        if($this->created_at < $to && $this->created_at > $from){
            return true;
        
        }
        return false;


        
    }



}
