<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Orders;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ExcelExport) {

            $orders = Orders::latest()

                ->when($request->showBy, function ($query) use ($request) {

                    if ($request->showBy == "all") {
                        return $query;
                    } elseif ($request->showBy == "succese") {
                        return $query->where('persianStatus', 'پرداخت تایید شده است.');
                    } elseif ($request->showBy == "fail") {
                        return $query->where('persianStatus', 'در انتظار پرداخت');
                    } elseif ($request->showBy == "credit") {
                        return $query->where('persianStatus', 'پرداخت از طریق کیف پول');
                    }
                    return $query;
                })->get();



                
                ob_end_clean();


            ob_start();
            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($orders , 'orders'), 'instabargh.orders' . now() . '.xlsx');

        } else {

            $orders = Orders::latest()

                ->when($request->showBy, function ($query) use ($request) {

                    if ($request->showBy == "all") {
                        return $query;
                    } elseif ($request->showBy == "succese") {
                        return $query->where('persianStatus', 'پرداخت تایید شده است.');
                    } elseif ($request->showBy == "fail") {
                        return $query->where('persianStatus', 'در انتظار پرداخت');
                    } elseif ($request->showBy == "credit") {
                        return $query->where('persianStatus', 'پرداخت از طریق کیف پول');
                    }
                    return $query;
                })->paginate(50);

        }

        return view('admin.orders.index', compact('orders'));
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
     * @param  \App\Http\Requests\StoreOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersRequest  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
