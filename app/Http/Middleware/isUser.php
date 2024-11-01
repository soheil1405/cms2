<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isUser
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
      
      
        // dd(Auth::user()->rols());
      
        if(Auth::user()->rols()->where('name','user')->get()->count() == 0 && Auth::user()->vendor )
        {
            return redirect()->route('admin.dashboard');
        }else{
            return $next($request);
        }
    }
}
