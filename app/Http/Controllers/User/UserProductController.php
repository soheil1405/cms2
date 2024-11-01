<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ProductAttributeController;
use App\Http\Controllers\User\ProductImageController;
use App\Http\Controllers\User\ProductVariationController;
use App\Models\Admin\SpecialProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Repositories\AdminMessageRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Auth::user()->vendor
            ->products()->latest()
            ->paginate(20);

        if ($request->search) {
            $products = Auth::user()->products()->where('name', 'LIKE', '%' . $request->search . '%')->paginate(20);
        }



        
        $massages = Auth::user()->vendor->AdminMassages;

        $unread_massages = $massages->where('seen_at', null);

        $unread_product_massages = 0;
        $unread_vendor_massages = 0;

        foreach ($unread_massages as $massage) {
            if ($massage->subject == 'ویرایش محصول' || $massage->subject == 'تایید محصول') {
                $unread_product_massages++;
            }
        }



        return view('user.products.index', compact('products' , 'unread_product_massages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Session::all();

        // if(session('data')){

        //     $data = session('data');

        //     dd($data);

        // }

        $vendor_id = Auth::user()->vendor->id;
        $brands = Brand::where('is_active', '1')->OrWhere('vendor_id', $vendor_id)->orderBy('name')->get();


        $freeBrand = Brand::find(146);

        $vendorCreatedBrand = Brand::where('id', '!=', 146)->OrderByDesc('id')->where('vendor_id', $vendor_id)->first();

        // dd($brands);

        $tags = Tag::all();
        $categories = Category::all();
        $defualt_image = public_path(env('PRODUCT_DEFUALT_IMAGES_PATH'));

        return view('user.products.create', compact('brands', 'freeBrand', 'vendorCreatedBrand', 'tags', 'defualt_image', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        
        
        
        if($request->newBrand == "on" && $request->newBrandName != null){
            $brand = Brand::where('name', $request->newBrandName)->first();
            if (is_null($brand)) {
                $brand = Brand::create([
                    'name' => $request->newBrandName,
                    'vendor_id' => Auth::user()->vendor->id,
                    'slug' => \Str::slug($request->newBrandName),
                ]);
            }
            $request->brand_id = $brand->id;
        }
        

        // dd($request->all(), $request->brand_id);
        // if(!isset($brandId)){
        //     $request->validate([
        //         "brand_id"=>"required"
        //     ]);
        // }


    
        session()->flash('lastBrand' , $request->brand_id);


        $followers = Auth::user()->vendor->followers;

        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'is_active' => 'nullable',
            'product_price' => 'nullable',
            'brand_id'=>'required',
            'tag_ids' => 'nullable',
            'description' => 'nullable',
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'images' => 'nullable',
            'images.*' => 'mimes:jpg,jpeg,png,svg',
            'category_id' => 'required',
            'variation_values' => 'nullable',
            'variation_values.*.*' => 'nullable',
            'variation_values.price.*' => 'nullable|integer',
            'variation_values.quantity.*' => 'nullable|integer',
        ]);
        // try {

            DB::beginTransaction();


            $product_price =  convertPersianToEnglishNumber($request->product_price);

            
            $product_price = removeCarsInsideNumbers($product_price);
            

            $vendor = Auth::user()->vendor;

            if ( $request->has('images')) {
                $primary_image = $request->images[0];

            $productImageController = new ProductImageController();
                $fileNameImages = $productImageController->upload($request->images , null , null , $vendor->id);
                $primary_image = $fileNameImages['fileNameImages'][0];
                if(!is_null($request->mainImg) ){
                    $primary_image = $fileNameImages['fileNameImages'][(int) $request->mainImg];
                }
            }else{
        
                $primary_image = 'product-default-limage.jpg';
                $fileNameImages['fileNameImages'] = null;
            }

            // $vendorName = Username::setModel(Product::class)
            // ->setColum('name')
            // ->make(str_replace(' ', '-', $request->name));

            $slug = str_replace(" ", "-", $request->name);
            $slug = str_replace("/", "-", $slug);

            $latestProductCreated = Product::select('id')->latest()->take(1)->first();

            
            $slug = $slug . "-" . $latestProductCreated->id;
    

            

            // dd($slug);

            $product = Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'lvl_one_category_id' => $request->category_id,
                'primary_image' => $primary_image,
                'description' => nl2br($request->description),
                'is_active' => 1,
                'vendor_id' => $user->vendor->id,
                'user_id' => $user->id,
                "ladder_product"=>Carbon::now() ,
                'delivery_amount' => 0,
                'status' => 'new',
                'delivery_amount_per_product' => 0,
                'Warranty' => $request->warrantyInputHidden,
                'product_price' => $product_price,
                "slug" => $slug,
                'apatatVideoLink' => $request->apatatVideoLink,
            ]);

            $category = Category::find($request->category_id);
            $product->categories()->sync(
                $category->all_parents()->map(function ($item, $key) {
                    return $item->id;
                }),
            );

            if ($fileNameImages['fileNameImages']) {
                foreach ($fileNameImages['fileNameImages'] as $fileNameImage) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileNameImage,
                    ]);
                }
            }

            if ($request->lastImages) {
                foreach ($request->lastImages as $fileNameImage) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileNameImage,
                    ]);
                }
            }
            // if($request->has('attribute_ids'))
            // {
            //     $productAttributeController = new ProductAttributeController();
            //     $productAttributeController->store($request->attribute_ids, $product);
            // }

            $category = Category::find($request->category_id);
            // $productVariationController = new ProductVariationController();
            // $productVariationController->store($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

            $product->tags()->attach($request->tag_ids);
            $vendor->update([
                'product_count' => $vendor->product_count + 1,

            ]);

            DB::commit();

        // } catch (\Exception $ex) {
        //     DB::rollBack();
        //     alert()->error('اشتباه در درج اطلاعات محصول')->persistent('حله');
        //     return redirect()->back();
        // }
        //
        // $vendor = $product->vendor;

        // resolve(AdminMessageRepository::class)->SendMassageToFollowers($followers, $vendor, $product);


        alert()->success('  محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد', 'باتشکر');

        return redirect()->route('user.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        $productAttributes = $product
            ->attributes()
            ->with('attribute')
            ->get();
        $productVariations = $product->variations;
        $images = $product->images;

        return view('user.products.show', compact('product', 'productAttributes', 'productVariations', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // dd($product , json_decode($product->EditedData , true));
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();


        $vendor_id = Auth::user()->vendor->id;

        $freeBrand = Brand::find(146);

        $vendorCreatedBrand = Brand::where('id', '!=', 146)->OrderByDesc('id')->where('vendor_id', $vendor_id)->first();

        $productAttributes = $product
            ->attributes()
            ->with('attribute')
            ->get();
        $productVariations = $product->variations;

        return view('user.products.edit', compact('product', 'categories', 'brands', 'tags', 'productAttributes', 'productVariations' , 'freeBrand' , 'vendorCreatedBrand') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {



        
        
        
        
        $request->validate([
            'name' => 'required',
            'is_active' => 'nullable',
            'tag_ids' => 'nullable',
            'product_price' => 'nullable',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'nullable',
            'attribute_values' => 'nullable',
            'variation_values' => 'nullable',
            'variation_values.*.price' => 'nullable|integer',
            'variation_values.*.quantity' => 'nullable|integer',
            'variation_values.*.sale_price' => 'nullable|integer',
            'variation_values.*.date_on_sale_from' => 'nullable|date',
            'variation_values.*.date_on_sale_to' => 'nullable|date',
        
        ]);



        if($request->deletedImageIds){
            $deletedImageids = explode("-" , $request->deletedImageIds);
            foreach ($deletedImageids as $imageid) {   
                if($imageid != ""){
                    $this->deleteImage($imageid , $product);
                }
            }
        }



        

        $vendor = Auth::user()->vendor;

         
         if ( $request->images   && count($request->images)>0 && $request->images[0] ) {
    
            $productImageController = new ProductImageController();
            $fileNameImages = $productImageController->upload($request->images , $product , $request , $vendor->id);
    
            if($request->primaryImage && array_key_exists($request->primaryImage , $fileNameImages["fileNameImages"])){
                $request->primaryImage = $fileNameImages["fileNameImages"][$request->primaryImage];
            }elseif($product->primary_image == "product-default-limage.jpg"){
                $request->primaryImage = $fileNameImages["fileNameImages"][0];
            }
        }

        if ($request->lastImages) {
            foreach ($request->lastImages as $fileNameImage) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $fileNameImage,
                ]);
            }
        }

        if ($request->primaryImage) {
            resolve(ProductImageController::class)->setPrimary($request->primaryImage , $product);
        }
        




        
        $brandId = $request->brand_id;
        if($request->newBrand == "on" && $request->newBrandName != null){
            $brand = Brand::where('name', $request->BrandName)->first();
            if (is_null($brand)) {
                $brand = Brand::create([
                    'name' => $request->newBrandName,
                    'vendor_id' => Auth::user()->vendor->id,
                    'slug' => \Str::slug($request->newBrandName),
                ]);
            }
            $brandId = $brand->id;
        }
        
        if(is_null($brandId)){
    
            $brandId = $product->brand->id;
       
            
        }
        try {
            DB::beginTransaction();
            $arr = [];
            $product_price =  convertPersianToEnglishNumber($request->product_price);
            $product_price = removeCarsInsideNumbers($product_price);
            
            $data =  array_merge(
                $request->only(
                    [
                    'name',
                    'description',
                    'apatatVideoLink'
                    ]
                )
                , 
                [
                "category_id" => $request->category_id ? $request->category_id : $product->lvl_one_category_id  ,
                "brand_id" => $brandId ,
                "product_price"=>$product_price ,

                ]
            );
 
            
            
            $editor = Auth::user()->id;

            $moreDetails = [
                'editor' => $editor,
                'time' => Carbon::now(),
            ];


            if (!$request->warrantyInputHidden ) {
                $request->warrantyInputHidden = $product->Warranty;
            }
            

            if ($product->status == "new") {

                // dd($request->all());


                $product->update([
                    'name' => $request->name,
                    'brand_id' => $brandId,
                    'description' => nl2br($request->description),
                    'apatatVideoLink' => $request->apatatVideoLink,
                    'product_price'=>$product_price ,
                    "primary_image"=>$request->primaryImage ? $request->primaryImage : $product->primary_image  , 
                    "Warranty"=>$request->warrantyInputHidden,
                    'lvl_one_category_id' => $request->category_id ? $request->category_id : $product->lvl_one_category_id,
                ]);

                session()->flash('update', 'محصول مورد نظر با موفقیت ویرایش  شد و پس از تایید نهایی منتشر خواهد شد');
                // alert()->success('  محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد', 'باتشکر');

                return redirect()->route('user.products.index');
            } else {

                array_push($data, $moreDetails);


                $josnedData = json_encode([$data]);

                // if (is_null($product->EditedData)) {

                $product->update([

                    'EditedData' => $josnedData,
                    'status' =>  $product->getNewStatusAfterUpdate(),
                    'Warranty' => $request->warrantyInputHidden ,
                    'EditReportText' => null,
                ]);
                // } else {

                    // $LastUpdated = json_decode($product->EditedData);

                    // $myArr = [];

                    // foreach ($LastUpdated as $item) {

                    //     array_push($myArr, $item);
                    // }

                    // array_push($myArr, json_decode(json_encode($data)));

                    // array_merge($LastUpdated, [$josnedData]);
                //     $product->update([
                //         'EditedData' => $myArr,
                //         'status' =>  $product->status == "new" ? "new" : 'edited',
                //         'Warranty' => $request->warrantyInputHidden,
                //         'EditReportText' => null,
                //     ]);
                // }

                // dd($request->all());
                // if ($request->has('attribute_values')) {
                //     $productAttributeController = new ProductAttributeController();
                //     $productAttributeController->update($request->attribute_values);
                // }
                // if ($request->has('variation_values')) {
                //     $productVariationController = new ProductVariationController();
                //     $productVariationController->update($request->variation_values);
                // }
                // if ($request->has('tag_ids')) {
                //     $product->tags()->sync($request->tag_ids);
                // }
                DB::commit();
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()
                ->error('مشکل در ویرایش محصول', $ex->getMessage())
                ->persistent('حله');
            return redirect()->back();
        }

        resolve(AdminMessageRepository::class)->SendEditMessage($product);

        session()->flash('update', 'محصول مورد نظر با موفقیت ویرایش  شد و پس از تایید نهایی منتشر خواهد شد');
        // alert()->success('  محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد', 'باتشکر');

        return redirect()->route('user.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function editCategory(Request $request, Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('user.products.edit_category', compact('product', 'categories'));
    }

    public function updateCategory(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
        ]);
        try {
            DB::beginTransaction();

            $product->update([
                'lvl_one_category_id' => $request->category_id,
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->change($request->attribute_ids, $product);

            $category = Category::find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->change(
                $request->variation_values,
                $category
                    ->attributes()
                    ->wherePivot('is_variation', 1)
                    ->first()->id,
                $product,
            );

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()
                ->error('مشکل در ایجاد محصول', $ex->getMessage())
                ->persistent('حله');
            return redirect()->back();
        }

        alert()->success('  محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد', 'باتشکر');
        return redirect()->route('user.products.index');
    }

    public function ladderProduct(Request $request)
    {

        $pay = self::paymentStatusIn('LadderPPayStatus');

        $product = Product::findOrFail($request->product);

        if (self::totalPaymentStatus() && $pay > 0) {

            $des = "نردبان محصول " . $product->name;

            $order = Orders::create([
                'user_id' => Auth::user()->id,
                'orderType' => 'ladderPPay',
                'typeId' => $product->id,
                'linkBack' => "user.products.index",
                'totalAmount' => $pay,
                "description" => $des,
            ]);

            return redirect()->route('user.payPage', ['id' => $order->id]);
        } else {

            try {
                $request->validate([
                    'product' => 'required',
                ]);

                $mytime = Carbon::now();

                $time = $mytime->toDateTimeString();

                $product->update([
                    'ladder_product' => $time,
                ]);

                $spc = SpecialProducts::where('product_id', $product->id)->first();

                if (!is_null($spc)) {
                    $spc->update([

                        'ladder_product' => $time,

                    ]);
                }

                alert()->success('محصول مورد نظر با موفقیت نزدیان شد', 'باتشکر');
                return redirect()->back();
            } catch (Exception $e) {
                alert()
                    ->error('مشکل در نزدیان محصول', $e->getMessage())
                    ->persistent('حله');
                return redirect()->back();
            }
        }
    }

    public function finalEdit($id)
    {

        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();

        $productAttributes = $product
            ->attributes()
            ->with('attribute')
            ->get();

        $productVariations = $product->variations;

        return view('user.products.finalEdit', compact('product', 'categories', 'brands', 'tags', 'productAttributes', 'productVariations'));
    }

    public function finalSubmitCreatingProduct($pid)
    {

        $product = Product::findOrFail($pid);

        alert()->success('محصول مورد نظر ایجاد شد', 'باتشکر');
        resolve(AdminMessageRepository::class)->sendCreateProductMessage($product);

        session()->flash('created', 'محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد');
        return redirect()->route('user.products.index');
    }

    public function pinproducts(Request $request)
    {

        $product = Product::findOrFail($request->id);

        $vendor = Auth::user()->vendor;

        if ($product->vendor_id != Auth::user()->vendor->id) {

            $msg = "خطا";

            session()->flash('created', $msg);
        }

        $pname = $product->name;

        if ($request->pin_number == 0) {

            $msg = " محصول  " . $pname . "با موفقیت از حالت پین برداشته شد";

            $product->update([
                'VendorPinNumber' => null
            ]);

            session()->flash('created', $msg);

            return redirect()->back();
        } else {
            $products = $vendor->products;

            foreach ($products as $item) {

                if ($item->VendorPinNumber == $request->pin_number) {

                    $msg = " شما قبلا محصول  " . $item->name . "را به پین " . $request->pin_number . "  اختصاص داده اید";

                    session()->flash('created', $msg);

                    return redirect()->back();
                }
            }

            $product->update([
                'VendorPinNumber' => $request->pin_number,
            ]);

            $msg = " محصول  " . $pname . "با موفقیت  پین شد";

            session()->flash('created', $msg);

            return redirect()->back();
        }
    }
}
