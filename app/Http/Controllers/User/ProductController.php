<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\ProductAttributeController;
use App\Http\Controllers\User\ProductVariationController;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SiteSidBarAdds;

use App\Models\Category;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductComments;
use App\Models\Admin\SpecialProducts;
use App\Models\favorite;
use App\Models\ProductVariation;
use App\Models\story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        // $products = Product::latest()->orderBy('ladder_product', 'desc');

        


        $products = resolve(ProductRepository::class)->index();
        
        
        
        
        // dd($products);

        // $PinnedProducts = resolve(ProductRepository::class)->pinned();

        
        


        $brands = [];

        
        $sideAddLinks = SiteSidBarAdds::where('status' , 1)->whereNotNull('showInProducts')->get(); 


        

        foreach($products as $product){
            
            $is = 'no';
            

            foreach($brands as $brand){
                if($brand->id  == $product->brand->id){
                    $is = 'yes';
                }
            }
            if($is == "no"){
                array_push($brands, $product->brand);
            }
        }
        
        $buyGuid = null;

        
        

        
        
        return view('ListOf.AllProducts', compact('products' , 'sideAddLinks' , 'buyGuid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::all();

        return view('user.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
dd("asdasdasd");
        $validateArr = [
            'name' => 'required',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,svg',
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
        ];


        if(is_null($request->brand_id) && is_null($request->newBrand)){
             $validateArr = array_merge( $validateArr , ["brand_id"=>"required"]);
        }


        $request->validate($validateArr);


        try {
            DB::beginTransaction();
            $vendor = Auth::user()->vendor;

            $productImageController = new ProductImageController();
            $fileNameImages = $productImageController->upload($request->primary_image, $request->images , $vendor->id);

            $product = Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'primary_image' => $fileNameImages['fileNamePrimaryImage'],
                'description' => $request->description,
                'is_active' => $request->is_active, 'ladder_product'=>now() ,
                'status'=>'new',
            ]);

            foreach ($fileNameImages['fileNameImages'] as $fileNameImage) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $fileNameImage,
                ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($request->attribute_ids, $product);

            $category = Category::find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->store(
                $request->variation_values,
                $category
                    ->attributes()
                    ->wherePivot('is_variation', 1)
                    ->first()->id,
                $product,
            );

            $product->tags()->attach($request->tag_ids);

            DB::commit();

            $vendor->update([
                'product_count' => $vendor->product_count + 1,
            ]);

            alert()->success('محصول مورد نظر ایجاد شد و پس از تایید نهایی منتشر خواهد شد ...', 'باتشکر');
            return redirect()->route('user.products.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()
                ->error('مشکل در ایجاد محصول', $ex->getMessage())
                ->persistent('حله');
            return redirect()->back();
        }
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

    
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $productAttributes = $product
            ->attributes()
            ->with('attribute')
            ->get();
        $productVariations = $product->variations;
        return view('user.products.edit', compact('product', 'brands', 'tags', 'productAttributes', 'productVariations'));
    }

    
    public function update(Request $request, Product $product)
    {

        
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'required',
            'attribute_values' => 'required',
            'variation_values' => 'required',
            'variation_values.*.price' => 'required|integer',
            'variation_values.*.quantity' => 'required|integer',
            'variation_values.*.sale_price' => 'nullable|integer',
            'variation_values.*.date_on_sale_from' => 'nullable|date',
            'variation_values.*.date_on_sale_to' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'lvl_one_category_id' => $request->category_id,
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->update($request->attribute_values);

            $productVariationController = new ProductVariationController();
            $productVariationController->update($request->variation_values);

            $product->tags()->sync($request->tag_ids);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()
                ->error('مشکل در ویرایش محصول', $ex->getMessage())
                ->persistent('حله');
            return redirect()->back();
        }

        alert()->success('محصول مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('user.products.index');
    }

    
    public function destroy(Request $request)
    {



        $product = Product::findOrFail($request->id)->delete();


        $comment = ProductComments::where('product_id', $request->id)->get();
        foreach($comment as $item ){
            $item->delete();
        }
    
        $special_p = SpecialProducts::where('product_id', $request->id)->get();
        foreach($special_p as $s){
            $s->delete();
        }


        $story = story::where('product_id', $request->id)->get();
        foreach ($story as $s) {
            $s->delete();
        }


        $favorites = favorite::where('product_id', $request->id)->get();
        foreach ($favorites as $s) {
            $s->delete();
        }


        $vendor = Auth::user()->vendor;
        $vendor->update([
            'product_count' => $vendor->product_count - 1,
        ]);


        DB::commit();
        return redirect()->route('user.products.index');
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
                'category_id' => $request->category_id,
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

        alert()->success('محصول مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('user.products.index');
    }

    public function search()
    {
        // if(\request()->filled('btnradioSearch')){
        //     switch(\request()->filled('btnradioSearch')){
        //         case
        //     }
        // }‍
    }

    public function ladder_product(Product $product)
    {
    }

    public function HomeIndex()
    {
        $products = Product::isAvailable()->paginate(12);

        return $products;
    }
    public function Home_most_view_products($count)
    {



        $most_view_products = resolve(ProductRepository::class)->most_view_products($count);

        return $most_view_products;
    }



    public function HomePopulars($count){
        
        $HomePopulars = resolve(ProductRepository::class)->HomePopulars($count);

        return $HomePopulars;

    }

}
