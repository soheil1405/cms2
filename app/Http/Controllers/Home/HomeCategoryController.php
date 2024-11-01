<?php

namespace App\Http\Controllers\Home;

use App\Models\BuyGuidProduct;
use App\Models\Category;
use App\Models\SiteSidBarAdds;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Vendor;

class HomeCategoryController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $attributes = $category
            ->attributes()
            ->where('is_filter', 1)
            ->with('values')
            ->get();
        $variation = $category
            ->attributes()
            ->where('is_variation', 1)
            ->with('variationValues')
            ->first();

        // if ($category) {

        $products = resolve(ProductRepository::class)->categoryProducts($category);
        // } else {

            // dd($products);/

        //     $products = Product::all()
        //         ->filter()
        //         ->paginate(50);
        // }

        $brands = [];

        foreach ($products as $product) {
            $is = 'no';

            foreach ($brands as $brand) {
                if ($brand->id == $product->brand->id) {
                    $is = 'yes';
                }
            }
            if ($is == 'no') {
                array_push($brands, $product->brand);
            }
        }


        $sideAddLinks = SiteSidBarAdds::whereNotNull('showInProducts')->where('status', 1)->get();


        

        $buyGuid = BuyGuidProduct::where('category_id' , $category->id)->first();

        


        

        $title = $category->name;

        
        $selectedCategory = $category;

        // dd($selectedCategory);
        return view('ListOf.AllProducts', compact('selectedCategory', 'title' ,  'buyGuid' , 'attributes', 'variation', 'products', 'brands', 'sideAddLinks'));
    }

    public function showVendors(Request $request, Category $category)
    {
        $vendors = Vendor::where('pin_number' , '0')->where('adminVendor', 'no')->where('category_activity', 'like', '%' . $category->id . '%')->orderBy('updated_at')->paginate(20);

        



        $pinnedVendors = Vendor::where('pin_number', '>', "0") ->where('category_activity', 'like', '%' . $category->id . '%')->where('adminVendor', 'no')->OrderBy('pin_number')
        ->notNew()
        ->get();


        $cat_id = $category->id;

        if ($request->has('SortBy')) {
            $variable = $request->SortBy;
            switch ($variable) {
                case 'latest':
                    $vendors = Vendor::where('adminVendor', 'no')->where('category_activity', 'like', '%' . $category->id . '%')->latest()->paginate(20);
                    break;
                case 'pCount':
                    $vendors = Vendor::where('adminVendor', 'no')->where('category_activity', 'like', '%' . $category->id . '%')->orderBy('product_count')->paginate(20);
                    break;

                case 'view':
                    $vendors = Vendor::where('adminVendor', 'no')->where('category_activity', 'like', '%' . $category->id . '%')->orderByDesc('view_count')->paginate(20);


                    break;

                default:

                    break;
            }
        }

        $sideAddLinks = SiteSidBarAdds::whereNotNull('showInVendors')->where('status', 1)->get();



        return view('ListOf.AllVendors', compact('vendors', 'cat_id', 'sideAddLinks' , 'pinnedVendors'));
    }


    public function index(){

        $categories = \App\Models\Category::where('parent_id', 0)->orderBy('id')->get();
    
    

        return view('ListOf.AllCats' , compact('categories'));
    }
}