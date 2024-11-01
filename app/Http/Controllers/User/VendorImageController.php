<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\Vendor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorImageController extends Controller
{
    public function upload($primaryImage, $images , $vendorID)
    {

        $fileNamePrimaryImage = generateFileName($primaryImage->getClientOriginalName());

        $primaryImage->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNamePrimaryImage);

        $fileNameImages = [];
        foreach ($images as $image) {
            $fileNameImage = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);

            $newImageUploaded = ModelsImage::create([
                'name' =>$fileNameImage ,
                'vendor_id'=>$vendorID
            ]);

            array_push($fileNameImages, $fileNameImage);
        }

        return ['fileNamePrimaryImage' => $fileNamePrimaryImage, 'fileNameImages' => $fileNameImages];
    }

    public function edit(Vendor $vendor)
    {

        $user = $vendor->user;

        if (!is_null($user->vendor)) {

            $newDatas = $vendor->EditedData;

            $images = $vendor->Allimages;

            if (!is_null($newDatas)) {

                $dataa = json_decode($newDatas, true);

                if ($dataa) {

                    return view('user.vendor.edit', compact('vendor', 'user', 'dataa'));

                }
            } else {
                $dataa = null;
            }


            // dd(\App\Models\Vendors_SocialMedia::where('vendor_id', $vendor->id)->first());
            return view('user.vendor.edit', compact('vendor', 'user', 'dataa'));
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
        ]);

        ProductImage::destroy($request->image_id);

        alert()->success('تصویر مورد نظر حدف شد', 'باتشکر');
        return redirect()->back();
    }

    public function setCover(Request $request)
    {
        $request->validate([
            'cover' => ['required'],
        ]);

        try {
            $vendor = Auth::user()->vendor;

            $fileNameImage = generateFileName($request->cover->getClientOriginalName());

            $request->cover->move(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')), $fileNameImage);

            $thisvendor = Auth::user()->vendor;

            $data = ([
                'name' => getVendorLastDate($thisvendor->id, 'name'),
                'description' => getVendorLastDate($thisvendor->id, 'description'),
                'latlng' => null,
                'address' => getVendorLastDate($thisvendor->id, 'address'),
                'phone' => getVendorLastDate($thisvendor->id, 'phone'),
                'cellphone' => getVendorLastDate($thisvendor->id, 'cellphone'),
                'phone_number2' => getVendorLastDate($thisvendor->id, 'phone_number2'),
                'site_url' => getVendorLastDate($thisvendor->id, 'site_url'),
                'telegram' => getVendorLastSocialMediaDate($thisvendor->id, 'telegram'),
                'aparat' => getVendorLastSocialMediaDate($thisvendor->id, 'aparat'),
                'robika' => getVendorLastSocialMediaDate($thisvendor->id, 'robika'),
                'instagram' => getVendorLastSocialMediaDate($thisvendor->id, 'instagram'),
                'email' => getVendorLastSocialMediaDate($thisvendor->id, 'email'),
                'whatsapp' => getVendorLastSocialMediaDate($thisvendor->id, 'whatsapp'),
                'site_url' => getVendorLastSocialMediaDate($thisvendor->id, 'site_url'),
                'cover' => $fileNameImage,
                'editor' => Auth::user()->name,
                'time' => Carbon::now()->toDateTimeString(),
                'apatatVideoLink' => getVendorLastDate($thisvendor->id, 'apatatVideoLink'),
                'avatar' => getVendorLastDate($thisvendor->id, 'avatar'),

            ]);

            $myArr = json_encode($data);


            if($thisvendor->status == "no"){
         
                $status =  'no';
                
            }elseif( $thisvendor->status ==  "new"){
                $status =  'new';
            }else{   
                $status =  'edited';
            }
            
            $thisvendor->update([

                'EditedData' => $myArr,
                'EditReportText' => null,
                'status' => $status,
            ]);

            alert()->success('ویرایش تصویر کاور با موفقیت انجام شد', 'موفق');

            return redirect()->back();

        } catch (Exception $e) {
            alert()->success('ویرایش لوگوی فروشگاه با شکست مواجه شد', 'موفق');

            return redirect()->back();
        }

    }

    public function setAvatar(Request $request, Vendor $vendor)
    {
        $request->validate([
            'avatar' => ['required'],
        ]);

        try {
            // if ($vendor->avatar != 'default-avatar.jpg' && file_exists(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $vendor->avatar)) {
            //     unlink(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $vendor->avatar);
            // }

            $fileNameImage = generateFileName($request->avatar->getClientOriginalName());

            $request->avatar->move(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')), $fileNameImage);
         
            $thisvendor = Auth::user()->vendor;

            $data = ([
                'name' => getVendorLastDate($thisvendor->id, 'name'),
                'description' => getVendorLastDate($thisvendor->id, 'description'),
                'latlng' => null,
                'address' => getVendorLastDate($thisvendor->id, 'address'),
                'phone' => getVendorLastDate($thisvendor->id, 'phone'),
                'cellphone' => getVendorLastDate($thisvendor->id, 'cellphone'),
                'phone_number2' => getVendorLastDate($thisvendor->id, 'phone_number2'),
                'site_url' => getVendorLastDate($thisvendor->id, 'site_url'),
                'telegram' => getVendorLastSocialMediaDate($thisvendor->id, 'telegram'),
                'aparat' => getVendorLastSocialMediaDate($thisvendor->id, 'aparat'),
                'robika' => getVendorLastSocialMediaDate($thisvendor->id, 'robika'),
                'instagram' => getVendorLastSocialMediaDate($thisvendor->id, 'instagram'),
                'email' => getVendorLastSocialMediaDate($thisvendor->id, 'email'),
                'whatsapp' => getVendorLastSocialMediaDate($thisvendor->id, 'whatsapp'),
                'site_url' => getVendorLastSocialMediaDate($thisvendor->id, 'site_url'),
                'avatar' => $fileNameImage,
                'editor' => Auth::user()->name,
                'time' => Carbon::now()->toDateTimeString(),
                'apatatVideoLink' => getVendorLastDate($thisvendor->id, 'apatatVideoLink'),
                'cover' => getVendorLastDate($thisvendor->id, 'cover'),

            ]);

            $myArr = json_encode($data);

            if($thisvendor->status == "no"){
         
                $status =  'no';
                
            }elseif( $thisvendor->status ==  "new"){
                $status =  'new';
            }else{   
                $status =  'edited';
            }
            
            $thisvendor->update([

                'EditedData' => $myArr,
                'EditReportText' => null,
                'status' =>  $status,
            ]);

            alert()->success('ویرایش لوگوی فروشگاه با موفقیت انجام شد', 'موفق');

            return redirect()->back();
        } catch (Exception $e) {
            alert()->success('ویرایش لوگوی فروشگاه با شکست مواجه شد', 'موفق');

            return redirect()->back();
        }
    }

    public function GoToEditCover(Vendor $vendor)
    {
        $user = $vendor->user;
        return view('user.vendor.edit-cover', compact('vendor', 'user'));
    }

    public function deleteCover(Request $request)
    {
        $vendor = Vendor::find($request->vId);

        $vendor->update([
            'cover' => 'default-cover.jpg',
        ]);

        alert()->success('کاور فروشگاه با موفقیت حذف شد ', 'موفق');

        return redirect()->back();
    }
}
