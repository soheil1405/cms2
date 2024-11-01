<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Follow extends Model
{


    
    protected $table = "follows";
    protected $guarded = [];



    

    public function followed(){
        return $this->belongsTo(Vendor::class , 'following');
    }


    public function follrs(){
        return $this->belongsTo(Vendor::class , 'vendor_id');
    }



    public function vendor1(){
        return $this->belongsTo(Vendor::class , 'vendor_id');
    }



    public function vendor2(){
        return $this->belongsTo(Vendor::class , 'following');
    }




    public function hasActiveStory($vendor_id){



        $to = Carbon::now();


        $from = Carbon::now()->subHours(24);

    
        $story = story::where('vendor_id' , $vendor_id)->whereNotNull('acceptedbyAdmin')->whereBetween('created_at', [$from, $to])->get();
    
    
        if(count($story)>0){
            return 1;
        }else{
            return 0;
        }
    
    
    }


    public function scopeFollowStatus( $query ,  $vid){
        return $query->where('following' , $vid);
    }


    public function scopeFollowerStatus( $query ,  $vid){
        return $query->where('vendor_id' , $vid);
    }

}
