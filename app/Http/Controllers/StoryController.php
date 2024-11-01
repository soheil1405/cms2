<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestoryRequest;
use App\Http\Requests\UpdatestoryRequest;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\story;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


class StoryController extends Controller
{
    

    public function index(Request $request)
    {

        $stories = story::OrderByDesc('id')->get();

        $count_of_slider_in_Queue = count(story::whereNull('acceptedByAdmin')->get());

        if ($request->ExcelExport) {
            ob_end_clean();
            ob_start();
        
            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($stories , 'stories'), 'instabargh.sliders' . now() . '.xlsx');
        }

        return view('admin.stories.index', compact('stories', 'count_of_slider_in_Queue'));
    }


    public function userindex()
    {

        $stories = story::where('vendor_id', Auth::user()->vendor->id)->OrderByDesc('id')->get();
        return view('user.story.index', compact('stories'));

    }

    public function create($productId)
    {

        $product = Product::findOrfail($productId);
        return view('user.story.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorestoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'storyMedia' => 'nullable|mimes:jpg,jpeg,png|between:2048,102400',
            'vendor_id' => 'required',
            'product_id' => 'required',
            'captcha' => ['required','Captcha']


        ]);



        // dd($request->all());


        $vendor = Vendor::findOrFail($request->vendor_id);
        $product = Product::findOrFail($request->product_id);


        if ($request->storyMedia) {


            $media = $request->storyMedia;


            $fileNameImage = generateFileName($media->getClientOriginalName());

            $media->move(public_path(env('STORY_MEDIAL_UPLOAD_PATH')), $fileNameImage);
        } else {



            $fileNameImage = $product->primary_image;

        }


        $now = new \DateTime();

        $story = story::create([

            'text1' => $request->text1,
            'text2' => $request->text2,
            'vendor_id' => $request->vendor_id,
            'product_id' => $request->product_id,
            'productSlug' => $product->slug,
            'vendorName' => $vendor->name,
            'media' => $fileNameImage,
            'bgcolor' => $request->bgcolor,
            'acceptedByAdmin' => $now

        ]);


        $storyAmount = self::paymentStatusIn('storyPayStatus');

        if (self::totalPaymentStatus() && $storyAmount > 0) {

            
            session()->flash('storyStore', 'استوری شما با موفقیت ثبت شد و پس از پرداخت منتشر خواهد شد');


            $story->update([
                'paymentStatus' => 'inPaymentQueue'
            ]);


            $des = "استوری محصول".$product->name;
            $order = Orders::create([

                'user_id' => Auth::user()->id,
                'orderType' => 'story',
                'typeId' => $story->id,
                'linkBack' => "user.story.index",
                'totalAmount' => $storyAmount,
                "description"=>$des

            ]);


            // dd($order);



            return redirect()->route('user.payPage', ['id' => $order->id]);



        } else {


            $story->update([
                'paymentStatus' => 'free'
            ]);
            session()->flash('storyStore', 'استوری شما با موفقیت منتشر شد');
        }


        return redirect()->route('user.story.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestoryRequest  $request
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestoryRequest $request, story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(story $story)
    {
        
        $story->delete();

        session()->flash('storyStore', 'استوری شما با موفقیت حذف شد ');

        return redirect()->back();
    
    }




    public function ajaxGetVendorsStory(Request $request)
    {



        $request->validate([
            'id' => 'required',
            'andis' => 'required',
        ]);

        $vendor = Vendor::findOrFail($request->id);

        $stories = $vendor->activeStories;

        $allvendors = Vendor::all();


        $nextAndis = $request->andis + 1;


        // if(count($allvendors[$nextAndis]->activeStories)>0){
        //     $nextIsAvailable = 1;
        // }else{
        $nextIsAvailable = 0;
        // }




        return response()->json([
            'stories' => $stories,
            'nextIsAvailable' => $nextIsAvailable
        ], 200);



    }


    public function ajaxGetMyStories(Request $request)
    {


        $stories = Auth::user()->vendor->activeStories;


        return response()->json([
            'stories' => $stories,

        ], 200);


    }


    public function restory(Request $request){
        $request->validate([
            "story_id"=>"required" 
        ]);

        
        $lastStory = story::withTrashed()->findORFail($request->story_id);
        $product = Product::find($lastStory->product_id);
        
        if (is_null($product)) {
            
            session()->flash('accepted', 'محصول مورد نطر یافت نشد');

            return redirect()->back();

        }
        


        
        $now = new \DateTime();

        $newStory = story::Create([
            
            'text1' => $lastStory->text1,
            'text2' => $lastStory->text2,
            'vendor_id' => $lastStory->vendor_id,
            'product_id' => $lastStory->product_id,
            'productSlug' => $lastStory->productSlug,
            'vendorName' => $lastStory->vendorName,
            'media' => $lastStory->media,
            'bgcolor' => $lastStory->bgcolor,
            'acceptedByAdmin' => $now

        ]);

        
        $storyAmount = self::paymentStatusIn('storyPayStatus');

        

        if (self::totalPaymentStatus() && $storyAmount > 0) {

            
            session()->flash('storyStore', 'استوری شما با موفقیت ثبت شد و پس از پرداخت منتشر خواهد شد');


            $newStory->update([
                'paymentStatus' => 'inPaymentQueue'
            ]);


            $des = "استوری محصول".$product->name;
            $order = Orders::create([

                'user_id' => Auth::user()->id,
                'orderType' => 'story',
                'typeId' => $newStory->id,
                'linkBack' => "user.story.index",
                'totalAmount' => $storyAmount,
                "description"=>$des

            ]);


            // dd($order);



            return redirect()->route('user.payPage', ['id' => $order->id]);



        } else {


            $newStory->update([
                'paymentStatus' => 'free'
            ]);
            session()->flash('accepted', 'استوری شما با موفقیت منتشر شد');
        }



        return redirect()->back();

    }







}