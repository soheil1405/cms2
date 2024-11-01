<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenewsLinksRequest;
use App\Http\Requests\UpdatenewsLinksRequest;
use App\Models\newsLinks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NewsLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = newsLinks::latest()->paginate(20);
        return view('admin.newsLinks.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsLinks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorenewsLinksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'link' => 'required',
        ]);

        if ($request->pic) {

            $file = $request->pic;

            $request->validate([
                "pic" => "mimes:jpg,png,jpeg",
            ]);

            $fileName = generateFileName($file->getClientOriginalName());

            $file->move(public_path(env('NEWS_LINKS_PICS')), $fileName);

        } else {
            $fileName = "logo.png";
        }


        $newLink = newsLinks::create([

            'title' => $request->title,
            'link' => $request->link,
            'discription' => $request->discription,
            'creator_id' => Auth::user()->id,
            'pic' => $fileName
        ]);







        session()->flash('ok', 'لینک جدید با موفقیت ذخیره شد');

        return redirect()->route('admin.newsLinks.index');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newsLinks  $newsLinks
     * @return \Illuminate\Http\Response
     */
    public function show(newsLinks $newsLinks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newsLinks  $newsLinks
     * @return \Illuminate\Http\Response
     */
    public function edit($newsLinks)
    {

        $link = newsLinks::findOrFail($newsLinks);

        return view('admin.newsLinks.edit', compact('link'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenewsLinksRequest  $request
     * @param  \App\Models\newsLinks  $newsLinks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'id' => 'required'
        ]);


        $newLink = newsLinks::findOrFail($request->id);

        $newLink->update([
            'title' => $request->title,
            'link' => $request->link,
            'discription' => $request->discription,
        ]);




        session()->flash('ok', 'لینک جدید با موفقیت ویرایش شد');

        return redirect()->route('admin.newsLinks.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newsLinks  $newsLinks
     * @return \Illuminate\Http\Response
     */
    public function destroy($newsLinks)
    {

        $newsLink = newsLinks::findOrFail($newsLinks);


        $filePath = public_path(env('NEWS_LINKS_PICS')) . $newsLink->pic;

        if (file_exists($filePath)) {
            unlink($filePath);

        }



        $newsLink->delete();

        session()->flash('ok', 'لینک جدید با موفقیت حذف شد');

        return redirect()->route('admin.newsLinks.index');
    }



    public function homeIndex(){
        

        $newsLink = newsLinks::latest()->paginate(20);

        return view('ListOf.newsLinks', compact('newsLink'));


    }
}