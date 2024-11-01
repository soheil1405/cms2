<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class Comparison extends Controller
{
    public function Add(Request $request)
    {
        // $request->validate([
        //     'id' => 'required',
        // ]);

        // session_start();

        // $comp = session()->get('comp');

        // if($comp){

        //     return response()->json('yes');
        // }else{

            return response()->json('no');
       
        // }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
    }

    public function compare()
    {
    }
}
