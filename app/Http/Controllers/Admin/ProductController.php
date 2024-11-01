<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SpecialProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\favorite;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\story;
use App\Models\Tag;
use App\Models\Vendor;
use App\Repositories\AdminMessageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $orderBy = $request->OrderBy;

        if (is_null($request->OrderBy)){
            $orderBy = "status";  
        }


        $products = Product::when($orderBy , function($query) use($orderBy){
            if($orderBy == "status"){
              return $query->orderBy($orderBy);
            }elseif($orderBy == "product_price asc"){
                return $query->orderBy("product_price");
            }elseif($orderBy == "product_price desc"){
                return $query->orderByDesc("product_price");
            }
            return $query->orderByDesc($orderBy);
        });

        $products = $products->latest()
        
        ->get();
        // ->pagina/te(20);
        
        $products_in_Queue = Product::where('status', '!=', 'yes')->where('status', '!=', 'reported')->get();

        $count_of_products_in_Queue = count($products_in_Queue);

        $reported = Product::where('status', 'reported')->get();

        if ($request->search) {
            $products = Product::where('name', 'LIKE', "%" . $request->search . "%")->paginate(20);
        }

        if ($request->excelExport) {

            ob_end_clean();
            ob_start();

            return Excel::download(new \App\Exports\GeneralExportExcel($products, 'allP'), 'instabargh.products' . now() . '.xlsx');

        }

        return view('admin.products.index', compact('products', 'reported', 'products_in_Queue', 'count_of_products_in_Queue'));

    }

    public function products_in_Queue()
    {

        $products_in_Queue = Product::where('status', '!=', 'yes')->where('status', '!=', 'reported')->get();

        $count_of_products_in_Queue = count($products_in_Queue);

        $reported = Product::where('status', 'reported')->get();

        return view('admin.products.products_in_Queue', compact('reported', 'products_in_Queue', 'count_of_products_in_Queue'));

    }

    public function show($id)
    {
        $product = Product::find($id);
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $images = $product->images;

        return view('admin.products.show', compact('product', 'productAttributes', 'productVariations', 'images'));
    }

    public function edit($id)
    {
        $product = Product::find($id);


        
        $brands = Brand::all();
        $tags = Tag::all();
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $categories = Category::all();


        $freeBrand = Brand::find(146);
        
        return view('admin.products.edit', compact('product', 'brands','freeBrand' , 'tags', 'productAttributes', 'productVariations', 'categories'));

    }

    public function update(Request $request, $id)
    {

        
        $product = Product::find($id);
        
        
        // try {
            DB::beginTransaction();

            if (!$request->warrantyInputHidden) {
                $request->warrantyInputHidden = $product->Warranty;
            }
            $newCat = $product->lvl_one_category_id;

            if ($request->category_id != null ){
                $newCat = $request->category_id;
        
            }

            
            $product->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'is_active' => 1,
                'status' => 'yes',
                'EditedData' => null,
                'product_price'=>$request->product_price,
                'EditReportText' => null,
                'lvl_one_category_id' => $newCat,
                'apatatVideoLink'=>$request->apatatVideoLink
            ]);


            
            
            foreach ($product->Allimages as $image) {
                
                if($image->status != "active"){
                    $image->update([
                        "status" =>"active"
                    ]);
                }
            }

            // $productAttributeController = new ProductAttributeController();
            // $productAttributeController->update($request->attribute_values);

            // $productVariationController = new ProductVariationController();
            // $productVariationController->update($request->variation_values);

            // $product->tags()->sync($request->tag_ids);

            DB::commit();

            
        // } catch (\Exception $ex) {
        //     DB::rollBack();
        //     alert()->error('مشکل در ویرایش محصول', $ex->getMessage())->persistent('حله');
        //     return redirect()->back();
        // }

        alert()->success('محصول مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.products.index');

    }
    public function destroy(Request $request)
    {


        


        
        
        $product = Product::findOrFail($request->id);

        $story = story::where("product_id" , $product->id)->get();

        $specialP = SpecialProducts::where("product_id" , $product->id)->get();

        $favorites = favorite::where("product_id" , $product->id)->get();

        foreach ($story as $s) {
            $s->delete();
            
        }

        foreach ($favorites as $s) {
            $s->delete();
            
        }

        foreach ($specialP as $s) {
            $s->delete();
            
        }



        $product->delete();


        DB::commit();

        return redirect()->route('admin.products.index');

    }

    public function acceptProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $product = Product::find($request->id);

        
        if($product->vendor->status == "new"){
                      
            session()->flash('fail' , 'لطفا ابتدا فروشگاه را تایید کنید');
            return redirect()->back();
        }


        if($product->status == "new"){
            $product->update([
                'ladder_product' => Carbon::now()
            ]);
        }

        $product->update([
            'status' => "yes",
            'EditedData' => null,
            'EditReportText' => null,
        ]);

        foreach ($product->Allimages as $imnage) {
            $imnage->update([
                'status' => 'active',
            ]);
        }

        
        resolve(AdminMessageRepository::class)->SendAcceptProductMessage($product);

        alert()->success('محصول مورد نظر با موفقیت منتشر شد');

        return redirect()->back();

    }

    public function ladderProduct(Request $request)
    {
        try {
            $request->validate([
                'product' => 'required',
            ]);

            $mytime = Carbon::now();

            $time = $mytime->toDateTimeString();

            $product = Product::find($request->product);

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

            alert()->error('مشکل در نزدیان محصول', $e->getMessage())->persistent('حله');
            return redirect()->back();
        }

    }

    public function productEditList($id)
    {

        $product = Product::findOrFail($id);

        $newDatas = $product->EditedData;

        $images = $product->Allimages;

        $primaryImage = ProductImage::where('image', $product->primary_image)->first();

        $brands = Brand::orderBy('name')->get();

        $categories = Category::where('parent_id', '>', '0')->get();

        if (!is_null($newDatas) && $product->type == "edited") {

            $data = json_decode($newDatas);

            if (count($data) > 0) {

                return view('admin.products.productEditList', compact('categories', 'brands', 'product', 'images', 'data', 'primaryImage'));

            }

        }

    }

    public function deleteChanges(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        $product->update([

            'status' => 'yes',
            'EditedData' => null,
            'EditReportText' => null,

        ]);

        session()->flash('success', 'تعییرات محصول ' . $product->name . "حذف شد");
        return redirect()->route('admin.products.index');

    }

    public function saveChanges(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required',
            'description' => 'required',
            'product_id' => 'required|exists:products,id',

        ]);

        $product = Product::findOrFail($request->product_id);

        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'lvl_one_category_id' => $request->category_id,
            'description' => $request->description,
            'status' => 'yes',
            'EditedData' => null,
            'EditReportText' => null,
        ]);

        foreach ($product->Allimages as $imnage) {
            $imnage->update([
                'status' => 'active',
            ]);
        }

        session()->flash('success', 'تعییرات محصول ' . $product->name . "با موفقیت تایید شد");
        return redirect()->route('admin.products.index');

    }

    public function reportChanges(Request $request)
    {


        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->text && $request->textStatus == "1") {

            $product->update([
                'type' => 'edited-reported',
                'status' => "reported",
                'EditReportText' => $request->text,

            ]);
            session()->flash('success', 'تعییرات محصول ' . $product->name . "با موفقیت ریپورت شد");
            return redirect()->route('admin.products.index');

        } else {

            $product->update([
                'status' => "reported",
            ]);

            session()->flash('success', 'تعییرات محصول ' . $product->name . "با موفقیت ریپورت شد");
            return redirect()->route('admin.products.index');

        }

    }



    public function deleteByGroup(Request $request){
        
        
       $ids =   explode("," ,$request->pIds);

       $products = Product::whereIn('id' , $ids)->get();

       foreach ($products as $product) {
        
            $this->deleteProductWithDetails($product);
       }


       session()->flash('success' , ' محصولات مورد نظر با موفقیت حذف شدند');

       return redirect()->back();
    }




    public function deleteProductWithDetails($product){

        $specialP = SpecialProducts::where('product_id', $product->id)->get();

        foreach ($specialP as $s) {
            $s->delete();
        }

        $story = story::where('product_id', $product->id)->get();

        foreach ($story as $s) {
            $s->delete();
        }



        $favorites = favorite::where('product_id', $product->id)->get();


        foreach ($favorites as $s) {
            $s->delete();
        }





        $vendor = Vendor::find($product->vendor_id);

        $vendor->update([
            'product_count' => $vendor->product_count - 1,
        ]);

        $product->delete();

    }

}
