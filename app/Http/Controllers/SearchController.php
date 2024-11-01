<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\HomeLander;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\ProductRepository;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{


    public function search()
    {


        // dd('search');
        // return view('ListOf.SearchResult'); 
        // if(\request()->filled('btnradioSearch') && \request()->filled('searchInput')){
           
           
        //     $search_input = \request('searchInput');

        //     switch(\request('btnradioSearch')){

        //         case 'brand':
        //             $brsnd = $this->SearchInBrands($search_input);
        //             $search_in = 'brand';
        //             return view('ListOf.SearchResult')->compact('brand' , 'search_in'); 
                    
        //             break;
    
        //         case 'vendor':
        //             $vendor =  $this->SearchInVendors($search_input);
        //             $search_in = 'vendor';
        //             return view('ListOf.SearchResult')->compact('vendor' , 'search_in'); 
        //             break;
        
        //         case 'product':
                    
        //             $product = $this->SearchInProducts($search_input);
        //             $search_in = 'product';
        //             return view('ListOf.SearchResult')->compact('product' , 'search_in'); 
        //             break;
        //     }
        // }

    }




    public function SearchInBrands($searchInput){

        return Brand::where('name' , $searchInput)->get();
    }
    public function SearchInVendors($searchInput){
        return Vendor::where('adminVendor' , 'no')->where('name' , $searchInput);
    }

    public function SearchInProducts($searchInput){

        return resolve(ProductRepository::class)->SearchInProducts($searchInput);
    }
   
}
