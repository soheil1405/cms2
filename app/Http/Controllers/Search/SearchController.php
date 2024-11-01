<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;


class SearchController
{
    public function search()
    {

        
        

        if (\request()->filled('btnradioSearch') || \request()->filled('mobileradiochecked')  ) {
            $search_input = \request('searchInput') ? \request('searchInput')  :  \request(('mobileradiochecked')); 
            $btnradioSearch = \request('btnradioSearch') ? \request('btnradioSearch')  :  \request(('mobileradiochecked')); 
            
            
            
            switch ($btnradioSearch) {
                case 'brand':
                    $brands = $this->SearchInBrands($search_input);
                    $search_in = 'brand';


                    
                    
                    return view('ListOf.SearchResult', compact('brands', 'search_input', 'search_in'));

                    break;

                case 'vendor':
                    $vendors = $this->SearchInVendors($search_input);
                    $search_in = 'vendor';
                    return view('ListOf.SearchResult', compact('vendors', 'search_input', 'search_in'));
                    break;

                case 'product':
            
                    $category = \request('category');

                    if ($category){
                        $selectedCategory = Category::where("slug" , $category)->first();

                        $product = $this->SearchInProducts($search_input , $selectedCategory);
                        $search_in = 'product';

                        $brandsInCat = [];

                        foreach ($product as $p) {
                            $is = 'no';
                
                            foreach ($brandsInCat as $brand) {
                                if ($brand->id == $p->brand->id) {
                                    $is = 'yes';
                                }
                            }
                            if ($is == 'no') {
                                array_push($brandsInCat, $p->brand);
                            }
                        }
                
                
                        return view('ListOf.SearchResult', compact('product', 'search_input', 'search_in' , 'brandsInCat' , 'selectedCategory'));                    
                    
                    }else{

                    $product = $this->SearchInProducts($search_input , null);
                    $search_in = 'product';
                    return view('ListOf.SearchResult', compact('product', 'search_input', 'search_in' ));
                    }

                    break;
            }
        } else {

            session()->flash('SearchErrmsg' , 'لطفا دسته مورد نظر را انتخاب کنید ');
            return redirect()->route('products.index');

        }
    }


    public function search_product_in_all_cats(Request $request)
    {

        $request->validate([
            
            'searchInput'=>'required'
        ]);
                
        $search_input =  $request->searchInput;

        $product = $this->SearchInProducts($search_input);
        $search_in = 'product';
        return view('ListOf.SearchResult', compact('product', 'search_input', 'search_in'));
    }


    public function searchAjax_product(Request $request)
    {

        $request->validate([
            
            'searchInput'=>'required'
        ]);
                
        $search_input =  $request->searchInput;

        
        $myArray = [];


        $result = $this->SearchInProducts($search_input);
        foreach($result as $res){

            array_push($myArray, [
                'name' => $res->name ,
                'img'=>$res->primary_image ,
                'slug'=>$res->slug , 
                'cat'=> $res->category ,
                'search_input'=>$search_input
            ]);

        }

        return \response()->json($myArray ,202);

    }

    public function searchAjax_vendors(Request $request)
    {
        $search_input = $request->searchInput;

        return response()->json($this->SearchInVendors($search_input), 200);
    }

    public function searchAjax_brands(Request $request)
    {            
        $search_input = $request->searchInput ;

        return response()->json($this->SearchInBrands($search_input), 200);

    }



    public function SearchInBrands($searchInput)
    {
        return Brand::where('is_active' , '1')->where('name', 'like', '%' . $searchInput . '%')->paginate(50);
    }
    public function SearchInVendors($searchInput)
    {
        return Vendor::where('adminVendor','no')->where('name','like','%'.$searchInput.'%')->OrderByDesc('laddered_at')->paginate(20);
    }

    public function SearchInProducts($searchInput  , $category = null)
        {



            
        return resolve(ProductRepository::class)->search2($searchInput , $category);
    }




}
