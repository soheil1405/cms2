<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\ArtcilePictures;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(20);

        $parentCats = Category::where('parent_id', '0')->latest()->get();

        $moreCats = Category::where('parent_id', '!=', '0')->latest()->get();

        if ($request->search) {




            $categories = Category::where('name', "LIKE", '%' . $request->search . "%")->paginate(20);

        }



        return view('admin.categories.index', compact('categories', 'parentCats', 'moreCats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::all();
        $attributes = Attribute::all();
        $images = ArtcilePictures::all();



        return view('admin.categories.create', compact('parentCategories', 'attributes', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
            'icon' => 'mimes:jpg,jpeg,png',
        ]);

        try {
            DB::beginTransaction();

            $category = Category::create([
                'name' => $request->name,
                'slug' => str_replace(' ', '-', $request->name),
                'parent_id' => $request->parent_id,
                'description' => $request->description,
            ]);

            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path(env('CATEGORY_ICON_UPLOAD_PATH'));
                $image->move($destinationPath, $name);
                $category->update(
                    [
                        'icon' => $name
                    ]
                );
            }



            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد دسته بندی', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::all();
        $attributes = Attribute::all();

        $images = ArtcilePictures::all();


        return view('admin.categories.edit', compact('category', 'parentCategories', 'attributes', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
            // 'attribute_ids' => 'required',
            // 'attribute_ids.*' => 'exists:attributes,id',
            // 'attribute_is_filter_ids' => 'required',
            // 'attribute_is_filter_ids.*' => 'exists:attributes,id',
            // 'variation_id' => 'required|exists:attributes,id',
            // 'icon' => 'mimes:jpg,jpeg,png',
        ]);

        try {
            DB::beginTransaction();

            $category->update([
                'name' => $request->name,
                // 'slug' => str_replace(' ', '-', $request->name),
                'parent_id' => $request->parent_id,
                'description' => $request->description,
            ]);

            // if($request->hasFile('icon'))
            // {
            //     if( !is_null($category->icon) )
            //     {
            //         File::delete(public_path(env('CATEGORY_ICON_UPLOAD_PATH')).$category->icon);
            //     }
            //     $image = $request->file('icon');
            //     $name = time().'.'.$image->getClientOriginalExtension();
            //     $destinationPath = public_path(env('CATEGORY_ICON_UPLOAD_PATH'));
            //     $image->move($destinationPath, $name);
            //     $category->update(
            //         [
            //             'icon'      => $name
            //         ]
            //     );
            // }

            // $category->attributes()->detach();

            // foreach ($request->attribute_ids as $attributeId) {
            //     $attribute = Attribute::findOrFail($attributeId);
            //     $attribute->categories()->attach($category->id, [
            //         'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
            //         'is_variation' => $request->variation_id == $attributeId ? 1 : 0
            //     ]);
            // }

            DB::commit();
            return redirect()->route('admin.categories.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش دسته بندی', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Request $request)
    {

        $category = Category::findOrFail($request->id);

        $secontCat = Category::findOrFail($request->cat_id);

        $catChilds = $category->childrens;

        if ($category->parent_id) {

            if (count($catChilds) > 0) {


                foreach ($catChilds as $child) {

                    $child->update([
                        'parent_id' => $category->parent_id
                    ]);
                }

                $this->moveProducts($category->id, $secontCat->id);

                $name = $category->name;

                $category->delete();

                $msg = "دسته ی  " . $name . " با موفقیت حذف شد و محصولات آن به دسته ی " . $secontCat->name . "انتقال داده شد  ";

                session()->flash('deleted', $msg);
                return redirect()->route('admin.categories.index');
            } else {

                $this->moveProducts($category->id, $secontCat->id);

                $name = $category->name;

                $category->delete();

                $msg = "دسته ی  " . $name . " با موفقیت حذف شد و محصولات آن به دسته ی " . $secontCat->name . "انتقال داده شد  ";

                return redirect()->route('admin.categories.index');

            }

        } else {

            foreach ($catChilds as $child) {
                $child->update([
                    'parent_id' => 0
                ]);
            }

            $this->moveProducts($category->id, $secontCat->id);



            $name = $category->name;

            $category->delete();

            $msg = "دسته ی  " . $name . " با موفقیت حذف شد و محصولات آن به دسته ی " . $secontCat->name . "انتقال داده شد  ";

            session()->flash('deleted', $msg);
            return redirect()->route('admin.categories.index');
        }


    }

    public function getCategoryAttributes(Category $category)
    {
        $attributes = $category->attributes()->wherePivot('is_variation', 0)->get();
        $variation = $category->attributes()->wherePivot('is_variation', 1)->first();

        return ['attrubtes' => $attributes, 'variation' => $variation, 'category' => $category];
    }

    public function getCategoryChildrens(Request $request)
    {
        $child = Category::where('id', $request->id)->get();
        return response()->json($child, 200);
    }

    public function searchAjax(Request $request)
    {

        $chars = $request->chars;

        try {
            if($chars != ""){
   
                $category = Category::where('name', 'LIKE', '%' . $chars . '%')->where('parent_id' , "!=" , "0")->OrderByDesc('parent_id')->get();
                
                return response()->json($category, 206);
            }

        } catch (Exception $e) {

        }

    }




    function moveProducts($cat1, $cat2)
    {


        $products = Product::where('lvl_one_category_id', $cat1)->get();

        foreach ($products as $product) {
            $product->update([
                'lvl_one_category_id' => $cat2
            ]);
        }

    }

}