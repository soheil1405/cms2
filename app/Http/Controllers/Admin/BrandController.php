<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ProductFilters\slug;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SiteSidBarAdds;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{

    public function index(Request $request)
    {

        $brands = Brand::OrderBy('is_active')->OrderByDesc('id')->get();

        if ($request->search) {

            $brands = Brand::where('name', "LIKE", '%' . $request->search . "%")->take(20)->get();

        }

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {

        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);

        try {

            $image = $request->icon;

            $fileNameImage = generateFileName($image->getClientOriginalName());
            $image->move(public_path(env('BRAND_ICON_UPLOAD_PATH')), $fileNameImage);

            $brand = Brand::where('name', $request->name)->first();

            if (is_null($brand)) {

                Brand::create([
                    'name' => $request->name,
                    'is_active' => 1,
                    'icon_name' => $fileNameImage,

                ]);

                alert()->success('برند مورد نظر ایجاد شد', 'باتشکر');
                return redirect()->route('admin.brands.index');

            } else {
                session()->flash('duplicate', 'برند مورد نظر تکراری است');
                return redirect()->route('admin.brands.create');

            }

        } catch (Exception $e) {

            session()->flash('duplicate', 'برند مورد نظر تکراری است');
            return redirect()->route('admin.brands.create');

        }
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $brand)
    {


        
        if ($request->id) {

            $brand = Brand::findOrFail($request->id);

            $brand->update([

                'is_active' => 1,

            ]);

        } else {

            $request->validate([
                'name' => 'required',
            ]);
            $image = $request->icon;

            if ($image) {

                $fileNameImage = generateFileName($image->getClientOriginalName());
                $image->move(public_path(env('BRAND_ICON_UPLOAD_PATH')), $fileNameImage);

                $brand = Brand::findOrFail($brand);

                $brand->update([
                    'name' => $request->name,
                    'is_active' => 1,
                    'icon_name' => $fileNameImage,
                ]);

            } else {

                $brand = Brand::findOrFail($brand);

                $brand->update([
                    'name' => $request->name,
                    'is_active' => 1,

                ]);

            }

        }

        alert()->success('برند مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.brands.index');
    }

    public function createByUser(Request $request)
    {

        $request->validate([
            'BrandName' => 'required',

        ]);

        // try{

        $brands = Brand::where('name', $request->BrandName)->get();

        if (count($brands) > 0) {
            return response()->json(['error' => 'برند مورد نظر موجود می باشد '], 401);

        }

        $brand = Brand::create([
            'name' => $request->BrandName,
            'vendor_id' => Auth::user()->vendor->id,
            // 'vendor_id' => 1,

            'slug' => \Str::slug($request->name),
        ]);

        return response()->json($brand, 200);

        // }catch(Exception $e){
        //     return response()->json(['massage' => ' خطای سیستمی '], 401);

    }

    public function showByBrand($brandSlug)
    {

        $brand = Brand::where('slug', $brandSlug)->first();

        if (is_null($brand)) {
            return abort(404);
        }

        $products = resolve(ProductRepository::class)->showByBrand($brand->id);
        $brands = Brand::where('is_active', 1)->get();

        $selected_brand = $brand->id;

        $sideAddLinks = SiteSidBarAdds::whereNotNull('showInProducts')->where('status', 1)->get();

        
        $buyGuid = null;
        

        $title = $brand->name;
        

        return view('ListOf.AllProducts', compact('products','title' , 'buyGuid', 'brands', 'selected_brand', 'sideAddLinks'));

    }

    public function HomeIndex()
    {

        $brands = Brand::where('is_active', 1)->orderBy('name')->paginate(50);

        $sideAddLinks = SiteSidBarAdds::where('status', 1)->whereNotNull('showInBrands')->get();

        return view('ListOf.AllBrands', compact('brands', 'sideAddLinks'));

    }

    public function deleteBRand(Request $request)
    {
        $request->validate([

            'brandId' => 'required',
        ]);

        $brand = Brand::findOrFail($request->brandId)->delete();

        $this->gotoWithoutBrandProduct($request->brandId);

        return redirect()->back();
    }

    public function gotoWithoutBrandProduct($id)
    {

        $products = Product::where('brand_id', $id)->get();

        foreach ($products as $product) {

            $product->update(["brand_id" => "146"]);

        }
    }

    public function SearchBrandsAjax(Request $request)
    {

        $request->validate([

            'chars' => 'required',
        ]);

        $brands = Brand::where('name', 'LIKE', '%' . $request->chars . '%')

            ->take(15)
            ->get();

        return response()->json($brands);

    }

    public function createByUser2(Request $request)
    {

        $request->validate([
            'BrandName' => 'required',

        ]);

        

        try {

            $brands = Brand::where('name', $request->BrandName)->first();

            
            if (is_null($brands)) {
                // dd($brands , $request->BrandName);
              
                $brand = Brand::create([
                    'name' => $request->BrandName,
                    'vendor_id' => Auth::user()->vendor->id,
                    // 'vendor_id' => 1,

                    'slug' => \Str::slug($request->name),
                ]);

            } else {

                // dd("Asd");
            }

        } catch (Exception $e) {

            if($request->url && $request->url == "edit"){
                
                $product = Product::findOrFail($request->pid);
    
                return redirect()->route('user.products.edit', [  'product'=>$product , 'data' => $request]);
           
                
            }else{
                return redirect()->route('user.products.create', ['data' => $request]);
           
            }
    
        }

        if($request->url && $request->url == "edit"){
            
            $product = Product::findOrFail($request->pid);

            return redirect()->route('user.products.edit', [  'product'=>$product , 'data' => $request]);
       
            
        }else{
            return redirect()->route('user.products.create', ['data' => $request]);
       
        }


    }

    public function changeBrand(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'brand_id' => 'required',
        ]);
        
        
        $brandToChang = Brand::findOrFail($request->id);

        $secondBrand = Brand::findOrFail($request->brand_id);

        $products = $brandToChang->AllProducts;
        

        
        foreach ($products as $product) {
            // dd($products , $request->all());
            
            $product->update([
                'brand_id' => $secondBrand->id,
            ]);
        }
        
        
        $brandToChang->delete();
        session()->flash('duplicate', 'برند مورد نظر با موفقیت به برند ' . $secondBrand->name . "انتقال داده شد");

        return redirect()->back();

    }

}
