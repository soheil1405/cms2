<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageFromAdmin extends Model
{    
    
    
    
    use HasFactory , SoftDeletes;
    protected $table = "message_from_admins";


    protected $guarded = [];




    public function unread(){
        
    }


}
