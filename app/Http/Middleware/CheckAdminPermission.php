<?php

namespace App\Http\Middleware;

use App\Models\Admin\AdminLog;
use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
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

        
        $routeName = Route::currentRouteName();
        

        $status = 200;
        
        
        
        
        if (!is_null($user->permissions)) {
            
            

            $jsonedPermissions = json_decode($user->permissions);


            $array = get_object_vars($jsonedPermissions);


            if (array_key_exists($routeName, $array)) {

                if ($array[$routeName]) {
                    $response = $next($request);
                } else {
                    $status = 403;
                    $response = response()->view('admin.errors.403', [], 403);
                }




            } else {
                $status = 403;
                $response = response()->view('admin.errors.403', [], 403);
            }




        } else {

            $response = $next($request);
        }



        if ($status == 200) {

            $param = json_encode($request->route()->originalParameters());
            $log = AdminLog::create([
                'admin_id' => Auth::user()->id,
                'url' => $routeName,
                'status' => $status,
                'parameters' => $param,
            ]);

        }








        // dd($user->permissions);





        return $response;
    }
}