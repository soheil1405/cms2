<?php



namespace App\Filters\ProductFilters;

use Closure;

class Category
{

    public function handle($request , Closure $next){



        if(  ! \request()->has('filter_category')  ||  ! \request('filter_category') != 'default' ){
            return $next($request);
        }
        


        $builder = $next($request);



        
        return $builder->where('lvl_one_category_id' , \request('filter_category'));

    }
}







