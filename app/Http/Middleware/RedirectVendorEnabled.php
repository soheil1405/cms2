<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectVendorEnabled
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
        $vendor = $user->vendor;

        if (is_null($user->vendor)) {

            Auth::logout($user);
            return redirect()->route('login');

        }

        if ($vendor->status == 'no') {
            return redirect()->route('user.vendor.images.edit', ['vendor' => $vendor->name]);
        }
        return $next($request);
    }
}