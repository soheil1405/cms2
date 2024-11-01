<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ProductImageController;
use App\Http\Requests\StoreCategoryArticleRequest;
use App\Http\Requests\UpdateCategoryArticleRequest;
use App\Models\Admin\ArtcilePictures;
use App\Models\Admin\CategoryArticle;
use App\Models\Category;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryArticleController extends Controller
{
    public function index()
    {
        $articles = CategoryArticle::all();
   
        
        
        
        return view('admin.categoryArticles.index', compact('articles'));
    }

    public function create()
    {

        $categories = Category::where('parent_id' , '>' , 0 )->get();
        $images = ArtcilePictures::latest()->get();

        return view('admin.categoryArticles.create', compact('categories', 'images'));
    }
    public function store(Request $request)
    {


        // dd($request->all());

        // try {


            
            $request->validate([
                
                
                'title'=>'required' ,
                'body' => 'required',
                'pre_show'=>'required'
            ]);
            
            $sulg = str_replace(' ', '-', $request->title);
            CategoryArticle::create([

                'slug'=>$sulg,
                'pre_show'=>$request->pre_show,
                'title' => $request->title,
                'main_img'=>$request->main_img ,
                'body' => $request->body,
            ]);
            DB::commit();
            return redirect()->route('admin.articles.index');
        // } catch (Exception $e) {
        // }
    }

    public function show($id)
    {
        $article = CategoryArticle::find($id);

        return view('admin.categoryArticles.show', compact('article'));
    }
    public function edit($categoryArticle)
    {

        
        $images = ArtcilePictures::all();

        $article = CategoryArticle::find($categoryArticle);


        return view('admin.categoryArticles.edit' , compact('images' , 'article'));

        
    }
    public function UpdateArticle(Request $request)

    {

        $request->validate([

            'title'=>'required' ,
            'body' => 'required',
            'pre_show'=>'required'
        ]);


        
        

        
        $article = CategoryArticle::find($request->article);
        $sulg = str_replace(' ', '-', $request->title);

        
        $article->update([

            'slug'=>$sulg ,
            'title'=>$request->title ,
            'pre_show'=>$request->pre_show ,
            'body'=>$request->body ,
            'main_img'=>$request->main_img ? $request->main_img : $article->main_img ,

        ]);

        DB::commit();

        return redirect()->route('admin.articles.index');










    }
    public function destroy( $categoryArticle)
    {


        $article = CategoryArticle::findOrFail($categoryArticle);
        $article->delete();


        return redirect()->back();


    }

    public function StoreImages(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $request->file('upload')->getClientOriginalExtension();

            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('images/' . $fileName);

            $msg = 'Image successfully uploaded';

            $response = "<script>
                window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')
            </script>";

            @header('Content-type: text/html; charset=utf-8');

            echo $response;
        }
    }
}
