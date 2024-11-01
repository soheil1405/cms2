<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "tickets";
    protected $guarded = [];


    public function mainThread(){
        return $this->hasMany(Ticket::class)->where('status', 'open')->whereNull('answered_to');        
    }

    public function answers(){
        return $this->hasMany(Ticket::class , 'answered_to')->orderBy('id');
    }



    public function vendor(){
        return $this->belongsTo(Vendor::class , 'username');
    }


    



}
