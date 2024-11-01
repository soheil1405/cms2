<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryArticle;
use App\Models\Admin\Setting;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


class SlidersController extends Controller
{

    public function AjaxcheckSlider(Request $request)
    {

        $request->validate([
            'position_number' => 'required',
        ]);

        $checkSlider = Sliders::where('position', $request->position_number)->get();

        $reservd_now = "کاربر گرامی این جایگاه تا تاریخ ";

        $time_now = Carbon::now();

        $reserved_for_later = " و همچنین تا تاریخ ";

        $res = Carbon::now();

        //    str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($product->acceptedbyAdmin))

        if (count($checkSlider) > 0) {
            foreach ($checkSlider as $slider) {
                if ($slider->to > $time_now && $slider->from <= $time_now) {

                    $reservd_now += Carbon::now()->diffForHumans($slider->to) . "پر است";

                }

            }

            return response()->jon(["massage" => $reservd_now], 200);

        } else {

            return response()->json("available", 200);

        }

    }

    public function sendUserProductSlider(Request $request)
    {

        $request->validate([

            'vendorName' => 'required',
            'product_id' => 'required',
            'position' => 'required',
            'time' => 'required',
            'image' => 'required',
            'timeFrom' => 'required',

        ]);

        $image = $request->image;

        $fileNameImage = generateFileName($image->getClientOriginalName());

        $image->move(public_path(env('SLIDERS_IMAGE_DIRECTORY')), $fileNameImage);

        // dd($request->all());

        $moths = 1 * ($request->time);

        $to = Carbon::parse($request->timeFrom)->addMonth($moths);

        Sliders::create([

            'vendorName' => $request->vendorName,
            'product_id' => $request->product_id,
            'position' => $request->position,
            'image' => $fileNameImage,
            'from' => $request->timeFrom,
            'to' => $to,

        ]);

    }

    public function index(Request $request)
    {

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

            $sliders = [];

            // dd($to);
            $time_now = Carbon::now();

            // dd($request->all());
            switch ($showBy) {
                case 'all':

                    if (!is_null($request->from) || !is_null($request->to)) {
                        $databaseTimesInMiddle = Sliders::where('from', '>', $from)
                            ->where('to', '<', $to)->get();

                        $BothOfIputsInMiddle = Sliders::where('from', '<=', $to)
                            ->where('from', '<=', $from)
                            ->where('to', '>=', $to)
                            ->where('to', '>=', $from)->get();

                        $fromIsInMiddle = Sliders::where('to', "<", $to)
                            ->where('to', '>', $from)
                            ->where('from', "<", $to)
                            ->where('from', '<', $from)
                            ->get();

                        $toIsInMiddle = Sliders::where('to', ">", $to)->where('from', ">", $from)->where('from', '<', $to)->get();
                        //ok
                        foreach ($databaseTimesInMiddle as $item) {
                            array_push($sliders, $item);
                        }

                        foreach ($BothOfIputsInMiddle as $item) {
                            array_push($sliders, $item);
                        }

                        foreach ($fromIsInMiddle as $item) {
                            array_push($sliders, $item);
                        }

                        foreach ($toIsInMiddle as $item) {
                            array_push($sliders, $item);
                        }
                    } else {

                        $sliders = Sliders::orderByDesc('id')->get();
                    }

                    break;
                case 'actives':

                    $sliders = Sliders::where('from', '<=', $time_now)->where('to', '>=', $time_now)->where('status' , '>' , 0)->get();

                    break;
                case 'inQueue':

                    $sliders = Sliders::where('from', '>', $time_now)->where('to', '>', $time_now)->get();

                    break;
                case 'Ended':

                    $sliders = Sliders::where('from', '<', $time_now)->where('to', '<', $time_now)->get();

                    break;
                case 'Repored':

                    $sliders = Sliders::where('status' , 0)->get();

                    break;

                default:
                    # code...
                    break;
            }

        } else {
            $sliders = Sliders::OrderBy('acceptedByAdmin')->get();

        }

        $setting = Setting::first();

        $slider_in_Queue = Sliders::whereNull('acceptedByAdmin')->where('paymentStatus' , '!=' , 'inPaymentQueue')->get();

        $count_of_slider_in_Queue = count($slider_in_Queue);

        $HomeSlidersCount = $setting->sliderCount;

        
        if ($request->excelExport) {

            ob_end_clean();
            ob_start();

            
            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($sliders , 'sliders'), 'instabargh.sliders' . now() . '.xlsx');

        }



        // $adminSliders = Sliders::where('sendBy' , 'admin')->get();

        // foreach ($adminSliders as $s) {
        //     $s->update([
        //         'paymentStatus' => 'free' 
        //     ]);

        // }
        return view('admin.sliders.index', compact('count_of_slider_in_Queue', 'sliders', 'HomeSlidersCount'));

    }

    public function create()
    {

        $articles = CategoryArticle::all();

        $products = Product::where('status' , 'yes')->get();

        $vendors = Vendor::where('adminVendor' , 'no')->get();

        return view('admin.sliders.create', compact('articles', 'products', 'vendors'));
    }

    public function store(Request $request)
    {


        // dd($request->all());

        $request->validate([

            'SliderType' => 'required',
            'image' => 'required',
            'image' => 'required',
            'time' => 'required',

        ]);


        if($request->timeFrom){
            $from = Carbon::parse($request->timeFrom);
        }else{
            $from = Carbon::now();
            
        }


        $sliderType = $request->SliderType;


        $moths = 1 * ($request->time);

        $to = Carbon::parse($from)->addMonth($moths);

        

        $image = $request->image;

        $fileNameImage = generateFileName($image->getClientOriginalName());

        $image->move(public_path(env('SLIDERS_IMAGE_DIRECTORY')), $fileNameImage);

        switch ($sliderType) {
            case 'a':

                $request->validate([

                    'article_id' => 'required',

                ]);

                $slider = Sliders::create([

                    'article_id' => $request->article_id,
                    'sendBy' => 'admin',
                    'image' => $fileNameImage,
                    'from' => $from,
                    'to' => $to,
                    'paymentStatus' => 'free' ,
                    'acceptedByAdmin' => Carbon::now(),
                ]);

                break;
            case 'p':
                $request->validate([

                    'product_id' => 'required',

                ]);

                $product = Product::findOrFail($request->product_id);

                $vendorName = $product->vendor->name;

                $slider = Sliders::create([

                    'product_id' => $request->product_id,
                    'sendBy' => 'admin',
                    'vendorName' => $vendorName,
                    'product_slug' => $product->slug,
                    'image' => $fileNameImage,
                    'from' =>  $from,
                    'to' => $to,
                    'paymentStatus' => 'free' ,

                    'acceptedByAdmin' => Carbon::now(),
                ]);

                break;
            case 'v':
                $request->validate([
                    'vendor_id' => 'required',
                ]);

                $vendor = Vendor::findOrFail($request->vendor_id);

                

                $slider = Sliders::create([

                    'vendor_id' => $request->vendor_id,
                    'sendBy' => 'admin',
                    'vendorName' => $vendor->name,
                    'image' => $fileNameImage,
                    'from' =>  $from,
                    'paymentStatus' => 'free' ,

                    'to' => $to,
                    'acceptedByAdmin' => Carbon::now(),
                ]);
                break;
            case 'O':
                $request->validate([
                    'link' => 'required',
                ]);

                $slider = Sliders::create([
                    'sendBy' => 'admin',
                    'otherWayLinks' => $request->link,
                    'image' => $fileNameImage,
                    'from' =>  $from,
                    'to' => $to,
                    'paymentStatus' => 'free' ,

                    'acceptedByAdmin' => Carbon::now(),
                ]);

                break;

            default:

                session()->flash('incorrect', 'مشکل در داده های ورودی');
                return redirect()->back();

                break;
        }

        session()->flash('created', 'اسلایدر جدید با موفقیت ذخیره شد');
        return redirect()->route('admin.sliderss.index');

    }

    public function accept(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $slider = Sliders::findOrFail($request->id);

        $slider->update([
            'acceptedByAdmin' => Carbon::now(),
        ]);

        session()->flash('created', 'اسلایدر مورد نظر با موفقیت تایید شد');
        return redirect()->route('admin.sliderss.index');

    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $slider = Sliders::findOrFail($request->id);

        $slider->delete();

        session()->flash('created', 'اسلایدر مورد نظر با موفقیت حذف شد');
        return redirect()->route('admin.sliderss.index');
    }

    public function edit($id)
    {

        $slider = Sliders::findOrFail($id);

        dd($slider);

    }

    public function report($id)
    {
        $slider = Sliders::findOrFail($id);

        return view('admin.sliders.ReportSlider', compact('slider'));

    }

}
