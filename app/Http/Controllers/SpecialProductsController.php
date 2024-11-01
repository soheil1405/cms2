<?php

namespace App\Http\Controllers;

use App\Models\Admin\SpecialProducts;
use App\Models\Product;
use App\Models\setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


class SpecialProductsController extends Controller
{

    //by Admin
    public function MakeProductSpecial(Request $request)
    {
        $from = Carbon::parse($request->from);

        if (is_null($request->from)) {
            $from = Carbon::now();
        }


        $to = Carbon::parse($request->to);

        
        $request->validate([
            
            'product_id' => 'required',
            // 'from' => 'required',
            'to' => 'required',
 
        ]);
        
        

        $product = Product::find($request->product_id);
        $time_now = Carbon::now();



        $lastCreatedAndActiveNow  =  SpecialProducts::Where('vendor_id', $product->vendor_id )
        ->where('toDate', '>=', $time_now)->where("product_id" , $product->id)->first();

        $time_now = Carbon::now();

        // $lastCreatedAndActiveNow  =  SpecialProducts::Where('vendor_id', $product->vendor_id )
        // ->where('product_id' , $request->product_id)
        // ->where('toDate', '>=', $time_now)->first();

        if($lastCreatedAndActiveNow){
            Session()->flash("fail" , "شما قبلا محصول خود  را ویژه کردید ... میتوانید با تماس با پشتیبانی اینستابرق مدت آن را افزایش دهید");
            return redirect()->back();
        }

        

        // try {
            SpecialProducts::create([

                'vendor_id' => $product->vendor_id,
                'product_id' => $request->product_id,
                'fromDate' => $from,
                'toDate' => $to,
 
                
            ]);
            Alert::success('محصول مورد نظر با موفقیت ویژه شد', 'باتشکر');
            return redirect()->route('admin.products.index');
        // } catch (Exception $e) {
        //     Alert::error('عملیات با شکست مواجه شد ...', 'خطا');

        //     return redirect()->route('admin.products.index')->with(['errors' => 'عملیات با شکست مواجه شد']);
        // }
    }

    public function get_available($count = null  , $cat=null )
    {

        $time_now = Carbon::now();


        if($count){
            
        $speciallProducts = SpecialProducts::where('fromDate', '<', $time_now)->where('toDate', '>', $time_now)->latest()->limit($count)->OrderByDesc('ladder_product')->get();
        
        }else{
            
        $speciallProducts = SpecialProducts::where('fromDate', '<', $time_now)->where('toDate', '>', $time_now)->latest()->OrderByDesc('ladder_product')->get();
        
        }
        
        return $speciallProducts;

    }

    public function getAll(Request $request)
    {

        $setting = setting::first();

        $SpecialPcount = $setting->SpecialPcount;

        if ($request->has('from')) {

            $from = $request->from;

            $to = $request->to;

            if (!is_null($from)) {

                $from = Carbon::parse($request->from);

            } else {
                $from = Carbon::now();
            }

            if (!is_null($to)) {
                $to = Carbon::parse($request->to);
            } else {
                $to = Carbon::now();
            }

            $showBy = $request->showBy;

            $speciallProducts = [];

            // dd($to);
            $time_now = Carbon::now();
                    
            switch ($showBy) {
                case 'all':



                    if(!is_null($request->from) || !is_null($request->to)){
                        $databaseTimesInMiddle = SpecialProducts::where('fromDate', '>', $from)
                        ->where('toDate', '<', $to)->get();

                    $BothOfIputsInMiddle = SpecialProducts::where('fromDate', '<=', $to)
                        ->where('fromDate', '<=', $from)
                        ->where('toDate', '>=', $to)
                        ->where('toDate', '>=', $from)->get();

                    $fromDateIsInMiddle = SpecialProducts::where('toDate', "<", $to)
                        ->where('toDate', '>', $from)
                        ->where('fromDate', "<", $to)
                        ->where('fromDate', '<', $from)
                        ->get();

                    $toDateIsInMiddle = SpecialProducts::where('toDate', ">", $to)->where('fromDate', ">", $from)->where('fromDate', '<', $to)->get();
                    //ok
                    foreach ($databaseTimesInMiddle as $item) {
                        array_push($speciallProducts, $item);
                    }

                    foreach ($BothOfIputsInMiddle as $item) {
                        array_push($speciallProducts, $item);
                    }

                    foreach ($fromDateIsInMiddle as $item) {
                        array_push($speciallProducts, $item);
                    }

                    foreach ($toDateIsInMiddle as $item) {
                        array_push($speciallProducts, $item);
                    }
                    }else{

                        $speciallProducts = SpecialProducts::orderByDesc('id')->get();
                    }


                    break;
                case 'actives':

                    $speciallProducts = SpecialProducts::where('fromDate', '<=', $time_now)->where('toDate', '>=', $time_now)->get();
                   
                    
                    break;
                case 'inQueue':
                   

                    $speciallProducts = SpecialProducts::where('fromDate', '>', $time_now)->where('toDate', '>', $time_now)->get();
                   


                    break;
                case 'Ended':
                   
                    $speciallProducts = SpecialProducts::where('fromDate', '<', $time_now)->where('toDate', '<', $time_now)->get();
                   
                    break;

                default:
                    # code...
                    break;
            }

        } else {
            $speciallProducts = SpecialProducts::latest()->get();

        }


        if ($request->excelExport) {

            ob_end_clean();
            ob_start();

            
            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($speciallProducts , 'spcP'), 'instabargh.specialVendors' . now() . '.xlsx');

        }
        
        return view('admin.products.speciallityProducts', compact('speciallProducts', 'SpecialPcount'));
    }

    public function EditProductSpecial(Request $request)
    {


        // dd($request->all());
        // $request->validate([
        //     'product_id' => 'required|numeric',
        //     'from' => 'required',
        //     'to' => 'required',
        //     'position' => 'required|min:1|max:12',
        // ]);

        // try {

            $product = SpecialProducts::where('id', $request->id)->first();

            //  dd($product->id);


            $to  = Carbon::parse($request->to);

            $product->update([
                // 'fromDate' => $request->from,
                'toDate' => $to,
                // 'position' => $request->position,

            ]);

            
            return redirect()->route('admin.allSpecialProducts');
        // } catch (Exception $e) {
        //     return redirect()->route('admin.products.index')->with(['errors' => 'عملیات با شکست مواجه شد']);
        // }

    }

    public function deleteFromSpecials(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {

            $product = SpecialProducts::where('product_id', $request->id)->first();

            $product->delete();

            return redirect()->route('admin.speciallityProducts');

        } catch (Exception $e) {
            return redirect()->route('admin.products.index')->with(['errors' => 'عملیات با شکست مواجه شد']);
        }

    }






    public function deleteUpgeatedProduct(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        try {

            $product = SpecialProducts::findOrFail($request->id);

            $product->delete();

            return redirect()->route('user.upgradeproduct.index');

        } catch (Exception $e) {
            return redirect()->route('admin.products.index')->with(['errors' => 'عملیات با شکست مواجه شد']);
        }    }










}
