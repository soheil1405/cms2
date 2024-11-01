<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteSidBarAddsRequest;
use App\Http\Requests\UpdateSiteSidBarAddsRequest;
use App\Models\SiteSidBarAdds;
use Illuminate\Http\Request;

class SiteSidBarAddsController extends Controller
{

    public function edit()
    {





        $links = SiteSidBarAdds::all();

        // dd($links);

        return view('admin.setting.SiteSidBarAdds', compact('links'));




    }


    public function store(Request $request)
    {

        $request->validate([

            'image' => 'required|mimes:jpg,png,jpeg'
        ]);


        $image = $request->image;


        $fileNameImage = generateFileName($image->getClientOriginalName());

        $image->move(public_path(env('SIDEBAR_LINKS_PIC_PATH')), $fileNameImage);


        SiteSidBarAdds::create([
            'link' => $request->link,
            'image' => $fileNameImage,
            'status' => 1
        ]);


        session()->flash('created', 'تبلیغ مورد نظر ایجاد شد');
        return redirect()->back();
    }












    public function update(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);



        $link = SiteSidBarAdds::find($request->id);



        if ($request->image) {

            $image = $request->image;


            $fileNameImage = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('SIDEBAR_LINKS_PIC_PATH')), $fileNameImage);

        } else {
            $fileNameImage = $link->image;
        }


        $link->update([
            'link' => $request->link,
            'image' => $fileNameImage,
            'status' => $request->status,
            'showInProducts' => $request->showInProducts ? 1 : null,
            'showInVendors' => $request->showInVendors ? 1 : null,
            'showInBrands' => $request->showInBrands ? 1 : null,

            'showInSingleProduct' => $request->showInSingleProduct ? 1 : null,
            'showInSingleVendor' => $request->showInSingleVendor ? 1 : null,
            'showInSingleArticle' => $request->showInSingleArticle ? 1 : null,
        ]);


        session()->flash('edited', 'تبلیغ مورد نظر با موفقیت ویرایش شد');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $request->validate([

            'id' => 'required'
        ]);


        $link = SiteSidBarAdds::findOrFail($request->id);

        $link->delete();

        session()->flash('deleted', 'تبلیغ مورد نظر با موفقیت حذف شد');
        return redirect()->back();





    }












}