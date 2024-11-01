<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCreditRequest;
use App\Http\Requests\UpdateUserCreditRequest;
use App\Models\UserCredit;

class UserCreditController extends Controller
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
     * @param  \App\Http\Requests\StoreUserCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCreditRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCredit  $userCredit
     * @return \Illuminate\Http\Response
     */
    public function show(UserCredit $userCredit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCredit  $userCredit
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCredit $userCredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserCreditRequest  $request
     * @param  \App\Models\UserCredit  $userCredit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserCreditRequest $request, UserCredit $userCredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCredit  $userCredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCredit $userCredit)
    {
        //
    }
}
