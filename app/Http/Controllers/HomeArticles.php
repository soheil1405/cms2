<?php
namespace App\Http\Controllers;

use App\Models\Admin\CategoryArticle;
use App\Models\SiteSidBarAdds;
use Illuminate\Http\Request;

class HomeArticles extends Controller
{
    public function index(){
       $articles = CategoryArticle::orderByDesc('created_at')->get();

       

       $specialVendors = resolve(SpecialVendorsController::class)->get_available(10);

        return view('ListOf.AllArticles', compact('articles' , 'specialVendors'));


    }


    public function show($article){


        


        $more_articles = CategoryArticle::orderByDesc('created_at')->limit(10)->get();

        $specialVendors = resolve(SpecialVendorsController::class)->get_available(10);

        

        $speciallProducts = resolve(SpecialProductsController::class)->get_available(10);


        $article = CategoryArticle::where( 'slug' , $article)->first();

    
        
    

        
        
        $sideAddLinks = SiteSidBarAdds::where('status' , 1)->whereNotNull('showInSingleProduct')->get(); 

        return view('home.Articles.show', compact('article' ,"sideAddLinks", 'more_articles' , 'specialVendors' , 'speciallProducts'));

    }




}
