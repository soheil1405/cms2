<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuyGuidProductRequest;
use App\Http\Requests\UpdateBuyGuidProductRequest;
use App\Models\BuyGuidProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BuyGuidProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = BuyGuidProduct::latest()->paginate(20);
        return view('admin.buyGuidProduct.index', compact('items'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catgegories = Category::all();


        return view('admin.buyGuidProduct.create', compact('catgegories'));






    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBuyGuidProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $guidBuy = BuyGuidProduct::create([
            'creator_id' => Auth::user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);








        session()->flash('ok', "راهنمای خرید کالا با موفقیت منتشر شد😊");

        return redirect()->route('admin.buyGuidProduct.index');












    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuyGuidProduct  $buyGuidProduct
     * @return \Illuminate\Http\Response
     */
    public function show( $id)


    {
    

        $buyguid = BuyGuidProduct::findOrFail($id);


        return view('buyGuidProduct' , compact('buyguid'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuyGuidProduct  $buyGuidProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($buyGuidProduct)
    {

        $catgegories = Category::all();


        $item = BuyGuidProduct::findOrFail($buyGuidProduct);



        return view('admin.buyGuidProduct.edit', compact('catgegories', 'item'));




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBuyGuidProductRequest  $request
     * @param  \App\Models\BuyGuidProduct  $buyGuidProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'id' => 'required',
        ]);

        $guidBuy = BuyGuidProduct::findOrFail($request->id);


        $guidBuy->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);



        session()->flash('ok', "راهنمای خرید کالا با موفقیت ویرایش شد😊");

        return redirect()->route('admin.buyGuidProduct.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuyGuidProduct  $buyGuidProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($buyGuidProduct)
    {
        $item = BuyGuidProduct::findOrFail($buyGuidProduct);


        $name = $item->title;




        $item->delete();

        session()->flash('ok', " راهنمای خرید کالا  برای" . $name . " با موفقیت حذف شد😊");

        return redirect()->route('admin.buyGuidProduct.index');

    }








    public function homeIndex()
    {

    $items = BuyGuidProduct::latest()->paginate(20);
    return view('ListOf.buyGuidProduct' , compact('items'));
    
    
    }

    public function homeShow($id){





    }


}