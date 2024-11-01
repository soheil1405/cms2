<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserArticlesRequest;
use App\Http\Requests\UpdateUserArticlesRequest;
use App\Models\SiteSidBarAdds;
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





        $vendor = Auth::user()->vendor;


        $articles = $vendor->articles;




        return view('user.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        return view('user.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserArticlesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => "required|max:50",

            "file" => "required|mimes:docx|max:10000",
            "disc" => 'required',
        ]);



        $user = Auth::user();

        $file = $request->file;


        $striped_content = $this->getTextFromDocx($file);

        $userArticle = UserArticles::create([

            'user_id' => $user->id,
            'vendor_id' => $user->vendor->id,
            'name' => $request->name,
            'body' => $striped_content,
            "discreption" => $request->disc,
            'slug'=>str_replace("/" , "-" ,str_replace(" " , "-" , $request->name))


        ]);

        Alert::success('موفق', 'مقاله مورد نظر با موفقیت ثبت شد و پس از تایید نهایی منتشر میشود')->showConfirmbutton('تایید');


        return redirect()->route('user.UserArticles.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserArticles  $userArticles
     * @return \Illuminate\Http\Response
     */
    public function edit($userArticles)
    {

        $article = UserArticles::findOrFail($userArticles);

        return view('user.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserArticlesRequest  $request
     * @param  \App\Models\UserArticles  $userArticles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {



        $request->validate([
            'name' => "required|max:50",
            'id' => "required",
            "disc" => 'required',
            "file" => "nullable|mimes:docx|max:10000",

        ]);






        $file = $request->file;
        $userArticle = UserArticles::findOrFail($request->id);

        if ($file) {


            $striped_content = $this->getTextFromDocx($file);
        } else {

            $striped_content = $userArticle->body;
        }



        $userArticle->update([
            'name' => $request->name,
            "discreption" => $request->disc,
            "body"=>$striped_content ,
            "status" => "2" ,
            // 'slug'=>str_replace("/" , "-" ,str_replace(" " , "-" , $request->name))
        ]);


        Alert::success('موفق', 'مقاله مورد نظر با موفقیت ویرایش شد و پس از تایید نهایی منتشر میشود')->showConfirmbutton('تایید');


        return redirect()->route('user.UserArticles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserArticles  $userArticles
     * @return \Illuminate\Http\Response
     */
    public function destroy($userArticles)
    {

        $userArticle = UserArticles::findOrFail($userArticles);


        $filePath = public_path(env('USER_ARTICLE_FILES')) . $userArticle->file;

        if (file_exists($filePath)) {
            unlink($filePath);
        }



        $userArticle->delete();

        Alert::success('موفق', 'مقاله مورد نظر با موفقیت حذف شد')->showConfirmbutton('تایید');

        return redirect()->route('user.UserArticles.index');
    }



    public function homeIndex()
    {

        $userArticles = UserArticles::where('status', '1')->latest()->paginate(20);



        
        

        return view('ListOf.userArticles', compact('userArticles'));
    }


    public function show($slug)
    {
        $userArticles = UserArticles::where('status', '1')->where('slug', $slug)->first();

        if (is_null($userArticles)) {

            return abort(404);
        }

        $sideAddLinks = SiteSidBarAdds::where('status' , 1)->whereNotNull('showInSingleProduct')->get(); 


        return view('home.Articles.userArticleShow', compact('userArticles' , "sideAddLinks"));
    }





    public function getTextFromDocx($file)
    {

        $striped_content = '';

        $content = '';

        if (!$file || !file_exists($file)) {

            return false;
        }


        $zip = zip_open($file);



        if (!$zip || is_numeric($zip)) {

            return false;
        }
        while ($zip_entry = zip_read($zip)) {
            if (zip_entry_open($zip, $zip_entry) == FALSE)
                continue;
            if (zip_entry_name($zip_entry) != "word/document.xml")
                continue;
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            zip_entry_close($zip_entry);
        } // end while



        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        $striped_content = str_replace("\r", "<br/>", $striped_content);

        $striped_content = str_replace("\n", "<br/>", $striped_content);



        return $striped_content;
    }
}
