<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        alert()->success('تگ مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show' , compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        alert()->success('تگ مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function createByUser(Request $request){
        $request->validate([

            'TagName'=>'required' ,
            'vendor_id'=>'required'
        ]);

        // try{
            $old_tag = Tag::where('name',$request->TagName)->get();
            if(count($old_tag)>0){
                return response()->json('error' , 401);
            }


            $tag = Tag::create([               
                'name'=>$request->TagName , 
                'vendor_id' => $request->vendor_id , 
                'is_active'=> 0 ,
            ]);

            return response()->json($tag , 200);

        // }catch(Exception $e){
        //     return response()->json($e , 402); 
        // }

    }
}
