<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreSpecialVendorsRequest;
use App\Http\Requests\UpdateSpecialVendorsRequest;
use App\Models\Admin\SpecialVendors;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class SpecialVendorsController extends Controller
{



    public function getAll(){

        $speciallVendors = SpecialVendors::latest()->get();

        return view('admin.vendors.speciallityVendors', compact('speciallVendors'));
    }



    public function MakeVendorSpecial(Request $request){

        



        $request->validate([
        
            'vendor_id'=>'required|numeric',
            'from' => 'required',
            'to'=>'required',

        ]);



        $time_now = Carbon::now();

        $lastCreatedAndActiveNow  =  SpecialVendors::Where('vendor_id', $request->vendor_id )
        ->where('toDate', '>=', $time_now)->first();

        if($lastCreatedAndActiveNow){
            Session()->flash("spcAdd" , "شما قبلا محصول خود  را ویژه کردید ... میتوانید مدت آن را افزایش دهید");
            return redirect()->back();
        }



            SpecialVendors::create([
                'vendor_id' => $request->vendor_id,
                'fromDate' => $request->from,
                'toDate' => $request->to,

                
            ]);

            
            Session()->flash('spcAdd' , 'فروشگاه مورد نظر با موفقیت  ویژه شد');

            return redirect()->route('admin.vendors.index');

        }





    public function get_available($count){
        
        $time_now = Carbon::now();
        $speciallVendors = SpecialVendors::whereNotNull('acceptedbyAdmin')->where('fromDate' , '<=' , $time_now)->where('toDate' , '>=', $time_now)->limit($count)->get();

        return $speciallVendors;
       
    }





    public function EditProductSpecial(Request $request){
       
       
        
        $request->validate([
            'product_id'=>'required|numeric',
            'from' => 'required',
            'to'=>'required',
            'position'=>'required|min:1|max:12'
        ]);
        
        
        // dd($request->product_id);


        try {




            $product = SpecialProducts::where('id' , $request->product_id)->first();
            
            //  dd($product->id);
            
            
            $product->update([
                'fromDate' => $request->from,
                'toDate' => $request->to,
                'position' => $request->position

            ]);

            return redirect()->route('admin.speciallityProducts');
        }catch(Exception $e){
            return redirect()->route('admin.products.index')->with(['errors'=>'عملیات با شکست مواجه شد']);
        }



        // dd($request->all());
    }



    public function deleteFromSpecials(Request $request){
        $request->validate([
            'id'=>'required'
        ]);

        try {
    
            $product = SpecialProducts::where('product_id', $request->id)->first();

            $product->delete();

            return redirect()->route('admin.speciallityProducts');


        }catch(Exception $e){
            return redirect()->route('admin.products.index')->with(['errors'=>'عملیات با شکست مواجه شد']);
        }




    }
}