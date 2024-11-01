<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorespareProductRequest;
use App\Http\Requests\UpdatespareProductRequest;
use App\Models\spareProduct;

class SpareProductController extends Controller
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
     * @param  \App\Http\Requests\StorespareProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorespareProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\spareProduct  $spareProduct
     * @return \Illuminate\Http\Response
     */
    public function show(spareProduct $spareProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\spareProduct  $spareProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(spareProduct $spareProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatespareProductRequest  $request
     * @param  \App\Models\spareProduct  $spareProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatespareProductRequest $request, spareProduct $spareProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\spareProduct  $spareProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(spareProduct $spareProduct)
    {
        //
    }
}
