<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Admin\SpecialProducts;
use App\Models\Admin\SpecialVendors;
use App\Models\OfferCode;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\story;
use App\Models\UserOfferCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Vendor;
use Carbon\Carbon;


class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Auth::user()->orders;
        // dd($orders);
        return view('user.orders.index', compact('orders'));
    }

    public function pay($orderId, $amount, $userName, $phoneNumber, $desc, $callbackUrl)
    {



        $order = Orders::findOrfail($orderId);

        if (!is_null($order->amountAfterOffer)) {
            $amount = $order->amountAfterOffer;
        }


        $params = array(
            'order_id' => $orderId,
            'amount' => $amount,
            'name' => $userName,
            'phone' => "0" . $phoneNumber,
            'mail' => 'info@instabargh.com',
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => $callbackUrl,
            'X-API-KEY: 5bc456dc-306a-47b7-b3e4-1a6337145cb4',
            //'X-SANDBOX: 1'

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'X-API-KEY: 5bc456dc-306a-47b7-b3e4-1a6337145cb4',
                //'X-SANDBOX: 1'
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);


        return $result;



    }



    public function onlinePay($request)
    {

    }



    public function payAfterSend(Request $request)
    {





        $request->validate([
            'type' => 'required',
            'typeId' => 'required',
            'linkBack' => 'required',
            'payType' => 'required',
        ]);






        $amount = self::paymentStatusIn('storyPayStatus');


        $item = $this->findItemForPay($request->type, $request->typeId);


        // $item = Orders::findOrFail($request)

        $order = Orders::where('orderType', $request->type)->Where('typeId', $request->typeId)->latest()->first();



        if ($order->orderType == "ladderPPay" && $request->payType != "1") {

            
            if (Auth::user()->CREDIT > $order->totalAmount) {


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
                $order->update([
                    "status" => "CREDIT",
                    "persianStatus" => "پرداخت از طریق کیف پول",
                ]);

                $user = Auth::user();
                // dd($user->CREDIT);


                
                if($order->amountAfterOffer){


                    
                    $userCredit = $user->CREDIT - $order->amountAfterOffer;
               

                    $offeredAmount = $order->totalAmount - $order->amountAfterOffer;



                    $userOffer = UserOfferCodes::create([
    
                        'user_id'=>Auth::user()->id ,
                        'code_id'=>$order->offerCode_id ,
                        'mainAmount'=>$order->totalAmount , 
                        'offeredAmount'=>$offeredAmount ,
                        'finalAmount'=>$order->amountAfterOffer ,
                    
                    ]);
    
    

                }else{

                    $userCredit = $user->CREDIT - $order->totalAmount;
                }


                // dd( $userCredit - $order->totalAmount);


                $user->update([
                    'CREDIT' => $userCredit
                ]);



                Alert::success('موفق', ' محصول  ' . $product->name . 'نردبان شد')->showConfirmbutton('تایید');

            } else {

                Alert::error('خطا', '  موجودی کیف پول شما کافی نیست')->showConfirmbutton('تایید');

                return back();
            }



        } elseif ($order->orderType == "ladderVPay" && $request->payType != "1") {
        

        
            if (Auth::user()->CREDIT > $order->totalAmount) {

                $vendor = Vendor::findOrFail($order->typeId);

                $vendor->update([

                    'laddered_at' => Carbon::now()
                ]);
                $order->update([
                    "status" => "CREDIT",
                    "persianStatus" => "پرداخت از طریق کیف پول",
                ]);

                $user = Auth::user();


                if($order->amountAfterOffer){
                
                    $userCredit = $user->CREDIT - $order->amountAfterOffer;
               

                    $offeredAmount = $order->totalAmount - $order->amountAfterOffer;



                    $userOffer = UserOfferCodes::create([
    
                        'user_id'=>Auth::user()->id ,
                        'code_id'=>$order->offerCode_id ,
                        'mainAmount'=>$order->totalAmount , 
                        'offeredAmount'=>$offeredAmount ,
                        'finalAmount'=>$order->amountAfterOffer ,
                    
                    ]);
                   
                }else{

                    $userCredit = $user->CREDIT - $order->totalAmount;
                }




                $user->update([
                    'CREDIT' => $userCredit
                ]);



                alert()->success('  فروشگاه شما با موفقیت نردبان شد  ', 'باتشکر');
            } else {
                alert()->fail('   موجودی کیف پول شما کافی نیست  ', 'باتشکر');


            }
        } else {




            if ($item->paymentStatus == "inPaymentQueue") {





                if ($request->payType == "1") {


                    if (is_null($order)) {
                        $order = Orders::create([
                            'user_id' => Auth::user()->id,
                            'orderType' => $request->type,
                            'typeId' => $request->typeId,
                            'totalAmount' => $amount,
                            'linkBack' => $request->linkBack
                        ]);
                    }
                    $createPaymentReq = self::pay($order->id, $amount, Auth::User()->name, Auth::user()->mobile, $request->desc, route('user.orders.response'));


                    $data = get_object_vars(json_decode($createPaymentReq));

                    $link = $data['link'];

                    return view('user.orders.finalStepOrder', compact('link', 'order'));

                } else {

                    $user = Auth::user();





                    if ($order) {
                        if (Auth::user()->CREDIT > $order->totalAmount) {


                            if ($order->persianStatus == "در انتظار پرداخت") {



                                $item = $this->findItemForPay($order->orderType, $order->typeId);

                                $userCredit = $user->CREDIT - $order->totalAmount;

                                $order->update([
                                    "status" => "CREDIT",
                                    "persianStatus" => "پرداخت از طریق کیف پول",
                                ]);


                            } else {




                                $order = Orders::create([
                                    'user_id' => Auth::user()->id,
                                    'orderType' => $request->type,
                                    "typeId" => $request->typeId,
                                    'description' => $request->description,
                                    "status" => "CREDIT",
                                    "persianStatus" => "پرداخت از طریق کیف پول",
                                    "totalAmount" => $this->paymentStatusIn('storyPayStatus'),
                                ]);







                                if($order->amountAfterOffer){
                
                                    $userCredit = $user->CREDIT - $order->amountAfterOffer;
               

                                    $offeredAmount = $order->totalAmount - $order->amountAfterOffer;
                
                
                
                                    $userOffer = UserOfferCodes::create([
                    
                                        'user_id'=>Auth::user()->id ,
                                        'code_id'=>$order->offerCode_id ,
                                        'mainAmount'=>$order->totalAmount , 
                                        'offeredAmount'=>$offeredAmount ,
                                        'finalAmount'=>$order->amountAfterOffer ,
                                    
                                    ]);
                                                   
                                }else{
                
                                    $userCredit = $user->CREDIT - $order->totalAmount;
                                }
                

                            }

                            $user->update([
                                'CREDIT' => $userCredit
                            ]);


                            $item->update([
                                'paymentStatus' => 'payed'
                            ]);



                            Alert::success('موفق', 'پرداخت با موفقیت انجام شد')->showConfirmbutton('تایید');

                            return redirect()->route($order->linkBack);
                        } else {



                            Alert::error('خظا', 'موجودی کیف پول شما کافی نیست')->showConfirmbutton('تایید');



                            return back();
                        }
                    } else {

                        Alert::error('خظا', 'قبلا پرداخت کردید')->showConfirmbutton('تایید');


                        return back();

                    }

                }


            } else {

                Alert::error('خظا', 'قبلا پرداخت کردید')->showConfirmbutton('تایید');


                return back();


            }


        }


        return redirect()->route($order->linkBack);
    }


    public function findItemForPay($model, $id)
    {



        switch ($model) {
            case 'story':
                return story::findOrFail($id);
                break;
            case 'slider':
                return Sliders::findOrFail($id);
                break;
            case 'spcV':
                return SpecialVendors::findOrFail($id);
                break;
            case 'spcP':
                return SpecialProducts::findOrFail($id);
                break;
            case 'specialProduct':
                return SpecialProducts::findOrFail($id);
                break;
            case 'specialVendor':
                return SpecialVendors::findOrFail($id);
                break;
            default:
                return null;
                break;
        }


    }









    public function payPage($order)
    {


        $order = Orders::findOrFail($order);



        $createPaymentReq = self::pay($order->id, $order->totalAmount, $order->user_id, $order->user->mobile, $order->description, route('user.orders.response'));





    

        $data = get_object_vars(json_decode($createPaymentReq));

        // dd($data);

        if (isset($data['error_message'])) {

            Alert::error('خطا', $data['error_message']);
            return back();


        }

        

        $link = $data['link'];

        
        return view('user.orders.finalStepOrder', compact('link', 'order'));





    }






}