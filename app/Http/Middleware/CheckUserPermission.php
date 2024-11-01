<?php

namespace App\Http\Middleware;

use App\Models\User\UserLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
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
        $response = $next($request);

        if (!is_null($user->boss_id)) {


            if (!is_null($user->permissions)) {

                $jsonedPermissions = json_decode($user->permissions);


                $array = get_object_vars($jsonedPermissions);


                if (array_key_exists($routeName, $array)) {



                    if ($array[$routeName]) {

                        $response = $next($request);
                        $log = UserLog::create([
                            'user_id' => Auth::user()->id,
                            'url' => $routeName,
                            'status' => $status
                        ]);


                    } else {

                        $status = 403;
                        $log = UserLog::create([
                            'user_id' => Auth::user()->id,
                            'url' => $routeName,
                            'status' => $status
                        ]);
                        $response = response()->view('user.errors.403', [], 403);

                    }
                }
            }

        }







        return $response;



    }
}