<?php

namespace App\Http\Controllers;

use App\Models\Admin\SpecialVendors;
use App\Models\Orders;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use RealRashid\SweetAlert\Facades\Alert;

class SpecialVendorsController extends Controller
{

    public function getAll(Request $request)
    {

        $setting = setting::first();

        $SpecialVCount = $setting->SpecialVCount;

        // dd($SpecialVCount);

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

            $speciallVendors = [];

            // dd($to);
            $time_now = Carbon::now();

            // dd($request->all());
            switch ($showBy) {
                case 'all':

                    if (!is_null($request->from) || !is_null($request->to)) {
                        $databaseTimesInMiddle = SpecialVendors::where('fromDate', '>', $from)
                            ->where('toDate', '<', $to)->get();

                        $BothOfIputsInMiddle = SpecialVendors::where('fromDate', '<=', $to)
                            ->where('fromDate', '<=', $from)
                            ->where('toDate', '>=', $to)
                            ->where('toDate', '>=', $from)->get();

                        $fromDateIsInMiddle = SpecialVendors::where('toDate', "<", $to)
                            ->where('toDate', '>', $from)
                            ->where('fromDate', "<", $to)
                            ->where('fromDate', '<', $from)
                            ->get();

                        $toDateIsInMiddle = SpecialVendors::where('toDate', ">", $to)->where('fromDate', ">", $from)->where('fromDate', '<', $to)->get();
                        //ok
                        foreach ($databaseTimesInMiddle as $item) {
                            array_push($speciallVendors, $item);
                        }

                        foreach ($BothOfIputsInMiddle as $item) {
                            array_push($speciallVendors, $item);
                        }

                        foreach ($fromDateIsInMiddle as $item) {
                            array_push($speciallVendors, $item);
                        }

                        foreach ($toDateIsInMiddle as $item) {
                            array_push($speciallVendors, $item);
                        }
                    } else {

                        $speciallVendors = SpecialVendors::orderByDesc('id')->get();
                    }

                    break;
                case 'actives':

                    $speciallVendors = SpecialVendors::where('fromDate', '<=', $time_now)->where('toDate', '>=', $time_now)->get();

                    break;
                case 'inQueue':

                    $speciallVendors = SpecialVendors::where('fromDate', '>', $time_now)->where('toDate', '>', $time_now)->get();

                    break;
                case 'Ended':

                    $speciallVendors = SpecialVendors::where('fromDate', '<', $time_now)->where('toDate', '<', $time_now)->get();

                    break;

                default:
                    # code...
                    break;
            }

        } else {
            $speciallVendors = SpecialVendors::latest()->get();

        }

        if ($request->search) {

            $speciallVendors = new SpecialVendors();

            $speciallVendors = $speciallVendors->search($request->search);


            
        }

        if ($request->excelExport) {

            ob_end_clean();
            ob_start();

            
            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($speciallVendors , 'spcV'), 'instabargh.specialVendors' . now() . '.xlsx');

        }

        return view('admin.vendors.speciallityVendors', compact('speciallVendors', 'SpecialVCount'));
    }
    //by Admin
    public function MakeVendorSpecial(Request $request)
    {

        if ($request->from) {

            $from = Carbon::parse($request->from);

        } else {
            $from = Carbon::now();
        }

        if ($request->to) {

            $to = Carbon::parse($request->to);

        } else {
            $to = Carbon::now();
        }

        

        // $time_now = Carbon::now();

        // $lastCreatedAndActiveNow  =  SpecialVendors::Where('vendor_id', $request->vendor_id )
        // ->where('toDate', '>=', $time_now)->first();

        // if($lastCreatedAndActiveNow){
        //     Session()->flash("spcAdd" , "شما قبلا محصول خود  را ویژه کردید ... میتوانید مدت آن را افزایش دهید");
        //     return redirect()->back();
        // }

        $spc = SpecialVendors::create([
            'vendor_id' => $request->vendor_id,
            'fromDate' => $from,
            'toDate' => $to,

        ]);

        Session()->flash('spcAdd', ' فروشگاه مورد نظر با موفقیت  ویژه شد ');

        return redirect()->route('admin.vendors.index');

    }

    public function get_available($count = null)
    {

        $time_now = Carbon::now();

        if($count){
            
            
            $speciallVendors = SpecialVendors::where('fromDate', '<=', $time_now)->where('toDate', '>=', $time_now)->limit($count)->get();


        }else{
            $speciallVendors = SpecialVendors::where('fromDate', '<=', $time_now)->where('toDate', '>=', $time_now)->get();

        }

        return $speciallVendors;

    }

    public function EditSpecialVendor(Request $request)
    {

        // $request->validate([
        //     'product_id' => 'required|numeric',
        //     'from' => 'required',
        //     'to' => 'required',
        //     'position' => 'required|min:1|max:12',
        // ]);

        // dd($request->all());

        try {

            $speciallVendor = SpecialVendors::where('id', $request->id)->first();

            //  dd($product->id);


            $to  = Carbon::parse($request->to);


            $speciallVendor->update([
                // 'fromDate' => $request->from,
                'toDate' => $to,
                // 'position' => $request->position,

            ]);

            Session()->flash('spcAdd', ' فروشگاه مورد نظر با موفقیت  ویژه شد ');

            return redirect()->route('admin.AllSpecialVendors');
    
            
        } catch (Exception $e) {


            Session()->flash('spcAdd', ' عملیات با شکست مواجه شد ');

            return redirect()->route('admin.vendors.index');


        }

        // dd($request->all());
    }

    public function deleteFromSpecialVendors(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {

            $vendor = SpecialVendors::findOrFail($request->id);

            $vendor->delete();
            session()->flash('deleted', 'فروشگاه مورد نظر با موفقیت از  فروشگاه های ویژه حذف شد');

            return redirect()->route('admin.AllSpecialVendors');

        } catch (Exception $e) {
            return redirect()->route('admin.vendors.index')->with(['errors' => 'عملیات با شکست مواجه شد']);
        }

    }

    public function Userindex()
    {

        $specialVendors = Auth::user()->vendor->SpecialVendors;

        return view('user.vendor.upgrade.index', compact('specialVendors'));

    }

    public function create()
    {

        return view('user.vendor.upgrade.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'time' => 'required',

        ]);
        $moths = 1 * $request->time;

        if ($request->from) {
            $from = Carbon::parse($request->timeFrom);

        } else {
            $from = Carbon::now();
        }

        $to = Carbon::parse($from)->addMonth($moths);

        $setting = setting::first();
        $databaseTimesInMiddle = SpecialVendors::where('fromDate', '>', $from)
            ->where('toDate', '<', $to)->get();

        $BothOfIputsInMiddle = SpecialVendors::where('fromDate', '<=', $to)
            ->where('fromDate', '<=', $from)
            ->where('toDate', '>=', $to)
            ->where('toDate', '>=', $from)->get();

        $fromDateIsInMiddle = SpecialVendors::where('toDate', "<", $to)
            ->where('toDate', '>', $from)
            ->where('fromDate', "<", $to)
            ->where('fromDate', '<', $from)
            ->get();

        $toDateIsInMiddle = SpecialVendors::where('toDate', ">", $to)->where('fromDate', ">", $from)->where('fromDate', '<', $to)->get();

        $count = count($databaseTimesInMiddle) + count($BothOfIputsInMiddle) + count($fromDateIsInMiddle) + count($toDateIsInMiddle);


        $time_now = Carbon::now();

        $lastCreatedAndActiveNow  =  SpecialVendors::Where('vendor_id', $request->vendor_id )
        ->where('toDate', '>=', $time_now)->first();

        if($lastCreatedAndActiveNow){
            Session()->flash("spcisFullAdd" , " شما قبلا فروشگاه خود  را ویژه کردید ... میتوانید با پشتیبانی تماس بگیرید و  مدت آن را افزایش دهید");
            return redirect()->back();
        }


        
        if ($count >= $setting->SpecialVCount) {

            session()->flash('isFull', 'تعداد اسلایدر ها در بازه زمانی انتخاب شده تکمیل است ، لطفا جهت اطلاع از اولین تاریخ ممکن با پشتیبانی تماس بگیرید');

            return back();

        } else {

            $now = new \DateTime ();

            if ($moths == "1") {

                $pay = self::paymentStatusIn('SpcVPayStatus');

            } elseif ($moths == "3") {

                $pay = self::paymentStatusIn('SpcVPayStatus', 'three');

            } elseif ($moths == "6") {

                $pay = self::paymentStatusIn('SpcVPayStatus', 'six');

            } elseif ($moths == "12") {

                $pay = self::paymentStatusIn('SpcVPayStatus', 'year');

            } else {

                session()->flash('SpcVPayStatus', 'errrrr');
                return back();
            }

            if (self::totalPaymentStatus() && $pay > 0 && self::paymentStatusIn('SpcPPayStatus', null)) {

                $spcV = SpecialVendors::create([
                    'vendor_id' => $request->vendor_id,
                    'fromDate' => $from,
                    'toDate' => $to,
                    'acceptedbyAdmin' => $now,
                ]);

                $des = "ارسال فروشگاه به صفحه اول" . $moths . "ماهه";

                $order = Orders::create([
                    'user_id' => Auth::user()->id,
                    'orderType' => 'specialVendor',
                    'typeId' => $spcV->id,
                    'linkBack' => "user.SpecialVendors.index",
                    'totalAmount' => $pay,
                    "description" => $des,

                ]);

                return redirect()->route('user.payPage', ['id' => $order->id]);

            } else {

                SpecialVendors::create([
                    'vendor_id' => $request->vendor_id,
                    'fromDate' => $from,
                    'paymentStatus'=>'free' ,
                    'toDate' => $to,
                    'acceptedbyAdmin' => $now,
                ]);

                Session()->flash('spcAdd', ' فروشگاه مورد نظر با موفقیت  ویژه شد ');

            }
        }

        Alert::success('فروشگاه شما با موفقیت ویژه شد ', 'باتشکر');

        return redirect()->route('user.SpecialVendors.index');

    }

}
