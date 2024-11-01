<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateVendorRequest;
use App\Http\Requests\UpdateRateVendorRequest;
use App\Models\Product;
use App\Models\RateProduct;
use App\Models\RateVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RateProductController extends Controller
{

    public function save(Request $request){

        $request->validate([
            'rate'=>'required',
            'product_id'=>'required'
        ]);


        $rate = RateProduct::create([

            'product_id'=>$request->product_id ,
            'rate'=>$request->rate 
        ]);
        

        session_start();

        $Session_rated_list_product = Session::get('Session_rated_list_product');

        if (!$Session_rated_list_product) {


        $templateArr = [];
        $rated_list =[
            'product_id'=>$request->product_id ,
            'rate'=>$request->rate
        ];
        array_push($templateArr , $rated_list);

        Session::put('Session_rated_list_product', $templateArr);

        
        }else{
            array_push($Session_rated_list_product, [
                'product_id'=>$request->product_id ,
                'rate'=>$request->rate
            ]);
            Session::put('Session_rated_list_product', $Session_rated_list_product);
        }
        
        $product =Product::find($request->product_id);

        $sum = 0;

        $counter = 0;



        foreach ($product->rates as $rate) {
            $sum += $rate->rate;
            $counter ++ ;
        }


        $ave = $sum / $counter;

        $product->update([

            'rate_Ave'=>$ave

        ]);

        
        
        return response()->json($Session_rated_list_product , 200);





    }

}