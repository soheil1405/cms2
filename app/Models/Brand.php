<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    protected $table = "brands";
    protected $guarded = [];

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);

    }


    public function products (){
        return $this->hasMany(Product::class)->where('status' , '!=' , 'new')->OrderByDesc('pin_number' )->OrderByDesc("ladder_product");
    }

    public function AllProducts (){
        return $this->hasMany(Product::class)->OrderByDesc('pin_number' )->OrderByDesc("ladder_product");
    }
}
