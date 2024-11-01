<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\SpecialProducts;
use App\Models\Orders;
use App\Models\Product;
use App\Models\setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SpecialProductsController extends Controller
{
    public function index()
    {
        $specialProducts = Auth::user()->vendor->SpeciallProducts;

        return view('user.products.AddProduct.index', compact('specialProducts'));
    }

    public function create(  $id)
    {
        $now = new \DateTime('today');

        $AllActiveSpeciaProducts = SpecialProducts::where('fromDate', '<', $now)
            ->where('toDate', '>=', $now)
            ->get();

        $time_now = Carbon::now();
        
        
        $setting = setting::first();
        
        if (count($AllActiveSpeciaProducts) > $setting->SpecialPcount) {
            Session()->flash("tekrari" , "ظرفیت محصولات ویژه پر شده ... لطفا جهت ارسال محصول خود ب قسمت محصولات ویژه با پشتیبانی تماس بگیرید");
        
            return view('user.products.AddProduct.isFullNow');
            }
            
        $product = Product::findOrFail($id);
        
        $time_now = Carbon::now();

        $lastCreatedAndActiveNow  =  SpecialProducts::Where('vendor_id', $product->vendor_id )
        ->where('toDate', '>=', $time_now)->where("product_id" , $id)->first();

        if($lastCreatedAndActiveNow){
            Session()->flash("tekrari" , "شما قبلا محصول خود  را ویژه کردید ... میتوانید با تماس با پشتیبانی اینستابرق مدت آن را افزایش دهید");
            return redirect()->back();
        }



        return view('user.products.AddProduct.create', compact('product'));
    }

    public function MakeProductSpecial(Request $request)
    {

        $request->validate([
            'product_id' => 'required|numeric',

            'time' => 'required',
        ]);



        // try {

        $product = Product::find($request->product_id);

        $moths = 1 * $request->time;


        if ($request->from) {
            $from = Carbon::parse($request->from);

        } else {
            $from = Carbon::now();

        }



        $to = Carbon::parse($from)->addMonth($moths);
        $setting = setting::first();

        // $oneMonthLater = $from->addMonth(1);

        $isFullWhereTimeFrom = SpecialProducts::where('fromDate', $from)
            ->get();

        $isFullWhereTimeTo = SpecialProducts::where('toDate', $to)
            ->get();

        if (count($isFullWhereTimeFrom) > $setting->SpecialPcount) {

            return view('user.products.AddProduct.isFullNow');
        }

        if (count($isFullWhereTimeTo) > $setting->SpecialPcount) {

            return view('user.products.AddProduct.isFullNow');
        }

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

        $toDateIsInMiddle = SpecialProducts::where('toDate', ">", $to)
            ->where('fromDate', ">", $from)
            ->where('fromDate', '<', $to)
            ->get();

        $count = count($databaseTimesInMiddle) + count($BothOfIputsInMiddle) + count($fromDateIsInMiddle) + count($toDateIsInMiddle);

        if ($count >= $setting->SpecialPcount) {

            return view('user.products.AddProduct.isFullNow');

        } else {

            $now = new \DateTime();


            if ($moths == "1") {

                $pay = self::paymentStatusIn('SpcPPayStatus');
                
            } elseif ($moths == "3") {

                $pay = self::paymentStatusIn('SpcPPayStatus', 'three');

            } elseif ($moths == "6") {

                $pay = self::paymentStatusIn('SpcPPayStatus', 'six');

            } elseif ($moths == "12") {

                $pay = self::paymentStatusIn('SpcPPayStatus', 'year');

            } else {

                session()->flash('sliderCreated', 'errrrr');
                return back();
            }

            if (self::totalPaymentStatus() && $pay > 0 &&  self::paymentStatusIn('SpcPPayStatus' , null) ) {


               $spcP =  SpecialProducts::create([
                    'vendor_id' => $product->vendor_id,
                    'product_id' => $request->product_id,
                    'fromDate' => $from,
                    'toDate' => $to,
                    'acceptedbyAdmin' => $now,
                    'paymentStatus' => "inPaymentQueue",
                ]);

                $des = "ارسال محصول".$product->name." به صفحه اول " . $moths . "ماهه";

                $order = Orders::create([
                    'user_id'=>Auth::user()->id ,
                    'orderType'=>'specialProduct' , 
                    'typeId'=>$spcP->id ,
                    'linkBack'=>"user.upgradeproduct.index" ,
                    'totalAmount'=>$pay ,
                    "description" =>$des

                ]);

                return redirect()->route('user.payPage' , ['id'=>$order->id]);


            } else {

                SpecialProducts::create([
                    'vendor_id' => $product->vendor_id,
                    'product_id' => $request->product_id,
                    'fromDate' => $from,
                    'toDate' => $to,
                    'acceptedbyAdmin' => $now,
                    'paymentStatus' => "free",
                ]);



                Alert::success('محصول مورد نظر با موفقیت ویژه شد ', 'باتشکر');
                return redirect()->route('user.upgradeproduct.index');
            }



        }

        // } catch (\Throwable$th) {
        //     Alert::success('اشتیباه در درج اطلاعات', 'باتشکر');
        //     return redirect()->route('user.upgradeproduct.index');
        // }

    }

    public function get_available($count)
    {
        $time_now = Carbon::now();

        return SpecialProducts::whereNotNull('acceptedbyAdmin')
            ->where('fromDate', '<=', $time_now)
            ->where('toDate', '>=', $time_now)
            ->limit($count)
            ->get();
    }

    public function getAll()
    {
        $speciallProducts = SpecialProducts::latest()->get();

        return view('admin.products.speciallityProducts', compact('speciallProducts'));
    }

    public function EditProductSpecial(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'from' => 'required',
            'to' => 'required',
            'position' => 'required|min:1|max:12',
        ]);

        try {
            $product = SpecialProducts::where('id', $request->product_id)->first();

            //  dd($product->id);

            $product->update([
                'fromDate' => $request->from,
                'toDate' => $request->to,
                'position' => $request->position,
            ]);

            return redirect()->route('admin.speciallityProducts');
        } catch (Exception $e) {
            return redirect()
                ->route('admin.products.index')
                ->with(['errors' => 'عملیات با شکست مواجه شد']);
        }
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
            return redirect()
                ->route('admin.products.index')
                ->with(['errors' => 'عملیات با شکست مواجه شد']);
        }
    }
}