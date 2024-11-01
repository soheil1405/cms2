<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Image extends Model
{


    
    protected $table = "images";
    protected $guarded = [];

    public function vendor(){
        return $table->belongsTo(Vendor::class , "vendor_id");
    }
    
}
