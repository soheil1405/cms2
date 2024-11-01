<?php

namespace App\Http\Controllers\vendors;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpecialProductsController;
use App\Http\Controllers\SpecialVendorsController;
use App\Models\Product;
use App\Models\Vendor;
use App\Repositories\ProductRepository;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Models\SiteSidBarAdds;

class ProductController extends Controller
{


    public function show(Request $request , Vendor $vendor,Product $product  ){

        // dd($product);
        $product->update([
            'view_counter'=> $product->view_counter +1 
        ]);
        //2024_3_4_12_50_25_76523_81b022e0518e65906384973f1c2042dd28af3493_1696187957.jpg
        
        
        
        $countSetting = Setting::first();
        
        

        
        if($request->lastOne){

            $vendorr = Vendor::findOrFail($request->lastOne);

            $this->updateSeenStorySession($vendorr->id);


        }

        
        
        $product = resolve(ProductRepository::class)->show($product->id);



        $vendor = $product->vendor;
        
        
        if($product->status == "new" || $product->status == "reported-edited" || $product->status == "reported"  ){
            return abort(404);
        }


        $samplePr = resolve(ProductRepository::class)->samplePr($product );
        
        
        
        $VendoAnotherProducts = resolve(ProductRepository::class)->VendoAnotherProducts($vendor);
        

        
        
        $vendor = $product->vendor;
        
        
        $specialVendors = Vendor::where('adminVendor' , 'no')->paginate(12);
        $speciallProducts = resolve(SpecialProductsController::class)->get_available($countSetting->SpecialPcount , $product->lvl_one_category_id)->take(6);
        
        $metaDescription = "نام فروشگاه : "  . $vendor->title . " - تلفن ۱ :". $vendor->number . " موبایل : ".$vendor->phone_number . " pآدرس : ". $vendor->address;



        if ($request->has('fId')) {
            $vendorrr = Vendor::findOrFail($request->fId);

            if ($vendorrr->hasActiveStory($vendorrr->id) == 1) {
                $stories = $vendorrr->activeStories;
            } else {
                return redirect()->route('user.dashboard');
            }

        }else{

            $vendorrr = null ;
            $stories = null ;
        }


        
        
        $sideAddLinks = SiteSidBarAdds::where('status' , 1)->whereNotNull('showInSingleProduct')->get(); 

        

        return view('vendors.products.single',compact('vendor','vendorrr' , 'sideAddLinks' , 'stories','product' , 'metaDescription', 'speciallProducts' , 'samplePr' , 'specialVendors' ,'VendoAnotherProducts'));
    }



    public function list(Vendor $vendor)
    {
        $products = $vendor->products()->filter()->paginate(50);
        return view('vendors.products.list',compact('vendor','products'));
    }



    public function Home_most_product_vendors($count){



        

        return Vendor::where('adminVendor' , 'no')->OrderByDesc('product_count')->take($count)->get();
        
    }





}
