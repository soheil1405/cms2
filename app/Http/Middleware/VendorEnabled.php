<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $vendor = $request->route('vendor');


        $user = Auth::user();


        if( $vendor->status == 'no'  )
        {
            // if(  is_null(Auth::user()) && Auth::user() != $vendor->user &&  Auth::user()->rols()->where('name','admin')->get()->count() == 0 ){
                
                
                if(is_null($user)){
                    abort(404);

                }elseif(   $user->id != $vendor->user->id &&  Auth::user()->rols()->where('name','admin')->get()->count() == 0){
                    abort(404);

                }



            // }
        }
        return $next($request);
    }
}
