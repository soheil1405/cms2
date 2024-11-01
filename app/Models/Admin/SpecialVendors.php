<?php

namespace App\Models\Admin;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialVendors extends Model
{
    use HasFactory , SoftDeletes;


    protected $table = "special_vendors";
    protected $guarded = [];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}