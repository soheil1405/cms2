<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferCodeRequest;
use App\Http\Requests\UpdateOfferCodeRequest;
use App\Models\OfferCode;
use App\Models\Orders;
use App\Models\UserOfferCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $offerCodes = OfferCode::all();


        return view('admin.offerCodes.index', compact('offerCodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.offerCodes.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        OfferCode::create($request->all());


        session()->flash('msg', 'کد تخفیف ایجاد شد');

        return redirect()->route('admin.odderCodes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferCode  $offerCode
     * @return \Illuminate\Http\Response
     */
    public function show(OfferCode $offerCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferCode  $offerCode
     * @return \Illuminate\Http\Response
     */
    public function edit($offerCode)
    {


        $offerCode = OfferCode::findOrFail($offerCode);


        return view('admin.offerCodes.edit', compact('offerCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferCodeRequest  $request
     * @param  \App\Models\OfferCode  $offerCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $offerCode = OfferCode::findOrFail($request->id);


        $offerCode->update([

            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
            // 'for' => $request->for,
            'offerType' => $request->offerType,
            'fee' => $request->fee
        ]);


        session()->flash('msg', 'کد تخفیف ویرایش شد');

        return redirect()->route('admin.odderCodes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferCode  $offerCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferCode $offerCode)
    {
        //
    }


    public function OfferCodeValidate(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'orderId' => 'required'
        ]);


        $code = OfferCode::where('code', $request->code)->first();

        $order = Orders::findOrFail($request->orderId);




        $lastUsee = UserOfferCodes::where('user_id', Auth::user()->id)->where('code_id', $code->id)->first();


        if ($lastUsee) {
            return response()->json('شما قبلا از این کد تخفیف استفاده کرده اید', 401);
        }



        if (is_null($code)) {
            return response()->json('کد وارد شده معتبر نیست', 401);
        }

        if ($order->amountAfterOffer) {

            return "khodeti";

        }

        if ($code->offerType == "amountable") {
            $newPrice = $order->totalAmount - $code->fee;
        } elseif ($code->offerType == "percentable") {

            $percent = ($order->totalAmount * $code->fee) / 100;

            $newPrice = $order->totalAmount - $percent;

        } else {
            return "khodeti";
        }


        $order->update([
            "amountAfterOffer" => $newPrice,
            'offerCode_id' => $code->id
        ]);
        return response()->json(['newPrice' => $newPrice]);
    }
}