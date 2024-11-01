<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\paginator;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        paginator::useBootstrap();
       
        Schema::defaultStringLength(191);

        Blade::if('hasvendor',function(User $user){
            if(is_null($user))
            {
                return false;
            }

            if(is_null($user->vendor))
            {
                return false;
            }

            return true;
        });

            Blade::if('isVerified',function(User $user){
               
                if(is_null($user))
                {
                    return false;
                }

                if(is_null($user->mobile_verified_at))
                {
                    return false;
                }

                return true;
            });

    }



}
