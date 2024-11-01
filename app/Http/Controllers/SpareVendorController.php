<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorespareVendorRequest;
use App\Http\Requests\UpdatespareVendorRequest;
use App\Models\spareVendor;

class SpareVendorController extends Controller
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
     * @param  \App\Http\Requests\StorespareVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorespareVendorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\spareVendor  $spareVendor
     * @return \Illuminate\Http\Response
     */
    public function show(spareVendor $spareVendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\spareVendor  $spareVendor
     * @return \Illuminate\Http\Response
     */
    public function edit(spareVendor $spareVendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatespareVendorRequest  $request
     * @param  \App\Models\spareVendor  $spareVendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatespareVendorRequest $request, spareVendor $spareVendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\spareVendor  $spareVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(spareVendor $spareVendor)
    {
        //
    }
}
