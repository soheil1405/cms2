<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepaymentSettingRequest;
use App\Http\Requests\UpdatepaymentSettingRequest;
use App\Models\paymentSetting;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepaymentSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepaymentSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\paymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function show(paymentSetting $paymentSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(paymentSetting $paymentSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepaymentSettingRequest  $request
     * @param  \App\Models\paymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepaymentSettingRequest $request, paymentSetting $paymentSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(paymentSetting $paymentSetting)
    {
        //
    }
}
