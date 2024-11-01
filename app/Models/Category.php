<?php

namespace App\Models;

use App\Models\Admin\CategoryArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $guarded = [];

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال' ;
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeLvl_one($query)
    {
        return $query->where('parent_id',0);
    }


    private function walk($result,$category)
    {
        if(is_null($category->parent))
        {
            return $result;
        }else{
            $result->push($category->parent);
            return $this->walk($result,$category->parent);
        }
    }


    public function all_parents()
    {
        $parent = $this->parent;
        $walk = true;
        $result = collect([$this]);
        $result = $this->walk($result,$this);
        return $result;
    }


    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'attribute_category');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->where('status' , '!=' , 'new');
    }



    public function Articles(){
        return $this->hasOne(CategoryArticle::class);
    }
    



}
