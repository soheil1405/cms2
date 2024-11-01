<?php

namespace App\Http\Controllers;

use App\Models\HomeLander;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeLanderController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(HomeLander::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Response $response)
    {
        $user = Auth::user();

        $vendor = $user->vendor;

        $homeL = HomeLander::find(1);

        $cc = $user->can('create',[$homeL]);


        
        return view('welcome');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeLander  $homeLander
     * @return \Illuminate\Http\Response
     */
    public function show(HomeLander $homeLander)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeLander  $homeLander
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeLander $homeLander)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeLander  $homeLander
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeLander $homeLander)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeLander  $homeLander
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeLander $homeLander)
    {
        //
    }
}
