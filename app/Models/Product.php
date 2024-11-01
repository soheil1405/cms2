<?php

namespace App\Models;

use App\Models\Admin\ProductComments;
use App\Models\Admin\SpecialProducts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory , SoftDeletes ;


    protected $table = "products";
    protected $guarded = [];
    protected $appends = ['quantity_check', 'sale_check', 'price_check'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    // public function sluggable():array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }

    public function getQuantityCheckAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->first() ?? 0;
    }

    public function getSaleCheckAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->where('sale_price', '!=', null)->where('date_on_sale_from', '<', Carbon::now())->where('date_on_sale_to', '>', Carbon::now())->orderBy('sale_price')->first() ?? false;
    }

    public function getPriceCheckAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->orderBy('price')->first() ?? false;
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function scopeFilter($query)
    {

        // if(request()->has('attribute')){
           
        
        //     foreach(request()->attribute as $attribute){
        //         $query->whereHas('attributes' , function($query) use($attribute) {
        //             foreach(explode('-',  $attribute ) as $index =>$item){
        //                 if($index == 0){
        //                     $query->where('value' , $item);
        //                 }else{
        //                     $query->orWhere('value' , $item);
        //                 }
        //             }
        //         });
        //     }

        // }


        
        // if(request()->has('variations')){
        //     $query->whereHas('variations' , function($query){
        //         foreach(explode('-', request()->variations) as $index =>$variation){
        //             if($index == 0){
        //                 $query->where('value' , $variation);
        //             }else{
        //                 $query->orWhere('value' , $variation);
        //             }
        //         }
        //     });
        // }



        if(request()->has('sortPrice'))
        {
            $validator = Validator::make(request()->all(),
                [
                    'sortPrice'       => ['string']
                ]
            );

            if(!$validator->fails()){
                
                $query->join('product_variations','product_variations.product_id','=','products.id');
                $query->select('products.*');
                if(request()->sortPrice == 'down')
                {
                    $query->orderBy('price');
                }
                if(request()->sortPrice == 'up')
                {
                    $query->orderByDesc('price');
                }
                
            }
            
        }

        if(request()->has('category')  && request()->category!=0000000  )
        {
            $validator = Validator::make(request()->all(),
                [
                    'category'      => ['numeric']
                ]
            );

            if(!$validator->fails()){
                $category = Category::find(request()->category);
                if(!is_null($category))
                {
                    $query->whereHas('categories',function($qur){
                        $qur->where('id',request()->category);
                    });
                }
            }
        }

        if(request()->has('price'))
        {
            $validator = Validator::make(request()->all(),
                [
                    'price'       => ['array','size:2'],
                    'price.*'     => ['numeric','min:1000','max:25000000']
                ]
            );

            if(!$validator->fails()){
                $query->whereHas('variations',function($qur){
                    $qur->whereBetween('price',[request()->price[0],request()->price[1]]);
                });
            }
            
        }


        if(request()->has('brands')){

            
            


            foreach(explode('-', request()->brands) as $index =>$brand){
                    if($index == 0){
                        $query->where('brand_id' , $brand);
                    }else{
                        $query->orWhere('brand_id' , $brand);
                    }
                }

                

        }
        

        if(request()->has('filterImgs')){

            if(request('filterImgs') == 'JustWithImgs'){

                $query->where('primary_image', '!=', 'product-default-limage.jpg');

            }else{

            }

        }


        if(request()->has('filterPrice')  && request('filterPrice') == 'JustPriceCheckBox' ){
                $query->whereNotNull('product_price');
        }


        if(request()->has('SortBy')){
            
            $sortBy = request('SortBy');
            switch($sortBy){

                case 'Expensive':
                    // $query->orderByDesc(
                    //     ProductVariation::select('price')->whereColumn('product_variations.product_id'  , 'products.id' )->orderBy('price' , 'asc')->take(1));

                    $query->orderByDesc('product_price');

                    // dd($query->tosql());
                    break;


                case 'MostRates':
                    // $query->orderBy(
                    //     ProductVariation::select('price')->whereColumn('product_variations.product_id'  , 'products.id' )->orderBy('price' , 'desc')->take(1));
                    

                    $query->orderBy('rate_Ave' , 'desc');

                    // dd($query);    
                    break;


                case 'Inexpensive':
                    // $query->orderBy(
                    //     ProductVariation::select('price')->whereColumn('product_variations.product_id'  , 'products.id' )->orderBy('price' , 'desc')->take(1));
                    

                    $query->orderBy('product_price');

                    // dd($query);    
                    break;
    
                case 'latest':
                    $query->OrderByDesc('pin_number' )->OrderByDesc("ladder_product");
                    break;
                    
                    
                case 'oldest':
                        $query->orderBy('created_at' , 'asc');
                    break;
               case 'view':
                        $query->orderBy('view_counter' , 'desc');
                    break;

             
             
               default:            
                    break;

                }
        }else{
            $query->OrderByDesc('pin_number' )->OrderByDesc("ladder_product");
        }

        
        if(request()->has('search_in')){
        
            $keyword = request()->search_in;
            if ( trim($keyword) != '') {
                $query->where('name', 'LIKE', '%'. trim($keyword) .'%');
            }
          
        }

        
        return $query;
    }

    public function scopeSearch($query)
    {
        $keyword = request()->search;
        if (request()->has('search') && trim($keyword) != '') {
            $query->where('name', 'LIKE', '%'. trim($keyword) .'%');
        }

        return $query;
    }


    public function avtiveImages(){
        return $this->hasMany(ProductImage::class)->where('status'  ,"active");

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'lvl_one_category_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->where('image' , '!=' ,$this->primary_image);
    }


    public function Allimages()
    {
        
        if($this->primary_image && $this->primary_image == "product-default-limage.jpg"){
            return $this->hasMany(ProductImage::class)->where('image' , '!=' ,$this->primary_image);

        }else{
            return $this->hasMany(ProductImage::class);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function FilterByPrice($order){
        
        return $this->hasMany(ProductVariation::class)->orderBy('price' , $order);

    }

    public function MainCatProducts($mainCatId){
        return $this->belongsToMany(Category::class)->where('parent_id' , $mainCatId);
    }



    public function favorite(){
        return $this->hasMany(favorite::class);
    }


    public function SpeciallProducts (){
        return $this->hasMany(SpecialProducts::class);
    }





    public function price (){
        return $this->hasOne(ProductVariation::class)->whereNotNull('price');
    }



    public function All_Comments (){
        return $this->hasMany(ProductComments::class);
    }



    public function Available_comments(){
        return $this->hasMany(ProductComments::class)->where('is_active', "1")->whereNull('MainParent');
    }



    public function commentCounts()
    {
        return  $this->hasMany(ProductComments::class)->where('is_active', "1");

    }



    public function CommentHasNotSeen(){
        return $this->hasMany(ProductComments::class)->where('is_active', 1)->where('vendor_id' , Auth::user()->vendor->id)->whereNull('MainParent')->where('seenOrNot' , 0);

    }



 
    public function rates(){
        return $this->hasMany(RateProduct::class , 'product_id');
    }



    public function AvailableVendor($query){
        

        if($this->vendor->status !="no" && $this->vendor->status !="reported" ){
            return $query;
        }

    }


    public function primary_image(){
    
        if($this->primary_image == "product-default-limage.jpg"){
            return  "product-default-limage.jpg";
        }

        $image = ProductImage::where('image' , $this->primary_image)->first();


        if($image && $image->status == "new" ){

            foreach ($this->avtiveImages as $PImage) {
                if ($PImage->status == "active" && $PImage->id != $image->id) {
                    return $PImage->image;
                }
            }
            return  "product-default-limage.jpg";
        }


        return $this->primary_image;
    }


    public function scopeIsAvailable($query){

        return $query->whereNotIn('status' ,  ['new', "reported" , "reported-edited"]);
    }

    


    public function getNewStatusAfterUpdate(){

        if ($this->status == "new") {
            
            return "new";
        }elseif($this->status == "reported" || $this->status == "reported-edited" ){
            return "reported-edited";
        }else{
            return "edited";
        }

    }


    public function isActive(){

        if (in_array($this->status ,  ['new', "reported" , "reported-edited"])) {
            return false;
        }
        return true;

    }

}


