<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MustNotVerified
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
        
        $user = Auth::user();
        if( is_null( $user->mobile_verified_at ) )
        {
            
        }else{
            Alert::success(
                'اعلان',
                'شماره همراه شما قبلا تایید شده است'
            )->showConfirmbutton('تایید');
            return redirect()->route('user.dashboard');
        }
        return $next($request);
    }
}
