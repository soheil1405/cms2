<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminLogRequest;
use App\Http\Requests\UpdateAdminLogRequest;
use App\Models\Admin\AdminLog;

class AdminLogController extends Controller
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
     * @param  \App\Http\Requests\StoreAdminLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\AdminLog  $adminLog
     * @return \Illuminate\Http\Response
     */
    public function show(AdminLog $adminLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\AdminLog  $adminLog
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminLog $adminLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminLogRequest  $request
     * @param  \App\Models\Admin\AdminLog  $adminLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminLogRequest $request, AdminLog $adminLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\AdminLog  $adminLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminLog $adminLog)
    {
        //
    }
}
