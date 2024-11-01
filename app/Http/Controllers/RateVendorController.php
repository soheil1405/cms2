<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateVendorRequest;
use App\Http\Requests\UpdateRateVendorRequest;
use App\Models\RateVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RateVendorController extends Controller
{

    public function save(Request $request){

        $request->validate([
            'rate'=>'required',
            'vendor_id'=>'required'
        ]);


        $rate = RateVendor::create([

            'vendor_id'=>$request->vendor_id ,
            'rate'=>$request->rate 
        ]);
        

        session_start();

        $Session_rated_list = Session::get('Session_rated_list');

        if (!$Session_rated_list) {
        

            $templateArr = [];
        $rated_list = [
            'vendor_id'=>$request->vendor_id ,
            'rate'=>$request->rate
        ];
        array_push($templateArr , $rated_list);
        Session::put('Session_rated_list', $templateArr);

        
        }else{

            array_push($Session_rated_list, [
                'vendor_id'=>$request->vendor_id ,
                'rate'=>$request->rate
            ]);

            Session::put('Session_rated_list', $Session_rated_list);



            
        }
        
        $vendor =Vendor::find($request->vendor_id);

        $sum = 0;

        $counter = 0;



        foreach ($vendor->rates as $rate) {
            $sum += $rate->rate;
            $counter ++ ;
        }


        $ave = $sum / $counter;

        $vendor->update([

            'rate_Ave'=>$ave ,
            'rate_count'=>$vendor->rate_count+1

        ]);

        
        
        return response()->json($Session_rated_list , 200);





    }









}
