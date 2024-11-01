<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryArticle;
use App\Models\Product;
use App\Models\story;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoryController extends Controller
{

    public function create()
    {

        $articles = CategoryArticle::all();

        $products = Product::where('status' , "!=" ,'new')->get();

        $vendors = Vendor::where('adminVendor' , 'no')->get();

        return view('admin.stories.create', compact('articles', 'products', 'vendors'));
    }

    public function accept(Request $request)
    {
        $story = story::findOrFail($request->id);

        $story->update([

            'acceptedByAdmin' => Carbon::now(),
        ]);

        session()->flash('accepted', 'استوری مورد نظر با موفقیت تایید شد');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $story = story::findOrFail($request->id);

        $story->delete();

        session()->flash('destroy', 'استوری مورد نظر با موفقیت حذف شد');
        return redirect()->back();

    }

    public function edit($id)
    {

        $story = story::findOrFail($id);

        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request)
    {

        $story = story::findOrFail($request->id);

        if ($request->storyMedia) {

            $media = $request->storyMedia;

            $fileNameImage = generateFileName($media->getClientOriginalName());

            $media->move(public_path(env('STORY_MEDIAL_UPLOAD_PATH')), $fileNameImage);
        } else {

            $fileNameImage = $story->media;

        }

        $story->update([
            'text1' => $request->text1,
            'text2' => $request->text2,
            'media' => $fileNameImage,
            'bgcolor' => $request->bgcolor,
        ]);

        session()->flash('edited', 'استوری مورد نظر با موفقیت ویرایش شد');

        return redirect()->route('admin.stories.index');

    }

    public function AdminCreate()
    {

        $products = Product::whereNotNull('acceptedByAdmin')->get();

        $vendors = Vendor::where('adminVendor' , 'no')->whereNotNull('acceptedByAdmin')->get();

        $articles = CategoryArticle::all();

        return view('admin.stories.create', compact('products', 'vendors', 'articles'));

    }

    public function store(Request $request)
    {

        $request->validate([

            'storyType' => 'required',
            'creator' => 'required',
        ]);

        if ($request->creator != "admin") {

            session()->flash('customError', 'خطای سیستمی');

            return redirect()->route('admin.stories.create');
        }

        // dd($request->all());

        $storyType = $request->storyType;

        switch ($storyType) {
            case 'p':

                $product = Product::findOrFail($request->product_id);

                $strory = story::create([

                    'sendBy' => 'admin',
                    'text2' => $request->text2,
                    'text1' => $request->text1,
                    'vendor_id' => $product->vendor->id,
                    'product_id' => $product->id,
                    'vendorName' => $product->vendor->name,
                    'productSlug' => $product->slug,
                    'bgcolor' => $request->bgcolor,
                    'acceptedByAdmin'=>Carbon::now()
                ]);

                break;
            case 'v':
                $vendor = Vendor::findOrFail($request->vendor_id);

                $strory = story::create([

                    'sendBy' => 'admin',
                    'text2' => $request->text2,
                    'text1' => $request->text1,
                    'vendor_id' => $vendor->id,
                    'vendorName' => $vendor->name,
                    'bgcolor' => $request->bgcolor,
                    'acceptedByAdmin'=>Carbon::now()
                ]);

                break;
            case 'a':
                $article = CategoryArticle::findOrFail($request->article_id);

                $strory = story::create([

                    'sendBy' => 'admin',
                    'text2' => $request->text2,
                    'text1' => $request->text1,
                    'article_id' => $article->article_id,
                    'bgcolor' => $request->bgcolor,
                    'acceptedByAdmin'=>Carbon::now()
                ]);

                break;

            default:

                session()->flash('customError', 'خطای سیستمی');

                return redirect()->route('admin.stories.create');

                break;
        }






        session()->flash('created' , 'استوری مورد نظر با موفقیت ارسال شد');
        return redirect()->route('admin.stories.index');








    }

}
