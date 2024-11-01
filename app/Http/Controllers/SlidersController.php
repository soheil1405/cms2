<?php

namespace App\Http\Controllers;

use App\Models\Admin\SiteSetting;
use App\Models\Orders;
use App\Models\setting;
use App\Models\Sliders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;

class SlidersController extends Controller
{
    // public function AjaxcheckSlider(Request $request)
    // {
    //     $request->validate([
    //     'position_number'=>'required'
    //     ]);

    //     $checkSlider = Sliders::where('position', $request->position_number)->get();

    //     $reservd_now = "کاربر گرامی این جایگاه تا تاریخ ";

    //     $time_now = Carbon::now();

    //     $reserved_for_later = " و همچنین تا تاریخ ";

    //     $res = Carbon::now();

    // //    str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($product->acceptedbyAdmin))

    //     if (count($checkSlider)> 0) {
    //         foreach ($checkSlider as $slider) {
    //             if ($slider->to > $time_now && $slider->from <= $time_now) {
    //                 $reservd_now += Carbon::now()->diffForHumans($slider->to) . "پر است";
    //             }
    //         }

    //         return response()->jon(["massage"=>$reservd_now], 200);
    //     } else {
    //         return response()->json("available", 200);
    //     }
    // }

    // public function sendUserProductSlider(Request $request)
    // {
    //     $request->validate([
    //         'vendor_id'=>'required' ,
    //         'vendorName'=>'required',
    //         'product_id'=>'required' ,

    //         'time'=>'required' ,
    //         'image' =>'required',
    //         'timeFrom'=>'required',
    //         'product_slug'=>'required'
    //     ]);

    //     $image = $request->image;

    //     $fileNameImage = generateFileName($image->getClientOriginalName());

    //     $image->move(public_path(env('SLIDERS_IMAGE_DIRECTORY')), $fileNameImage);

    //     // dd($request->all());

    //     $moths = 1 * ($request->time);

    //     $to =  Carbon::parse($request->timeFrom)->addMonth($moths);

    //     Sliders::create([

    //         'vendor_id'=>$request->vendor_id ,
    //         'vendorName'=>$request->vendorName ,
    //         'product_id'=>$request->product_id ,
    //         'product_slug'=>$request->product_slug ,
    //         'position'=>$request->position ,
    //         'image'=>$fileNameImage ,
    //         'from'=>$request->timeFrom ,
    //         'to'=>$to ,

    //     ]);

    // }

    // public function sendProductToSlierPage($id){

    //     $product = Product::findOrFail($id);

    //     return view('user.products.slider.create' , compact('product'));

    // }

    public function vendorSliedrPage()
    {



        return view('user.vendorSlider.index');
    }

    public function sendVendorSlider(Request $request)
    {

        $request->validate([
            'vendor_id' => 'required',
            'vendorName' => 'required',
            'time' => 'required',
            'image' => 'required',
            'captcha'=> 'required|captcha'

        ]);




        $moths = 1 * $request->time;





        if ($request->timeFrom) {

            $from = Carbon::parse($request->timeFrom);


        } else {
            $from = Carbon::now();
        }



        $to = Carbon::parse($from)->addMonth($moths);






        $setting = setting::first();




        $now = new \DateTime();




        $oneMonthLater = $from->addMonth(1);

        $isFullWhereTimeFrom = Sliders::where('from', $from)
            ->get();

        $isFullWhereTimeTo = Sliders::where('to', $to)
            ->get();

        if (count($isFullWhereTimeFrom) > $setting->sliderCount) {


            session()->flash('isFull', 'تعداد اسلایدر ها در بازه زمانی انتخاب شده تکمیل است ، لطفا جهت اطلاع از اولین تاریخ ممکن با پشتیبانی تماس بگیرید');
            return redirect()->back();

        }

        if (count($isFullWhereTimeTo) > $setting->sliderCount) {

            session()->flash('isFull', 'تعداد اسلایدر ها در بازه زمانی انتخاب شده تکمیل است ، لطفا جهت اطلاع از اولین تاریخ ممکن با پشتیبانی تماس بگیرید');
            return redirect()->back();

        }

        $databaseTimesInMiddle = Sliders::where('from', '>', $from)
            ->where('to', '<', $to)->get();

        $BothOfIputsInMiddle = Sliders::where('from', '<=', $to)
            ->where('from', '<=', $from)
            ->where('to', '>=', $to)
            ->where('to', '>=', $from)->get();

        $fromDateIsInMiddle = Sliders::where('to', "<", $to)
            ->where('to', '>', $from)
            ->where('from', "<", $to)
            ->where('from', '<', $from)
            ->get();

        $toDateIsInMiddle = Sliders::where('to', ">", $to)->where('from', ">", $from)->where('from', '<', $to)->get();

        $count = count($databaseTimesInMiddle) + count($BothOfIputsInMiddle) + count($fromDateIsInMiddle) + count($toDateIsInMiddle);

        if ($count >= $setting->sliderCount) {


            session()->flash('isFull', 'تعداد اسلایدر ها در بازه زمانی انتخاب شده تکمیل است ، لطفا جهت اطلاع از اولین تاریخ ممکن با پشتیبانی تماس بگیرید');
            return redirect()->back();
        } else {
            $image = $request->image;

            $fileNameImage = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('SLIDERS_IMAGE_DIRECTORY')), $fileNameImage);
            if ($request->timeFrom) {

                $from = Carbon::parse($request->timeFrom);


            } else {
                $from = Carbon::now();
            }


            $paymentSetting = SiteSetting::first();





















            $slider = Sliders::create([
                'vendor_id' => $request->vendor_id,
                'vendorName' => $request->vendorName,
                'image' => $fileNameImage,
                'from' => $from,
                'to' => $to,

            ]);



            if ($moths == "1") {

                $pay = self::paymentStatusIn('SliderPayStatus');
                
            } elseif ($moths == "3") {

                $pay = self::paymentStatusIn('SliderPayStatus', 'three');

            } elseif ($moths == "6") {

                $pay = self::paymentStatusIn('SliderPayStatus', 'six');

            } elseif ($moths == "12") {

                $pay = self::paymentStatusIn('SliderPayStatus', 'year');

            } else {

                session()->flash('sliderCreated', 'errrrr');
                return back();
            }


            
            if ($paymentSetting->SliderPayStatus && $paymentSetting->paymentStatus && $pay > 0) {


                
                $slider->update([
                    'paymentStatus' => 'inPaymentQueue'
                ]);

                $order = Orders::create([

                    'user_id' => Auth::user()->id,
                    'orderType' => 'slider',
                    'typeId' => $slider->id,
                    'linkBack' => "user.mysliders",
                    'totalAmount' => $pay,

                ]);

                return redirect()->route('user.payPage', ['id' => $order->id]);


            } else {

                
                $slider->update([
                    'paymentStatus' => 'free'
                ]);
            }

            
            // session()->flash('sliderCreated', 'اسلایدر شما با موفقیت ثبت شد و پس از تایید نهایی منتشر خواهد شد');

            Alert::success('اسلایدر شما با موفقیت ثبت شد و پس از تایید نهایی منتشر خواهد شد!', 'باتشکر');



            return redirect()->route('user.mysliders');
        }

    }

    public function mySliders()
    {





        $vendorSliders = Auth::user()->vendor->mySliders;
        return view('user.sliders.index', compact('vendorSliders'));
    }

    public function vendorSliedrEditPage($id)
    {
        $vendorSlider = Sliders::findOrFail($id);

        return view('user.vendorSlider.edit', compact('vendorSlider'));
    }

    public function editVendorSlider(Request $request)
    {

        $request->validate([
            'slider_id' => 'required',
        ]);

        $slider = Sliders::findOrFail($request->slider_id);

        if ($request->image) {
            $request->validate([
                'image' => 'mimes :jpg,png,jpeg',
            ]);

            $image = $request->image;

            $fileNameImage = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('SLIDERS_IMAGE_DIRECTORY')), $fileNameImage);

            $slider->update([
                'image' => $fileNameImage,
                'acceptedbyAdmin' => null,
            ]);
        }

        session()->flash('sliderCreated', 'اسلایذر شما با موفقیت ویرایش شد و پس از تایید نهایی منتشر خواهد شد');

        return redirect()->route('user.mysliders');

    }

    public function DeleteSlider(Request $request)
    {

        $request->validate([

            'id' => 'required',
        ]);

        $slider = Sliders::findOrFail($request->id);

        $slider->delete();

        Alert::success('اسلایدر مورد نظر حذف شد', 'باتشکر');

        return redirect()->route('user.mysliders');

    }

}