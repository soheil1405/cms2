<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminNotificationRequest;
use App\Http\Requests\UpdateAdminNotificationRequest;
use App\Models\AdminNotification;

class AdminNotificationController extends Controller
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
     * @param  \App\Http\Requests\StoreAdminNotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminNotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminNotification  $adminNotification
     * @return \Illuminate\Http\Response
     */
    public function show(AdminNotification $adminNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminNotification  $adminNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminNotification $adminNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminNotificationRequest  $request
     * @param  \App\Models\AdminNotification  $adminNotification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminNotificationRequest $request, AdminNotification $adminNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminNotification  $adminNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminNotification $adminNotification)
    {
        //
    }
}
