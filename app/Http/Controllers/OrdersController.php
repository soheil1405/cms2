<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Admin\SpecialProducts;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\User;
use Excel;
use App\Models\story;
use App\Models\UserOfferCodes;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Carbon\Carbon;
use App\Exports\ExportPdf;



class OrdersController extends Controller
{
    public function index(Request $request)
    {

        $user= Auth::user();
        $orders = Auth::user()->orders()->paginate(20);

        // dd($orders);


        
        if(is_null($user->boss_id)){
            
            $userIds = [];

            foreach ($user->AllEmployers as $useerr) {
               
                array_push($userIds , $useerr->id);
                


            }


            array_push($userIds , $user->id);

            $orders = Orders::whereIn('user_id' , $userIds)->latest()->paginate(30);




            


        }
         
        

      
        
        
        
        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {

        $order = Orders::findOrFail($id);

        $idpayResult = json_decode($order->idpayResult, true);
        return view('user.orders.pdf', compact('order', 'idpayResult'));


    }

    public function increaseCredit(Request $request)
    {




        $request->validate([

            'amount' => "required|numeric|min:250000",
            "type" => "required",
        ]);

        if ($request->type != "increaseCreadit") {
            session()->flash('failed', 'khodeti');
            return redirect()->route('user.orders.index');
        }



        $order = Orders::create([

            'user_id' => Auth::user()->id,
            'orderType' => 'increaseCredit',
            'description' => $request->desc,
            'totalAmount' => $request->amount,
            
        ]);



        $createPaymentReq = self::pay($order->id, $request->amount, Auth::User()->name, Auth::user()->mobile, $request->desc, route('user.orders.response'));


        $data = get_object_vars(json_decode($createPaymentReq));



        $link = $data['link'];

        return view('user.orders.finalStepOrder', compact('link', 'order'));


    }










    public function response(Request $request)
    {


        $id = $request->id;
        $order = Orders::findOrFail($request->order_id);

        $do = null;

        if ($request->status == "10") {

            $params = array(
                'id' => $id,
                'order_id' => $order->id,
            );

            $json = self::PayVerify($params);

            $result = get_object_vars(json_decode($json));

            $status = $result['status'];




            switch ($status) {
                case 1:
                    $msg = 'پرداخت انجام نشده است.  ';
                    break;
                case 2:
                    $msg = 'پرداخت ناموفق بوده است.';
                    break;
                case 3:
                    $msg = 'خطا رخ داده است.';
                    break;
                case 4:
                    $msg = 'بلوکه شده.';
                    break;
                case 5:
                    $msg = 'برگشت به پرداخت کننده.';
                    break;
                case 6:
                    $msg = 'برگشت خورده سیستمی.';
                    break;
                case 7:
                    $msg = 'انصراف از پرداخت.';
                    break;
                case 8:
                    $msg = 'به درگاه پرداخت منتقل شد.';
                    break;
                case 10:
                    $msg = 'در انتظار تایید پرداخت.';
                    break;
                case 100:
                    $msg = 'پرداخت تایید شده است.';
                    break;
                case 101:
                    $msg = 'پرداخت قبلا تایید شده است.';
                    break;

                case 200:
                    $msg = 'به دریافت کننده واریز شد.';
                    break;
                case 405:
                    $msg = 'تایید پرداخت امکان پذیر نیست.';
                    break;
                default:
                    $msg = "!!!!!!!!!!!";
                    break;
            }






            $order->update([
                'persianStatus' => $msg,
                'track_id' => $request->track_id,
                'idFromIdpay' => $request->id,
                'idpayStatus' => $status,
                'idpayResult' => $json,
            ]);







            if ($order->orderType == "increaseCredit") {
                $user = $order->user;
                $userCREDIT = $user->CREDIT + $order->totalAmount;


                $user->update([
                    'CREDIT' => $userCREDIT
                ]);
                $do = "کیف پول شما شارژ شد";
                Alert::success('موفق', 'پرداخت با موفقیت انجام شد')->showConfirmbutton('تایید');

            } elseif ($order->orderType == "story") {
                $story = story::findOrFail($order->typeId);
                $story->update([
                    'paymentStatus' => 'payed',
                ]);
                $do = "استوری مورد نظر با موفقیت منتشر شد";
                Alert::success('موفق', 'پرداخت با موفقیت انجام شد')->showConfirmbutton('تایید');

            } elseif ($order->orderType == "slider") {
                $slider = Sliders::findOrFail($order->typeId);
                $slider->update([
                    'paymentStatus' => 'payed',
                ]);
                $do = "استوری مورد نظر با موفقیت منتشر شد";
                Alert::success('موفق', 'پرداخت با موفقیت انجام شد')->showConfirmbutton('تایید');
            } elseif ($order->orderType == "ladderPPay") {

                $product = Product::findOrFail($order->typeId);

                $mytime = Carbon::now();

                $time = $mytime->toDateTimeString();


                $product->update([
                    'ladder_product' => $time,
                ]);

                $spc = SpecialProducts::where('product_id', $product->id)->first();


                if (!is_null($spc)) {
                    $spc->update([

                        'ladder_product' => $time

                    ]);
                }

                Alert::success('موفق', 'محصول  ' . $product->name . 'نردبان شد')->showConfirmbutton('تایید');

            } elseif ($order->orderType == "ladderVPay") {

                $vendor = Vendor::findOrFail($order->typeId);

                $vendor->update([

                    'laddered_at' => Carbon::now()
                ]);

                alert()->success('  فروشگاه شما با موفقیت نردبان شد  ', 'باتشکر');

            }


            if(!is_null($order->offerCode_id)){

                $offeredAmount = $order->totalAmount - $order->amountAfterOffer;



                $userOffer = UserOfferCodes::create([

                    'user_id'=>Auth::user()->id ,
                    'code_id'=>$order->offerCode_id ,
                    'mainAmount'=>$order->totalAmount , 
                    'offeredAmount'=>$offeredAmount ,
                    'finalAmount'=>$order->amountAfterOffer ,
                
                ]);

            }












        } else {


            $status = $request->status;



            switch ($status) {
                case 1:
                    $msg = 'پرداخت انجام نشده است.  ';
                    break;
                case 2:
                    $msg = 'پرداخت ناموفق بوده است.';
                    break;
                case 3:
                    $msg = 'خطا رخ داده است.';
                    break;
                case 4:
                    $msg = 'بلوکه شده.';
                    break;
                case 5:
                    $msg = 'برگشت به پرداخت کننده.';
                    break;
                case 6:
                    $msg = 'برگشت خورده سیستمی.';
                    break;
                case 7:
                    $msg = 'انصراف از پرداخت.';
                    break;
                case 8:
                    $msg = 'به درگاه پرداخت منتقل شد.';
                    break;
                case 10:
                    $msg = 'در انتظار تایید پرداخت.';
                    break;
                case 100:
                    $msg = 'پرداخت تایید شده است.';
                    break;
                case 101:
                    $msg = 'پرداخت قبلا تایید شده است.';
                    break;

                case 200:
                    $msg = 'به دریافت کننده واریز شد.';
                    break;
                case 405:
                    $msg = 'تایید پرداخت امکان پذیر نیست.';
                    break;
                default:
                    $msg = "!!!!!!!!!!!";
                    break;
            }


            $json = null;

            $order->update([
                'persianStatus' => $msg,
                'track_id' => $request->track_id,
                'idFromIdpay' => $request->id,
                'idpayStatus' => $request->status,
                // 'idpayResult'=>$request->all ,
            ]);



            Alert::error('ناموفق', 'عملیات پرداخت با شکست مواحه شد')->showConfirmbutton('تایید');


        }










        if ($order->orderType == "increaseCredit") {

            return redirect()->route('user.orders.index');

        } else {

            return redirect()->route($order->linkBack);

        }

    }



    public function exportOrdersAsExcell(Request $request){
        

        $orders = Orders::all();


        $orders.excell;


    }



    public function pdf($id)
    {


        $order = Orders::findOrFail($id);
        $idpayResult = json_decode($order->idpayResult, true);

        
        
        // $pdf = PDF::loadView('user.orders.convertPdf', compact('order', 'idpayResult'))->setOptions(['defaultFont' => 'sans-serif']) ;
     
     
     
        $data = [
            'idpayResult' => $idpayResult ,
            'totalAmount'=>$order->totalAmount , 
            'description'=>$order->description ,
            'typeId'=>$order->typeId ,
            "id"=>$order->id ,
        ];
// 
// 
// 
        // $pdf = PDF::loadView('user.orders.convertPdf', $data);
        // return $pdf->stream('order.pdf');
        // 
        // 
        // 
        // 
// 
// return $pdf->stream("order.pdf");
// 
// $pdf = app('dompdf.wrapper');
        
        // $pdf = PDF::loadView('user.orders.convertPdf', $data);
        // $fileName = $report->issue_number;
        // return $pdf->stream($fileName.'.pdf');
    // 
    // 

        
    

    ob_end_clean();
    ob_start();

    return Excel::download(new ExportPdf('user.orders.convertPdf' , $data), 'order' . now() . '.pdf');



    // return view('user.orders.convertPdf', $data);

    }





    public function SummaryOfOrders(){


        $user = Auth::user();

        $vendor = $user->vendor;

        $userIds = [];

        if(is_null($user->boss_id)){
          return    $this->sendSummenyToVendor($user->id);
        }else{

       
           return $this->sendSummeryToUser($user->id);
        }
    }







    function sendSummenyToVendor($id){
     
        
     


        $user = User::findOrFail($id);
        $vendor = $user->vendor;
        $products = Product::where('vendor_id', $vendor->id)->get();
        $users = $vendor->user->AllEmployers;
        $usersId = [];
        $usersCreditCount = 0;
        foreach ($users as $user) {
            array_push($usersId, $user->id);
            $usersCreditCount +=$user->CREDIT ;
        }
        $user = $vendor->user;
        $today = Carbon::today();
        $subMonth = Carbon::today()->subMonth()->format('Y-m-d');
        $subDay = Carbon::today()->subDay()->format('Y-m-d');
        $subWeek = Carbon::today()->subWeek()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $EmployeelastMonthOrdersFinalPays = 0;
        $EmployeelastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();
        
        $EmployeelastWeekOrdersFinalPays = 0;
        $EmployeelastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();
        $EmployeelastDayOrdersFinalPays = 0;
        $EmployeelastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();
        $EmployeetotalFinalPays = 0;
        $Employeetotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->get();
        //
        foreach ($EmployeelastMonthOrders as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalPays += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastWeekOrders as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalPays += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrders as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalPays += $item->totalAmount;
            }
        }
        //
        foreach ($Employeetotal as $item) {
            if ($item->amountAfterOffer) {
                $EmployeetotalFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalPays += $item->totalAmount;
            }
        }
        $UserLastMonthOrdersFinal = 0;
        $UserLastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();
        $UserLastWeekOrdersFinal = 0;
        $UserLastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();
        $UserLastDayOrdersFinal = 0;
        $UserLastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();
        $UserTotalFinal = 0;
        $UserTotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->get();
        //
        foreach ($UserLastMonthOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinal += $item->totalAmount;
            }
        }
        foreach ($UserTotal as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinal += $item->amountAfterOffer;
            } else {
                $UserTotalFinal += $item->totalAmount;
            }
        }
        
        $EmployeelastMonthOrdersFinalIncreaseCredit = 0;
        $EmployeelastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();
        $EmployeelastWeekOrdersFinalIncreaseCredit = 0;
        $EmployeelastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();
        $EmployeelastDayOrdersFinalIncreaseCredit = 0;
        $EmployeelastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();
        $EmployeetotalFinalIncreaseCredit = 0;
        $EmployeetotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType" , 'increaseCredit' )->whereIn('user_id', $usersId)->get();
        //
        foreach ($EmployeelastMonthOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastWeekOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeetotalIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeetotalFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalIncreaseCredit += $item->totalAmount;
            }
        }
        $UserLastMonthOrdersFinalIncreaseCredit = 0;
        $UserLastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();
        $UserLastWeekOrdersFinalIncreaseCredit = 0;
        $UserLastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();
        $UserLastDayOrdersFinalIncreaseCredit = 0;
        $UserLastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();
        $UserTotalFinalIncreaseCredit = 0;
        $UserTotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->get();
        //
        foreach ($UserLastMonthOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
            } else {
                $UserLastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        foreach ($UserTotalIncreaseCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalIncreaseCredit += $item->totalAmount;
            }
        }
        $EmployeelastMonthOrdersFinalPaysParFromCredit = 0;
        $EmployeelastMonthOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();
        $EmployeelastWeekOrdersFinalPaysParFromCredit = 0;
        $EmployeelastWeekOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();
        $EmployeelastDayOrdersFinalPaysParFromCredit = 0;
        $EmployeelastDayOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();
        $EmployeetotalFinalPaysParFromCredit = 0;
        $EmployeetotalParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->whereIn('user_id', $usersId)->get();
        //
        foreach ($EmployeelastMonthOrdersParFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastWeekOrdersParFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrdersParFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeetotalParFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $EmployeetotalFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        $UserLastMonthOrdersFinalPayFromCredit = 0;
        $UserLastMonthOrdersPayFromCredit = Orders::where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();
        $UserLastWeekOrdersFinalPayFromCredit = 0;
        $UserLastWeekOrdersPayFromCredit = Orders::where('status' ,  'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();
        $UserLastDayOrdersFinalPayFromCredit = 0;
        $UserLastDayOrdersPayFromCredit = Orders::where('status' ,  'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();
        $UserTotalFinalPayFromCredit = 0;
        $UserTotalPayFromCredit = Orders::where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->get();
        //
        foreach ($UserLastMonthOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        foreach ($UserTotalPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalPayFromCredit += $item->totalAmount;
            }
        }
        ///
        $vendorTotalPayTillNow  = $UserTotalFinal + $EmployeetotalFinalPays + $UserTotalFinalIncreaseCredit + $EmployeetotalFinalIncreaseCredit;
        
     
        
        
        return view('user.vendor.showDetail', compact(
            'vendor',
            'products',
            //////
            'UserTotal',
            'UserTotalFinal',
            'UserLastDayOrders',
            'UserLastDayOrdersFinal',
            'UserLastDayOrders',
            'UserLastWeekOrdersFinal',
            'UserLastMonthOrders',
            'UserLastMonthOrdersFinal',
            
            
            'Employeetotal',
            'EmployeetotalFinalPays',
            'EmployeelastDayOrders',
            'EmployeelastDayOrdersFinalPays',
            'EmployeelastWeekOrders',
            'EmployeelastWeekOrdersFinalPays',
            'EmployeelastMonthOrders',
            'EmployeelastMonthOrdersFinalPays' ,
            
            ///////
            'EmployeelastMonthOrdersFinalIncreaseCredit' ,
            'EmployeelastMonthOrdersIncreaseCredit' ,
            'EmployeelastWeekOrdersFinalIncreaseCredit' ,
            'EmployeelastWeekOrdersIncreaseCredit' ,
            'EmployeelastDayOrdersFinalIncreaseCredit' ,
            'EmployeelastDayOrdersIncreaseCredit' ,
            'EmployeetotalFinalIncreaseCredit' ,
            'EmployeetotalIncreaseCredit' ,
            'UserLastMonthOrdersFinalIncreaseCredit' ,
            'UserLastMonthOrdersIncreaseCredit' ,
            'UserLastWeekOrdersIncreaseCredit' ,
            'UserLastWeekOrdersFinalIncreaseCredit' ,
            'UserLastDayOrdersIncreaseCredit' ,
            'UserLastDayOrdersFinalIncreaseCredit' ,
            'UserTotalFinalIncreaseCredit' ,
            'UserTotalIncreaseCredit' ,
            ////////
            'EmployeelastMonthOrdersFinalPaysParFromCredit' ,
            'EmployeelastMonthOrdersParFromCredit' ,
            'EmployeelastWeekOrdersFinalPaysParFromCredit' ,
            'EmployeelastWeekOrdersParFromCredit' ,
            'EmployeelastDayOrdersFinalPaysParFromCredit' ,
            'EmployeelastDayOrdersParFromCredit' ,
            'EmployeetotalFinalPaysParFromCredit' ,
            'EmployeetotalParFromCredit' ,
            'UserLastMonthOrdersFinalPayFromCredit' ,
            'UserLastMonthOrdersPayFromCredit' ,
            'UserLastWeekOrdersFinalPayFromCredit' ,
            'UserLastWeekOrdersPayFromCredit' ,
            'UserLastDayOrdersFinalPayFromCredit' ,
            'UserLastDayOrdersPayFromCredit' ,
            'UserTotalFinalPayFromCredit' ,
            'UserTotalPayFromCredit' ,
                ////
            'vendorTotalPayTillNow',
            'usersCreditCount' ,
        )
        );
    }







    function sendSummeryToUser($id){


        $user = User::findOrFail($id);





        
        $today = Carbon::today();

        $products = $user->products;



        $subMonth = Carbon::today()->subMonth()->format('Y-m-d');

        $subDay = Carbon::today()->subDay()->format('Y-m-d');
        $subWeek = Carbon::today()->subWeek()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');



        $UserLastMonthOrdersFinal = 0;
        $UserLastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinal = 0;
        $UserLastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinal = 0;
        $UserLastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinal = 0;
        $UserTotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status' , "!=" , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->get();

        $UserLastMonthOrdersFinalPayFromCredit = 0;
        $UserLastMonthOrdersPayFromCredit = Orders::where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalPayFromCredit = 0;
        $UserLastWeekOrdersPayFromCredit = Orders::where('status' ,  'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalPayFromCredit = 0;
        $UserLastDayOrdersPayFromCredit = Orders::where('status' ,  'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalPayFromCredit = 0;
        $UserTotalPayFromCredit = Orders::where('status' , 'CREDIT')->where("orderType", "!=" , 'increaseCredit' )->where('user_id', $user->id)->get();






        $UserLastMonthOrdersFinalIncreaseCredit = 0;
        $UserLastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalIncreaseCredit = 0;
        $UserLastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalIncreaseCredit = 0;
        $UserLastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalIncreaseCredit = 0;
        $UserTotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit' )->where('user_id', $user->id)->get();
        foreach ($UserLastMonthOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        foreach ($UserTotalPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalPayFromCredit += $item->totalAmount;
            }
        }




                //
                foreach ($UserLastMonthOrdersIncreaseCredit as $item) {

                    if ($item->amountAfterOffer) {
                        $UserLastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
        
                    } else {
                        $UserLastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
                    }
                }
                //
                foreach ($UserLastWeekOrdersIncreaseCredit as $item) {
        
                    if ($item->amountAfterOffer) {
                    } else {
                        $UserLastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
                    }
                }
                //
                foreach ($UserLastDayOrdersIncreaseCredit as $item) {
        
                    if ($item->amountAfterOffer) {
                        $UserLastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
        
                    } else {
                        $UserLastDayOrdersFinalIncreaseCredit += $item->totalAmount;
                    }
                }
        
                foreach ($UserTotalIncreaseCredit as $item) {
        
                    if ($item->amountAfterOffer) {
                        $UserTotalFinalIncreaseCredit += $item->amountAfterOffer;
        
                    } else {
                        $UserTotalFinalIncreaseCredit += $item->totalAmount;
                    }
                }
        

        

            
 //
 foreach ($UserLastMonthOrders as $item) {
    if ($item->amountAfterOffer) {
        $UserLastMonthOrdersFinal += $item->amountAfterOffer;
    } else {
        $UserLastMonthOrdersFinal += $item->totalAmount;
    }
}
//
foreach ($UserLastWeekOrders as $item) {
    if ($item->amountAfterOffer) {
        $UserLastWeekOrdersFinal += $item->amountAfterOffer;
    } else {
        $UserLastWeekOrdersFinal += $item->totalAmount;
    }
}
//
foreach ($UserLastDayOrders as $item) {
    if ($item->amountAfterOffer) {
        $UserLastDayOrdersFinal += $item->amountAfterOffer;
    } else {
        $UserLastDayOrdersFinal += $item->totalAmount;
    }
}
foreach ($UserTotal as $item) {
    if ($item->amountAfterOffer) {
        $UserTotalFinal += $item->amountAfterOffer;
    } else {
        $UserTotalFinal += $item->totalAmount;
    }
}





        return view('user.vendor.showUserDetial', compact(

            'products',
///////
            "user",


            'UserTotal',
            'UserTotalFinal',
            'UserLastDayOrders',
            'UserLastDayOrdersFinal',
            'UserLastDayOrders',
            'UserLastWeekOrdersFinal',
            'UserLastMonthOrders',
            'UserLastMonthOrdersFinal',


            'UserLastMonthOrdersFinalIncreaseCredit' ,
            'UserLastMonthOrdersIncreaseCredit' ,
            'UserLastWeekOrdersIncreaseCredit' ,
            'UserLastWeekOrdersFinalIncreaseCredit' ,
            'UserLastDayOrdersIncreaseCredit' ,
            'UserLastDayOrdersFinalIncreaseCredit' ,
            'UserTotalFinalIncreaseCredit' ,
            'UserTotalIncreaseCredit' ,




            'UserLastMonthOrdersFinalPayFromCredit' ,
            'UserLastMonthOrdersPayFromCredit' ,
            'UserLastWeekOrdersFinalPayFromCredit' ,
            'UserLastWeekOrdersPayFromCredit' ,
            'UserLastDayOrdersFinalPayFromCredit' ,
            'UserLastDayOrdersPayFromCredit' ,
            'UserTotalFinalPayFromCredit' ,
            'UserTotalPayFromCredit' ,
/////



        )
        );






    }








}