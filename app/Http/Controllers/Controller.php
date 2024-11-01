<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\vendors\ProductController as VendorsProductController;
use App\Models\Admin\AdminLog;
use App\Models\Admin\CategoryArticle;
use App\Models\Admin\Setting;
use App\Models\Admin\SiteSetting;
use App\Models\Brand;
use App\Models\Follow;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Sliders;
use App\Models\story;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
class Controller extends BaseController

{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function seenStory(Request $request){

        
        $vendor = Vendor::findOrFail($request->vId);
        
        $session = Session::get('viewStory');
    
        $vid = $vendor->id;

        if(!$session){
            Session::put('viewStory' ,[0=>$vid]);
        }else{
        

            if(is_array($session) ){
              
                if(!in_array($vid , $session)){

                    $data =[];
                    
                    
                    foreach ($session  as $s) {
                    array_push($data , $s);
                }
                
                array_push($data , $vid);

                Session::put("viewStory" , $data);

                }
                
            }else{
                $data = [
                    0=>$session , 
                    1=>$vid
                ];
                Session::put('viewStory' , $data);
            }


        }    
    
    }



    function updateSeenStorySession($vid){
        $session = Session::get('viewStory');
    
        if(!$session){
            Session::put('viewStory' , [0=>$vid]);
        }else{
        

            if(is_array($session) ){
              
                if(!in_array($vid , $session)){

                    $data =[];


                    foreach ($session  as $s) {
                        array_push($data , $s);
                    }
    
                    array_push($data , $vid);
    
                    Session::put("viewStory" , $data);
    
                }

                
                
            }else{

                
                Session::put("viewStory" , [$data]);


            }


        }


        

    }

    public function home(Request $request)
    {




        // $session = Session::put('viewStory' , []);
        
        // Artisan::call('laravel-pwa:publish');
        // Artisan::call('cache:clear');
        // Artisan::call('optimize:clear');
        
        $to = Carbon::now();
        
        $from = Carbon::now()->subHours(24);
        $seenSession = Session::get('viewStory');
        
        
        if(!is_array($seenSession)){
            $seenSession = [];
        }

        
        
        
        $v = story::whereNotIn( 'vendor_id'  , $seenSession  )->whereBetween('created_at', [$from, $to])
        ->select('vendor_id')
        ->where('sendBy', 'vendor')
        ->distinct()
        
        ->get();
        
        $vendorIdsForStory = [];
        
        foreach ($v->toArray() as $key => $value) {
            array_push($vendorIdsForStory , $value);
        }


        
        
        // $vendors = Vendor::select('id' , 'avatar' , 'title')->whereIn('id' , $vendorIdsForStory)->get();
        
        
        
        $adminStories = story::whereNotNull('acceptedbyAdmin')
            ->whereBetween('created_at', [$from, $to])
            ->where('sendBy', 'admin')
            ->orderByDesc('acceptedbyAdmin')
            ->get();
            
            
            
            if ($request->has('vId')) {

            $vendorrr = Vendor::findOrFail($request->vId);
            if ($vendorrr->hasActiveStory($vendorrr->id) == 1) {
                $stories = $vendorrr->activeStories;

                
            } else {
                return redirect()->route('home');
            }
            for ($i = 0; $i < count($v); $i++) {

                if ($request->vId == $v[$i]->vendor_id) {

                    if (isset($v[$i - 1])) {
                        $PrevVendorId = $v[$i - 1]->vendor_id;
                        updateSeenStorySession($v[$i - 1]->vendor_id);
                    } else {
                        $PrevVendorId = null;

                    }

                    if (isset($v[$i + 1])) {
                        $nextVendorId = $v[$i + 1]->vendor_id;

                    } else {

                        $nextVendorId = null;
                    }

                }
            }


            // $this->seenStory($stories , $request->vId , $)

        } elseif ($request->has('adminStories')) {

            $PrevVendorId = null;
            $nextVendorId = null;
            $vendorrr = null;

            $stories = story::
            whereNotIn( 'vendor_id' , $seenSession )->

            whereNotNull('acceptedbyAdmin')
                ->whereBetween('created_at', [$from, $to])
                ->where('sendBy', 'admin')
                ->orderByDesc('acceptedbyAdmin')
                ->get();

        } else {
            $PrevVendorId = null;
            $nextVendorId = null;
            $vendorrr = null;
        
            
            $stories = story::whereBetween('created_at', [$from, $to])->when(count($seenSession)>0 , function($query) use($seenSession){
                return $query->whereNotIn( 'vendor_id' , $seenSession );
            })
            ->where('sendBy','!=' , 'admin')
            ->select('vendor_id')->with('vendor')->distinct()->get();


            $seenedStories = story::            whereIn( 'vendor_id' , $seenSession )->            whereBetween('created_at', [$from, $to])
            ->where('sendBy','!=' , 'admin')
            ->select('vendor_id')->with('vendor')->distinct()->get();




        }

        
        

        $countSetting = Setting::first();
         
        
        $slider = new Sliders();
        $availableSliders = $slider->availableNoe();
        
        
        
        
        $speciallProducts = resolve(SpecialProductsController::class)->get_available($countSetting->SpecialPcount);
        $most_view_products = resolve(ProductController::class)->Home_most_view_products($countSetting->MostViewProduct);
        // dd($most_view_products);
        $popularProducts = resolve(ProductController::class)->HomePopulars($countSetting->PopularVCount);
        


        $specialVendors = resolve(SpecialVendorsController::class)->get_available($countSetting->SpecialVCount);
      
    
        $popularVendorrs = resolve(HomeVendorController::class)->HomePopulars($countSetting->PopularVCount);
       
        
        
        $most_product_vendors = resolve(VendorsProductController::class)->Home_most_product_vendors($countSetting->MostPvendors);
        
        
        
        // $vendors = resolve(HomeVendorController::class)->Home_index();
        // $products = resolve(ProductController::class)->HomeIndex();
        
        
        $brands = Cache::rememberForever('brands', function () {
          return  \App\Models\Brand::where('is_active', 1)->get();
        });

        $site_setting = SiteSetting::first();

        $Vendors_count = Vendor::count();
        $Products_count = Product::count();        
        $Articles_count = CategoryArticle::count();


        
        return view('welcome', compact('brands','vendorrr','seenedStories' , 'adminStories', 'PrevVendorId', 'nextVendorId', 'stories', 'popularProducts', 'popularVendorrs', 'Vendors_count', 'Products_count', 'availableSliders', 'Articles_count', 'site_setting', 'speciallProducts', 'specialVendors', 'most_view_products', 'most_product_vendors'));

    }


    public function stories(Request $request)  {
        
        $to = Carbon::now();

        $from = Carbon::now()->subHours(24);

        $seenSession = Session::get('viewStory');

        // dd($seenSession);
        $v = story::
        // whereNotIn($session)->
        whereBetween('created_at', [$from, $to])
                ->select('vendor_id')   
                ->where('sendBy', 'vendor')
                ->distinct()
                
                ->get();




        if($request->lastOne){

            $vendor = Vendor::findOrFail($request->lastOne);

            $this->updateSeenStorySession($vendor->id);


        }

                
        if ($request->has('vId')) {

            $vendorrr = Vendor::findOrFail($request->vId);

            if ($vendorrr->hasActiveStory($vendorrr->id) == 1) {
                $this->updateSeenStorySession($vendorrr->id);

                $stories = $vendorrr->activeStories;

            } else {
                return redirect()->route('home');
            }
            for ($i = 0; $i < count($v); $i++) {

                if ($request->vId == $v[$i]->vendor_id) {

                    if (isset($v[$i - 1])) {
                        $PrevVendorId = $v[$i - 1]->vendor_id;
                    } else {
                        $PrevVendorId = null;

                    }

                    if (isset($v[$i + 1])) {
                        $nextVendorId = $v[$i + 1]->vendor_id;

                    } else {

                        $nextVendorId = null;
                    }

                }
            }
        } elseif ($request->has('adminStories')) {

            $PrevVendorId = null;
            $nextVendorId = null;
            $vendorrr = null;

            $stories = story::whereNotNull('acceptedbyAdmin')
                ->whereBetween('created_at', [$from, $to])
                ->where('sendBy', 'admin')
                ->orderByDesc('acceptedbyAdmin')
                ->get();

        }
        return view('home.OpenStory' ,compact('vendorrr', 'PrevVendorId', 'nextVendorId', 'stories'));
    }
    public function contact_us()
    {

        $setting_detail = Setting::first();

        // dd($setting_detail);

        return view('contact_us', compact('setting_detail'));

    }
    public function laws()
    {

        $setting_detail = Setting::first();

        return view('laws', compact('setting_detail'));
    }

    public function questions()
    {

        $setting_detail = Setting::first();

        return view('questions', compact('setting_detail'));
    }
    public function aboute_us()
    {

        $setting_detail = Setting::first();

        return view('aboute_us', compact('setting_detail'));
    }
    public function Add()
    {

        $setting_detail = Setting::first();

        return view('Add', compact('setting_detail'));
    }
    public function buyGuid()
    {

        $setting_detail = Setting::first();

        return view('buyGuid', compact('setting_detail'));
    }
    public function vendorGuid()
    {

        $setting_detail = Setting::first();

        return view('vendorGuid', compact('setting_detail'));
    }
    public function productGuid()
    {

        $setting_detail = Setting::first();

        return view('productGuid', compact('setting_detail'));
    }


    public function pay($orderId, $amount, $userName, $phoneNumber, $desc, $callbackUrl)
    {

        


        $params = array(
            'order_id' => $orderId,
            'amount' => $amount,
            'name' => $userName,
            'phone' => "0" . $phoneNumber,
            'mail' => 'info@instabargh.com',
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => $callbackUrl,
            'X-API-KEY: 5bc456dc-306a-47b7-b3e4-1a6337145cb4',
            'X-SANDBOX: 1'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'X-API-KEY: 5bc456dc-306a-47b7-b3e4-1a6337145cb4',
                'X-SANDBOX: 1'
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);

        
        return $result;


    }


    public function PayVerify($params)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'X-API-KEY: 5bc456dc-306a-47b7-b3e4-1a6337145cb4',
                //'X-SANDBOX: 1'


            )
        );

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }




    public function totalPaymentStatus()
    {

        $setting = SiteSetting::first();

        if ($setting) {
            if ($setting->paymentStatus == "1") {
                return true;
            } else {
                return null;
            }
        } else {
            return null;
        }

    }

    public function paymentStatusIn($where, $time = null)
    {

        $setting = SiteSetting::first();

        switch ($where) {
            case 'storyPayStatus':

                if ($setting->storyPayStatus == "1" && ($setting->storyPay) > 0) {

                    return $setting->storyPay;

                } else {
                    return 0;
                }

                break;

            case 'SliderPayStatus':

                if ($setting->SliderPayStatus == "1") {

                    if ($time) {

                        if ($time == "three" && ($setting->SliderPayThree) > 0) {
                            return $setting->SliderPayThree;
                        } elseif ($time == "six" && ($setting->SliderPaySix) > 0) {
                            return $setting->SliderPaySix;
                        } elseif ($time == "year" && ($setting->SliderPayYear) > 0) {
                            return $setting->SliderPayYear;
                        } else {
                            return 0;
                        }

                    } else {
                        if ($setting->SliderPay > 0) {
                            return $setting->SliderPay;
                        } else {
                            return 0;
                        }
                    }

                } else {

                    return 0;
                }
                break;



            case 'SpcVPayStatus':

                if ($setting->SpcVPayStatus == "1") {

                    if ($time) {

                        if ($time == "three" && ($setting->SpcVPayThree) > 0) {
                            return $setting->SpcVPayThree;
                        } elseif ($time == "six" && ($setting->SpcVPaySix) > 0) {
                            return $setting->SpcVPaySix;
                        } elseif ($time == "year" && ($setting->SpcVPayYear) > 0) {
                            return $setting->SpcVPayYear;
                        } else {
                            return 0;
                        }

                    } else {
                        if ($setting->SpcVPay > 0) {
                            return $setting->SpcVPay;
                        } else {
                            return 0;
                        }
                    }
                } else {
                    return 0;
                }
                break;
            case 'SpcPPayStatus':

                if ($setting->SpcPPayStatus == "1") {

                    if ($time) {

                        if ($time == "three" && ($setting->SpcPPayThree) > 0) {
                            return $setting->SpcPPayThree;
                        } elseif ($time == "six" && ($setting->SpcPPaySix) > 0) {
                            return $setting->SpcPPaySix;
                        } elseif ($time == "year" && ($setting->SpcPPayYear) > 0) {
                            return $setting->SpcPPayYear;
                        } else {
                            return 0;
                        }

                    } else {
                        if ($setting->SpcPPay > 0) {
                            return $setting->SpcPPay;
                        } else {
                            return 0;
                        }
                    }
                } else {
                    return 0;
                }
                break;
            case 'LadderPPayStatus':

                if ($setting->LadderPPayStatus == "1" && ($setting->ladderPPay) > 0) {
                    return $setting->ladderPPay;
                } else {

                    return 0;
                }
                break;

            case 'ladderVPayStatus':

                if ($setting->ladderVPayStatus == "1" && ($setting->ladderVPay) > 0) {
                    return $setting->ladderVPay;
                } else {
                    return 0;
                }
                break;



            default:
                dd('sadasd');

                break;






        }


    }





    public function downloadFile(Request $request)
    {



        $request->validate([

            'filename' => "required",

            
        ]);

        $filename = $request->filename;

        dd($filename);


        





        $file_path = storage_path() . "/app/downloads/" . $filename;
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=' . $filename,
        );
        if (file_exists($file_path)) {
            // Send Download
            return \Response::download($file_path, $filename, $headers);
        } else {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }





    public function deleteImage($imageId , $product = null){
        
        $image = ProductImage::findOrFail($imageId);

        $path = env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image;
        $image = ProductImage::find($imageId);

        if ($image) {
            $image->delete();
        }


        if($product){

            if ($product->primary_image == $image->image) {


                if (count($product->Allimages) > 1) {
    
    
                    if ($product->Allimages[1]->image != $image->image) {
                        $newName = $product->Allimages[1]->image;
                    } else {
                        $newName = $product->Allimages[0]->image;
                    }
    
                    $product->update([
                        'primary_image' => $newName,
                    ]);
                } else {
                    // dd('asdasd');
                    $product->update([
                        'primary_image' => 'product-default-limage.jpg',
                    ]);
                }
            }
    
    
        }




        // if (file_exists($path)) {
        //     unlink($path);
        // }

    }









}