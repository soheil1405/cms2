<?php



namespace App\Filters\ProductFilters;

use App\Models\Product;
use Closure;

class Price
{

    public function handle($request , Closure $next){



        if(  ! \request()->has('priceRadio')  ||   \request('priceRadio') == 'no' ){
            return $next($request);
        }
        


        $builder = $next($request);




        $order = '';



        if(   \request('priceRadio') == 'up'){
           
            $order = 'asc';
            // return $builder->orderBy('price' , 'asc');
        }
        elseif(\request('priceRadio') == 'down'){
           
            $order = 'desc';
            // return $builder->variations[0]->orderBy('price' , 'desc');

        }else{

            return $next($request);
        
        }

        return Product::with(['variations' => function ($builder) use ($order) {
            $builder->orderBy('price', $order);
        }]);


        // $users = User::join('roles', 'users.role_id', '=', 'roles.id')->orderBy('roles.label', $order)->select('users.*')->paginate(10);
        // return $builder->join('product_variations' ,  'product_variations.product_id'  , '=', 'products.id')-> orderBy('product_variations.price' , $order)->select('products.*');



    }
}







