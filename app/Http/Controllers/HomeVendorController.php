<?php

namespace App\Http\Controllers;

use App\Models\Admin\ProductComments;
use App\Models\Admin\SpecialVendors;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Vendor;
use App\Models\Follow;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSidBarAdds;

class HomeVendorController extends Controller
{
    public function index(Vendor $vendor , HttpRequest  $request)
    {

        
        if($vendor->user->isAdmin()){
            return redirect()->route('Vendors.list');
        }

        
        if($request->lastOne){

            $vendor = Vendor::findOrFail($request->lastOne);

            $this->updateSeenStorySession($vendor->id);


        }



        $data = str_replace('-', ' ', strval($vendor->category_activity));
        
        
        $category = explode('-', $vendor->category_activity);


        
        $similar_vendors_id = [];


        foreach ($category as $key => $value) {
            
            $svendor = Vendor::where('id' , '!=' , $vendor->id)->where('category_activity' , "LIKE" , "%".$value."%" )->get();

            
            foreach ($svendor as $sv) {
                array_push($similar_vendors_id , $sv->id);
                # code...
            }
            
        }

        $similar_vendors = Vendor::whereIn('id' , $similar_vendors_id)->latest()->get();
        


        $comments = ProductComments::where('vendor_id', $vendor->id)
            ->whereNull('product_id')
            ->where('is_active', 1)->whereNull('answered_to')
            ->get();



        $vendors = Vendor::where('adminVendor', 'no')->latest()->orderBy('updated_at');


        $specialVendors = resolve(SpecialVendorsController::class)->get_available(12);


        

        $viewCount = $vendor->view_count + 1;

        $vendor->update([
            'view_count' => $viewCount
        ]);



        if (Auth::user()) {


            $followingStatus = self::followedOrNot($vendor->id);

        } else {
            $followingStatus = null;
        }

        



        
        


        if($request->ProductFrom){
            
            $count = $request->ProductFrom;
     
            

        }else{
            $count = 8 ;
        }
        
        $products = resolve(ProductRepository::class)->VendoAnotherProducts($vendor , $count);



        $vendorLatLng =  $vendor->lat . ',' . $vendor->lng;



        $metaDescription = "تلفن ۱ :". $vendor->number . " موبایل : ".$vendor->phone_number . "آدرس : ". $vendor->address;

        $mapLink = "https://api.neshan.org/v2/static?key=service.349e7f85b58d4cbaac353a73c85acc35&type=dreamy&zoom=20&center=".$vendorLatLng."&width=1120&height=300&marker=red";


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

        $nextLink = route('vendor.home', ['vendor' => $vendor->name ]);
    
        
        $PrevVendorId = null;
        $nextVendorId = null;

        
        $sideAddLinks = SiteSidBarAdds::where('status' , 1)->whereNotNull('showInSingleProduct')->get(); 

        // dd($mapLink  , "https://api.neshan.org/v2/static?key=service.349e7f85b58d4cbaac353a73c85acc35&type=dreamy&zoom=14&center=35.700538,51.337907&width=1120&height=300&marker=red");
        return view('vendors.index', compact( 'similar_vendors' , 'sideAddLinks' ,'vendor', 'nextLink', 'stories' , 'vendorrr' , 'PrevVendorId' , 'nextVendorId',  'metaDescription',  'mapLink','followingStatus', 'products', 'similar_vendors', 'specialVendors', 'comments'));
    }








    public function followedOrNot($id)
    {
        return Follow::where('following', $id)->where('vendor_id', Auth::user()->vendor->id)->first();

    }



















    public function upgrade(HttpRequest $request, Vendor $vendor)
    {
        $products = Auth::user()->vendor
            ->products()

            ->paginate(20);





        $vendorSlider = Sliders::where('vendor_id', Auth::user()->vendor->id)->whereNull('product_id')->first();




        $activeStories = Auth::user()->vendor->activeStories;






        $archivedStories = Auth::user()->vendor->archivedStories;

        $StoriesInQueue = Auth::user()->vendor->StoriesInQueue;

        $deniedStories = Auth::user()->vendor->deniedStories;




        if ($request->search) {

            $products = Auth::user()->products()->where('name', "LIKE", "%" . $request->search . "%")->paginate(20);
        }



        return view('user.products.upgrade', compact('products', 'activeStories', 'deniedStories', 'archivedStories', 'StoriesInQueue', 'vendorSlider'));

    }

    public function list(HttpRequest $request)
    {

        

        $vendors = Vendor::orderByDesc('pin_number')->where('adminVendor', 'no')->orderByDesc('laddered_at')
        
        ->notNew()
        ->paginate(20);



        


        // $pinnedVendors = Vendor::where('pin_number', '>', "0")->where('adminVendor', 'no')->OrderBy('pin_number')
        // ->notNew()
        // ->get();



        if ($request->has('SortBy')) {
            $variable = $request->SortBy;
            switch ($variable) {
                case 'latest':
                    $vendors = Vendor::where('adminVendor', 'no')->orderByDesc('laddered_at')->paginate(20);
                    break;
                case 'pCount':
                    $vendors = Vendor::where('adminVendor', 'no')->orderByDesc('product_count')->paginate(20);
                    break;

                case 'view':
                    $vendors = Vendor::where('adminVendor', 'no')->orderByDesc('view_count')->paginate(20);


                    break;

                default:
                return redirect()->route("Vendors.list");
                    break;
            }
        }


        $sideAddLinks = SiteSidBarAdds::whereNotNull('showInVendors')->where('status', 1)->get();

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


        
        
        $PrevVendorId = null;
        $nextVendorId = null;


        return view('ListOf.AllVendors', compact('vendors', 'vendorrr' ,'stories'   , 'nextVendorId' , 'PrevVendorId' , 'sideAddLinks'));
    }

    public function Home_index()
    {
        $vendors = Vendor::where('adminVendor', 'no')->where('status' , "!=" , 'new')->latest()->paginate(12);

        return $vendors;
    }


    public function vendor_orderBy_productCount()
    {
        return Vendor::where('adminVendor', 'no')->orderByDesc('product_count')->limit(6)->get();
    }








    public function ladderVendor(HttpRequest $request)
    {

        $request->validate([
            'vendor_id' => 'required'
        ]);
        $vendor = Vendor::findOrFail($request->vendor_id);




        $user = Auth::user();

        $pay = self::paymentStatusIn('ladderVPayStatus');

        if ($user->rols()->where('name', 'admin')->get()->count() == 0 && self::totalPaymentStatus() && $pay > 0) {



            $des = "نردبان فروشگاه";


            $order = Orders::create([
                'user_id' => Auth::user()->id,
                'orderType' => 'ladderVPay',
                'typeId' => $vendor->id,
                'linkBack' => "user.orders.index",
                'totalAmount' => $pay,
                "description" => $des
            ]);


            return redirect()->route('user.payPage', ['id' => $order->id]);



        } else {



            $vendor->update([

                'laddered_at' => Carbon::now()
            ]);



            alert()->success('  فروشگاه شما با موفقیت نردبان شد  ', 'باتشکر');


            return redirect()->back();


        }



    }




    public function upgradeVEndor()
    {


        return view('user.upgradeVendor.index');


    }





    public function HomePopulars($count)
    {

        $timeNow = new \DateTime();
        return Vendor::where('adminVendor', 'no')->orderByDesc('rate_Ave')->orderByDesc('view_count')->limit($count)->get();

    }



}