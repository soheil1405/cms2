<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VendorsSocialMediaController;
use App\Models\Admin\Setting;
use App\Models\Admin\SiteSetting;
use App\Models\Image as ModelsImage;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Vendors_SocialMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;

use Intervention\Image\Facades\Image as Image;
class userVendorController extends Controller
{

    public function dashboard(Request $request)
    {
        // dd(['usersLaddelV', 'usersUpgradeVendor']);

        $most_viewed_products = Product::where('vendor_id', Auth::user()->vendor->id)

            ->orderByDesc('view_counter')
            ->paginate(6);

        $followings = Auth::user()->vendor->following;

        $fArray = [];

        foreach ($followings as $item) {

            if ($item->vendor2->hasActiveStory($item->vendor2->id) == 1) {
                array_push($fArray, $item->vendor2->id);
            }
        }

        if ($request->has('MyStrories')) {
            if (Auth::user()->vendor->hasActiveStory(Auth::user()->vendor->id) == 1) {
                $stories = Auth::user()->vendor->activeStories;

                $PrevVendorId = null;
                $nextVendorId = null;
                $vendorrr = Auth::user()->vendor;
            } else {

                return redirect()->route('user.dashboard');
            }
        } elseif ($request->has('fId')) {
            $vendorrr = Vendor::findOrFail($request->fId);

            if ($vendorrr->hasActiveStory($vendorrr->id) == 1) {
                $stories = $vendorrr->activeStories;
            } else {
                return redirect()->route('user.dashboard');
            }
            for ($i = 0; $i < count($fArray); $i++) {

                if ($request->fId == $fArray[$i]) {

                    if (isset($v[$i - 1])) {
                        $PrevVendorId = $fArray[$i - 1];
                    } else {
                        $PrevVendorId = null;
                    }

                    if (isset($v[$i + 1])) {
                        $nextVendorId = $fArray[$i + 1];
                    } else {

                        $nextVendorId = null;
                    }
                }
            }
        } else {

            $PrevVendorId = null;
            $nextVendorId = null;
            $vendorrr = null;
            $stories = null;
        }

        $lastAdmin = null;
        if(\Session::has('adminLogedIn')){
            $lastAdmin = true;
         }

        return view('user.dashboard', compact( 'lastAdmin' ,'most_viewed_products', 'vendorrr', 'PrevVendorId', 'nextVendorId', 'stories', 'followings'));
    }

    public function index()
    {
        return redirect()->route('user.dashboard');
    }

    public function create()
    {
        if (is_null(Auth::user()->vendor)) {
            return view('user.vendor.create');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        return redirect()->route('user.dashboard');
    }

    public function edit($id)
    {

        $user = Auth::user();

        if (!is_null($user->vendor)) {
            if ($user->vendor->name === $id) {

                return view('user.vendor.edit', compact('user'));
            }
        }
        return redirect()->route('user.dashboard');
    }

    public function update(Request $request, $vendor)
    {



        

        $thisvendor = Vendor::find($vendor);


        if ($request->latlng) {
       
            $latlng = explode("," , $request->latlng );
        }else{
            $latlng[0]= $thisvendor->lat ;
            $latlng[1] = $thisvendor->lng;
        }


        

        $request->validate([
            'name' => 'required',
            // 'description' => 'string',
            // 'title'             => 'required|string',
            'number' => 'required',
            'numeric',
            'phone_number2' => 'numeric|nullable',
            "phone_number" => 'required',
            'site_url' => 'string|nullable',
            'address' => 'required|string',
            'Social_telegram' => 'string',
            'Social_instagram' => 'string',
            'Social_aparat' => 'string',
            'Social_rubika' => 'string',
            'Social_email' => 'string',
            'Social_whatsapp' => 'string',
            'Category' => 'required',


        ]);

        // try {
            DB::beginTransaction();

            $cats = str_replace(',', '-', $request->Category);



            $vendorName = Username::setModel(Vendor::class)
                ->setColum('name')
                ->make(
                    str_replace(' ', '-', $request->name)
                );

            $data = $request->only([
                'name',
                'description',
                'latlng',
                'address',
                'number',
                "phone_number",
                'phone_number2',
                'website',
                'telegram',
                'apatatVideoLink',
                'aparat',
                'robika',
                'instagram',
                'email',
                'whatsapp',
                'site_url',
                'bale'
            ]);

            $editor = Auth::user()->name;

            $moreDetails = [
                'editor' => $editor,
                'time' => Carbon::now()->toDateTimeString(),
            ];


            $cover = getVendorLastDate($thisvendor->id, 'cover');

            $avatar = getVendorLastDate($thisvendor->id, 'avatar');


            
            if($request->avatar != null && $request->deletedavatarPic == null){
                $fileNameImage = generateFileName($request->avatar->getClientOriginalName());
                $this->StoreImageWithNewWithAndHeight($request->avatar , env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH'), 5 ,$fileNameImage);
                $newImageUploaded = ModelsImage::create([
                    'name' =>$fileNameImage ,
                    'vendor_id'=>$vendor->id
                ]);
                $request->avatar->move(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH_ORIGINAL')), $fileNameImage);
                $avatar = $fileNameImage;
            }elseif($request->avatar == null && $request->deletedavatarPic == null && $request->useLogoFromLastImages){
                $avatar = $request->useLogoFromLastImages;
            }elseif($request->deletedavatarPic != null){
                $avatar = "default-avatar.png";                
            }




            if($request->cover != null  && $request->deletedCoverPic == null){
                $fileNameImage = generateFileName($request->cover->getClientOriginalName());
                $this->StoreImageWithNewWithAndHeight($request->cover , env('VENDOR_IMAGES_UPLOAD_PATH'), 3 ,$fileNameImage);
                $request->cover->move(public_path(env('VENDOR_IMAGES_UPLOAD_PATH_ORIGINAL')), $fileNameImage);
                $cover = $fileNameImage; 
                $newImageUploaded = ModelsImage::create([
                    'name' =>$fileNameImage ,
                    'vendor_id'=>$vendor->id
                ]);
            }elseif($request->cover == null && $request->deletedCoverPic == null && $request->coverLastImageUsing){
                $cover = $request->coverLastImageUsing;
            }elseif($request->deletedCoverPic != null ){
                $cover = "default-cover.jpg";
            }

            


            $newData = array_merge($data, ['cover' => $cover ]);
            $newData = array_merge($newData, ['avatar'=>$avatar]);


            $finalData = array_merge($newData, $moreDetails);

            $josnedData = json_encode($finalData);



            if ($thisvendor->status == "no" || $thisvendor->status ==  "new") {
                $status =  'new';
            } else {
                $status =  'edited';
            }

            if($request->q2 == 1){
                $q2 = $request->minq2; 
            }else{
                $q2 = 0;
            }

            if($request->q4 == 1){
                $q4 = $request->minq4; 
            }else{
                $q4 = 0;
            }

            $thisvendor->update([
                'EditedData' => $josnedData,
                'EditReportText' => null,
                'status' =>  $status,
                // "avatar"=>$avatar ,
                // "cover"=>$cover ,
                'q1'=>$request->q1 ,
                'q2'=>$q2 , 
                'q3'=>$request->q3 ,
                'q4'=>$q4 ,
                'lat'=>$latlng ? $latlng[0] : $thisvendor->lat ,
                'lng'=>$latlng ? $latlng[1] : $thisvendor->lng ,

                'category_activity' => $cats
            ]);


            // dd($thisvendor , $cover , $avatar);

            // if ($request->latlng) {
            //     $vendor = $thisvendor->update([
            //         // 'name' =>   $vendorName ,
            //         'title' => $request->name,
            //         'user_id' => $thisvendor->user->id,
            //         'category_activity' => strval($cats),
            //         'description' => $request->description,

            //         'lat' => $latlng[0] ? $latlng[0] : null,
            //         'lng' => $latlng[1] ? $latlng[1] : null,

            //         'address' => $request->address,
            //         'number' => $request->phone,
            //         'phone_number' => $request->cellphone,
            //         'phone_number2' => $request->phone_number2,
            //         'site_url' => $request->site_url,
            //         'status' => 'yes',
            //         'acceptedbyAdmin' => null

            //     ]);

            // } else {
            //     $vendor = $thisvendor->update([
            //         // 'name' => ($thisvendor->name == $request->name) ? $request->name : $vendorName,
            //         'title' => $request->name,
            //         'user_id' => $thisvendor->user->id,
            //         'category_activity' => strval($cats),
            //         'description' => $request->description,
            //         'address' => $request->address,
            //         'number' => $request->phone,
            //         'phone_number' => $request->cellphone,
            //         'phone_number2' => $request->phone_number2,
            //         'site_url' => $request->site_url,
            //         'status' => 'yes',
            //         'acceptedbyAdmin' => null

            //     ]);

            // }

            // $venderSocials = Vendors_SocialMedia::where('vendor_id', $thisvendor->id)->first();

            // if ($venderSocials) {

            //     resolve(VendorsSocialMediaController::class)->edit($request, $thisvendor->id);

            // } else {

            //     resolve(VendorsSocialMediaController::class)->save($request, $thisvendor->id);

            // }

            // resolve(AdminMessageRepository::class)->sendEditVendorMessage($thisvendor);

            // DB::commit();
// 
        // } catch (\Exception $ex) {
            // DB::rollBack();
            // alert()->error('مشکل در ویرایش فروشگاه اررور ناخواسته')->persistent('حله');
            // return redirect()->back();
        // }

        alert()->success('فروشگاه مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('user.dashboard');
    }


    function contact_us(){

        $setting_detail = Setting::first();

        
        return view("user.contact_us" , compact('setting_detail'));
    }

    
    public function StoreImageWithNewWithAndHeight($image , $env , $minimize , $fileNameImage){
      
        $width = getimagesize($image)[0];
        $height =getimagesize($image)[1];

        $width = $width/ $minimize;        
        $height = $height/$minimize;
        

        $destinationPath = public_path($env . $fileNameImage);
        $img = Image::make($image->path());
    
        // Resize the image
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath);
    
        return $fileNameImage;
    }

}
