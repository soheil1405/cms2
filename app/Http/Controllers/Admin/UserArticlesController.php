<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserArticlesRequest;
use App\Http\Requests\UpdateUserArticlesRequest;
use App\Models\UserArticles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $articles = UserArticles::latest()->paginate(20);

        return view('admin.userArticles.index', compact('articles'));




    }





    public function edit($userArticles)
    {
        
        
        
        $article = UserArticles::findOrFail($userArticles);



        return view('admin.userArticles.edit', compact('article'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'name' => "required|max:50",
            'id' => "required",
            "disc" => 'required',
        ]);





        $file = $request->file;
        $userArticle = UserArticles::findOrFail($request->id);

        if ($file) {


            $request->validate([
                "file" => "mimes:pdf,doc,docx|max:10000",
            ]);

            $fileName = generateFileName($file->getClientOriginalName());

            $file->move(public_path(env('USER_ARTICLE_FILES')), $fileName);

            $userArticle->update([
                'file' => $fileName,
            ]);
    
        }
        $image = $request->image;
        $userArticle = UserArticles::findOrFail($request->id);

        if ($image) {


            

            $imageName = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('ARTICLE_IMAGES_UPLOAD_PATH')), $imageName);

            $userArticle->update([
                'image' => $imageName,
            ]);
    
        }



        $userArticle->update([
            'name' => $request->name ,
            "discreption" => $request->disc,
        ]);


        return redirect()->route('admin.UserArticles.index');



    }


    public function acceptUserArticle(Request $request)
    {


        $userArticle = UserArticles::findOrFail($request->id);


        $userArticle->update([

            'status' => "1"

        ]);



        session()->flash('ok', ' مقاله مورد نظر تایید و منتشر شد');

        return redirect()->route('admin.UserArticles.index');



    }




    public function destroy($userArticles){
        
        $userArticle = UserArticles::findOrFail($userArticles);
        
        
        $filePath = public_path(env('USER_ARTICLE_FILES')).$userArticle->file;

        if(file_exists($filePath)){
            // unlink($filePath);

        }

        
        
        $userArticle->delete();

         session()->flash('ok', 'مقاله مورد نظر با موفقیت حذف شد');

        return redirect()->route('admin.UserArticles.index');
    }
}