<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class VisitCount
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

        $methods = Route::current()->methods;


        $routeName = Route::currentRouteName();


        $setting = \App\Models\Admin\Setting::first();

        // dd($routeName);

        $sitAllVisitCount = $setting->sitAllVisitCount;

        $allproductsVisitCount = $setting->allproductsVisitCount;
        $allVendorsVisitCount = $setting->allVendorsVisitCount;
        $allBrandsVisitCount = $setting->allBrandsVisitCount;

        
        foreach ($methods as $method) {
            
            if($method == "GET"){
                

                $sitAllVisitCount ++ ;

            }
        
            if($routeName == "Products.index"){
                $allproductsVisitCount ++;
            }
            
            if($routeName == "Vendors.list"){
                $allVendorsVisitCount ++;
            }
            if($routeName == "brands.homeIndex"){
                $allBrandsVisitCount ++;
            }
        }

        
        $setting->update([
            "sitAllVisitCount"=>$sitAllVisitCount ,
            "allproductsVisitCount"=>$allproductsVisitCount ,
            "allVendorsVisitCount"=>$allVendorsVisitCount ,
            "allBrandsVisitCount"=>$allBrandsVisitCount
        ]);

    
        return $next($request);
    }
}
