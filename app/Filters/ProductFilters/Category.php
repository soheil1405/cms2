<?php



namespace App\Filters\ProductFilters;

use App\Models\Category as ModelsCategory;
use App\Models\Product;
use Closure;

class Category
{



    public function handle($request , Closure $next){



        if(\request('CatCheckBox') == null ){
            return $next($request);
        }
        
        $builder = $next($request);


        // $Cat_input = \App\Models\Category::find(\request('CatCheckBox'))->childrens();
        $Cat_input = ModelsCategory::where('parent_id' ,  \request('CatCheckBox'))->get();
        
        // dd($Cat_input);
        
        // foreach($Cat_input as $cat){
        
            
        //     return $builder->where('lvl_one_category_id' , $cat->id);
        // }
        
        return $builder->where('slug' , \request('CatSlug'));

    }
}







