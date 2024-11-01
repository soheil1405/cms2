<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    public function index()
    {

        $products = Product::isAvailable()->filter()->paginate(20);

        // foreach ($products as  $p) {
            
        //     if($p->ladder_product == null){
        //         $p->update([
        //             'ladder_product'=>$p->created_at
        //         ]);
        //     }
        // }
        

        // $products = $products->orderByDesc('pin_number')->latest()->orderByDesc('ladder_product')->paginate(20); 
        return $products;

    }

    public function pinned()
    {
        $products = Product::isAvailable()->orderByDesc('pin_number')->orderByDesc('ladder_product')->paginate(20);

        
        return $products;

    }

    public function pinnedCatProduct($category)
    {
        $products = Product::isAvailable()->whereNotNull('pin_number')->where('lvl_one_category_id' , $category)->where('pin_number', '>', '0')->orderBy('pin_number')->get();

        return $products;

    }

    public function pinnedBrandProduct($brand)
    {
        $products = Product::isAvailable()->whereNotNull('pin_number')->where('brand_id' , $brand)->where('pin_number', '>', '0')->orderBy('pin_number')->get();

        return $products;

    }

    public function show($id)
    {

        
        $product = Product::findOrFail($id);

        

        return $product;
    }

    public function VendoAnotherProducts($vendor  , $count = null)
    {

        if(is_null($count)){
            $count = 8;
        }


            $products = $vendor->anotherProducts->take($count);
         
        

            // dd($products);
        
            
            return $products;

    }

    public function samplePr($product)
    {

        $lvl_one_category_id = $product->category->id;

        $id = $product->id;

        

        $samplePr = Product::where('id' ,'!=',$id)->isAvailable()->orderByDesc('pin_number')->orderByDesc('ladder_product')->where('lvl_one_category_id', $lvl_one_category_id)->take(6)->get();

        
        
        return $samplePr;

    }

    public function categoryProducts($category)
    {

        $products = $category
            ->products()
            ->isAvailable()
            ->filter()
            ->paginate(50);


            

        return $products;

    }

    public function getAuthFavoritedProduct()
    {

        $products = Auth::user()->vendor->favorites->whereNotNull('product_id');
        return $products;

    }

    public function getSingle($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function getProductInArray($pids)
    {
        $products = Product::whereIn('id', $pids)->get();

        return $products;
    }
    public function SearchInProducts($searchInput)
    {

        return Product::where('name', $searchInput)->isAvailable();
    }

    public function showByBrand($brandId)
    {
        $products = Product::where('brand_id', $brandId)->
        isAvailable()->OrderByDesc('pin_number' )->OrderByDesc("ladder_product")
        ->paginate(50);

        return $products;

    }

    public function search2($searchInput, $category = null)
    {
     
        

        if($category){
 
            $products = 
            $category
            ->products()->isAvailable();

        }else{

            $products = Product::isAvailable();
        }

        return  $products->where('name', 'like', '%' . $searchInput . '%')->orderByDesc('ladder_product')->paginate(50);

    }

    public function most_view_products($count)
    {
        $most_view_products = Product::orderBy('view_counter', 'desc')->isAvailable()->limit($count)->get();

        return $most_view_products;
    }

    public function HomePopulars($count)
    {
        $HomePopulars = Product::orderBy('rate_Ave', 'desc')->isAvailable()->limit($count)->get();

        return $HomePopulars;
    }




    public function pinnedProduct($vid){

    }
}
