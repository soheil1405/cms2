<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\vendors\ProductController as VendorsProductController;
use App\Models\Admin\ArtcilePictures;
use App\Models\Admin\CategoryArticle;
use App\Models\Admin\Setting;
use App\Models\Admin\SiteSetting;
use App\Models\footerLinks;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = SiteSetting::first();

        $setting_detail = Setting::first();

        return view('admin.setting.edit', compact('setting', 'setting_detail'));
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::first();
       
        

        $setting->update([
            'articles' => $request->articles ? 1 : 0,
            'sliders' => $request->sliders ? 1 : 0,
            'gif1' => $request->gif1 ? 1 : 0,
            'gif2' => $request->gif2 ? 1 : 0,
            'stories' => $request->stories ? 1 : 0,
            'brands' => $request->brands ? 1 : 0,
            'counters' => $request->counters ? 1 : 0,
            'products' => $request->products ? 1 : 0,
            'vendors' => $request->vendors ? 1 : 0,
            'links' => $request->links ? 1 : 0,
            'insid_links' => $request->insid_links ? 1 : 0,
            'usersUpgradeVendor' => $request->usersUpgradeVendor ? 1 : 0,
            'usersSendSlider' => $request->usersSendSlider ? 1 : 0,
            'usersSendStory' => $request->usersSendStory ? 1 : 0,
            'usersUpgradeProduct' => $request->usersUpgradeProduct ? 1 : 0,
            'usersLaddelV' => $request->usersLaddelV ? 1 : 0,
            'usersLaddelP' => $request->usersLaddelP ? 1 : 0,
            'aparat_product'=>$request->aparat_product ? 1 : 0 ,
            'aparat_vendor'=>$request->aparat_vendor ? 1 : 0 ,
            "subtitle_status" => $request->subtitle_status ? 1 : 0,
        ]);

        DB::commit();

        return redirect()->back();
    }

    public function update2(Request $request)
    {

        // dd($request->all());
        // try {





            $setting_detail = Setting::first();




            if($request->userArticelDefualtImg){
                
                $file = $request->userArticelDefualtImg;

                $fileName = generateFileName($file->getClientOriginalName());

                $file->move(public_path(env('ARTICLE_IMAGES_UPLOAD_PATH')), $fileName);

                $setting_detail->update([
                    'userArticelDefualtImg'=>$fileName
            
                ]);

                return redirect()->back();

            }



            if ($request->questions) {
                $setting_detail->update([
                    'questions' => $request->questions,
                ]);
            }

            if ($request->laws) {
                $setting_detail->update([
                    'laws' => $request->laws,
                ]);
            }

            if ($request->aboute) {
                $setting_detail->update([
                    'aboute' => $request->aboute,
                ]);
            }

            if ($request->contact_us) {
                $setting_detail->update([
                    'contact_us' => $request->contact_us,
                ]);
            }

            if ($request->ways) {
                $setting_detail->update([
                    'telegram' => $request->telegram,
                    'instagram' => $request->instagram,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'facebook' => $request->facebook,
                    'aparat' => $request->aparat,
                    'rubika' => $request->rubika,
                    'whatsapp' => $request->whatsapp,
                    'email' => $request->email,
                    'fax' => $request->fax,
                    'address' => $request->address,
                    'telephone' => $request->telephone,
                    'telephone2' => $request->telephone2,
                ]);
            }
            if ($request->link) {
                $footerLink = footerLinks::find($request->id)->update([
                    'name' => $request->name,
                    'link' => $request->link,
                ]);

                $setting_detail = Setting::first();

                $footerLinks = footerLinks::all();

                return view('admin.setting.footer', compact('setting_detail', 'footerLinks'));
            }
            if ($request->footerText) {
                $setting_detail->update([
                    'footerText' => $request->footerText,
                ]);
            }

            if ($request->footerText) {
                $setting_detail->update([
                    'footerText' => $request->footerText,
                ]);
            }

            if ($request->Buy_guid_text) {
                $setting_detail->update([
                    'Buy_guid_text' => $request->Buy_guid_text,
                ]);
            }

            if ($request->productPage_guid_Text) {
                $setting_detail->update([
                    'productPage_guid_Text' => $request->productPage_guid_Text,
                ]);
            }

            if ($request->VendortPage_guid_Text) {
                $setting_detail->update([
                    'VendortPage_guid_Text' => $request->VendortPage_guid_Text,
                ]);
            }

            if ($request->aparat_buy) {
                $setting_detail->update([
                    'aparat_buy' => $request->aparat_buy,
                ]);
            }

            if ($request->aparat_vendor) {
                $setting_detail->update([
                    'aparat_vendor' => $request->aparat_vendor,
                ]);
            }

            if ($request->aparat_product) {
                $setting_detail->update([
                    'aparat_product' => $request->aparat_product,
                ]);
            }

            if ($request->AddPage_Guid_Text) {
                $setting_detail->update([
                    'AddPage_Guid_Text' => $request->AddPage_Guid_Text,
                ]);
            }

            if ($request->aparat_Add) {
                $setting_detail->update([
                    'aparat_Add' => $request->aparat_Add,
                ]);
            }
            if ($request->product_video_name) {
                $video = $request->product_video_name;
                $fileNameImage = generateFileName($video->getClientOriginalName());

                $video->move(public_path(env('SETTING_VIDEOS_UPLOAD_PATH')), $fileNameImage);

                $setting_detail->update([
                    'product_video_name' => $fileNameImage,
                ]);
            }

            if ($request->vendor_video_name) {
                $video = $request->vendor_video_name;
                $fileNameImage = generateFileName($video->getClientOriginalName());

                $video->move(public_path(env('SETTING_VIDEOS_UPLOAD_PATH')), $fileNameImage);

                $setting_detail->update([
                    'vendor_video_name' => $fileNameImage,
                ]);
            }
            if ($request->Ad_video_name) {
                $video = $request->Ad_video_name;
                $fileNameImage = generateFileName($video->getClientOriginalName());

                $video->move(public_path(env('SETTING_VIDEOS_UPLOAD_PATH')), $fileNameImage);

                $setting_detail->update([
                    'Ad_video_name' => $fileNameImage,
                ]);
            }

            if ($request->buy_video_name) {
                $video = $request->buy_video_name;
                $fileNameImage = generateFileName($video->getClientOriginalName());

                $video->move(public_path(env('SETTING_VIDEOS_UPLOAD_PATH')), $fileNameImage);

                $setting_detail->update([
                    'buy_video_name' => $fileNameImage,
                ]);
            }

            if ($request->delete_Add_AparatVideoForm) {

                $setting_detail->update([
                    'aparat_Add' => null,
                ]);

            }

            if ($request->delete_Product_AparatVideoForm) {

                $setting_detail->update([
                    'aparat_product' => null,
                ]);

            }

            if ($request->delete_Vendor_AparatVideoForm) {

                $setting_detail->update([
                    'aparat_vendor' => null,
                ]);

            }

            if ($request->delete_Buy_AparatVideoForm) {

                $setting_detail->update([
                    'aparat_buy' => null,
                ]);

            }

            if ($request->guidVTitle) {

                $setting_detail->update([

                    'guidVTitle' => $request->guidVTitle,
                ]);

            }

            if ($request->guidVendorPic) {
                self::updateguidVendorPic($request);
            }

            if ($request->guidPTitle) {

                $setting_detail->update([

                    'guidPTitle' => $request->guidPTitle,
                ]);

            }

            if ($request->guidProductPic) {
                self::updateguidProductPic($request);
            }

            if ($request->guidBuyTitle) {

                $setting_detail->update([

                    'guidBuyTitle' => $request->guidBuyTitle,
                ]);

            }

            if ($request->subtitle) {

                $setting_detail->update([

                    'subtitle' => $request->subtitle,
                ]);

                
            }

            if ($request->guidBuyPic) {
                self::updateguidBuyPic($request);
            }

            DB::commit();

            return redirect()->route('admin.settindDetail.index');
        // } catch (Exception $e) {
        //     return redirect()->back();
        // }
    }

    public function Active_items()
    {
        return SiteSetting::first();
    }
    public function compaytDeteil_index()
    {
    }
    public function aboute()
    {
        $setting_detail = Setting::first();
        $images = ArtcilePictures::all();

        return view('admin.setting.aboute', compact('images', 'setting_detail'));
    }

    public function laws()
    {
        $setting_detail = Setting::first();

        $images = ArtcilePictures::all();
        return view('admin.setting.laws', compact('images', 'setting_detail'));
    }
    public function questions()
    {
        $setting_detail = Setting::first();

        if (is_null($setting_detail)) {
            $setting_detail = Setting::create([
                'address' => 'آدرس سایت',
                'telephone' => 'آدرس سایت',
                'telephone2' => 'آدرس سایت',
                'longitude' => 'آدرس سایت',
                'latitude' => 'آدرس سایت',
                'instagram' => 'آدرس سایت',
                'telegram' => 'آدرس سایت',
                'facebook' => 'آدرس سایت',
                'questions' => 'آدرس سایت',
                'laws' => 'آدرس سایت',
                'aboute' => 'آدرس سایت',
                'contact_us' => 'آدرس سایت',
            ]);
            DB::commit();
        }

        $images = ArtcilePictures::all();
        return view('admin.setting.questions', compact('images', 'setting_detail'));
    }

    public function contact()
    {
        $setting_detail = Setting::first();

        $images = ArtcilePictures::all();
        return view('admin.setting.contact', compact('images', 'setting_detail'));
    }

    public function ways()
    {
        $setting_detail = Setting::first();
        $images = ArtcilePictures::all();

        return view('admin.setting.ways', compact('images', 'setting_detail'));
    }

    public function productPageGuid()
    {
        $setting_detail = Setting::first();
        $images = ArtcilePictures::all();

        return view('admin.setting.productGuid', compact('images', 'setting_detail'));
    }

    public function bugGiud()
    {
        $setting_detail = Setting::first();
        $images = ArtcilePictures::all();
        return view('admin.setting.buyguid', compact('images', 'setting_detail'));
    }

    public function vendorPageGuid()
    {
        $setting_detail = Setting::first();

        $images = ArtcilePictures::all();
        return view('admin.setting.vendorGuid', compact('images', 'setting_detail'));
    }

    public function AddPageGuid()
    {
        $setting_detail = Setting::first();

        $images = ArtcilePictures::all();
        return view('admin.setting.Add', compact('images', 'setting_detail'));
    }

    public function footer()
    {
        $setting_detail = Setting::first();

        $footerLinks = footerLinks::all();

        return view('admin.setting.footer', compact('setting_detail', 'footerLinks'));
    }

    public function storefooterLink(Request $request)
    {
        footerLinks::create([
            'name' => $request->name,
            'link' => $request->link,
        ]);
        DB::commit();

        $setting_detail = Setting::first();

        $footerLinks = footerLinks::all();

        return view('admin.setting.footer', compact('setting_detail', 'footerLinks'));
    }

    public function deletefooterLink(Request $request)
    {
        $footerLink = footerLinks::find($request->id)->delete();
        DB::commit();
        $this->footer();

        $setting_detail = Setting::first();

        $footerLinks = footerLinks::all();

        return view('admin.setting.footer', compact('setting_detail', 'footerLinks'));
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'fileName' => 'required',
            'page' => 'required',
        ]);

        $setting_detail = Setting::first();

        if ($request->page) {

            $page = $request->page;
            switch ($page) {
                case 'vendor':
                    $setting_detail->update([
                        'vendor_video_name' => null,
                    ]);
                    break;

                case 'buy':
                    $setting_detail->update([
                        'buy_video_name' => null,
                    ]);
                    break;

                case 'Add':
                    $setting_detail->update([
                        'Ad_video_name' => null,
                    ]);
                    break;

                case 'product':
                    $setting_detail->update([
                        'product_video_name' => null,
                    ]);
                    break;

            }

            DB::commit();
        }

        return redirect()->back();

    }

    public function EditHome()
    {

        $countSetting = Setting::first();

        $slider = new Sliders();
        $availableSliders = $slider->availableNoe();

        $speciallProducts = resolve(SpecialProductsController::class)->get_available($countSetting->SpecialPcount);
        $most_view_products = resolve(ProductController::class)->Home_most_view_products($countSetting->MostViewProduct);
        $popularProducts = resolve(ProductController::class)->HomePopulars($countSetting->PopularVCount);

        $specialVendors = resolve(SpecialVendorsController::class)->get_available($countSetting->SpecialVCount);
        $popularVendorrs = resolve(HomeVendorController::class)->HomePopulars($countSetting->PopularVCount);
        $most_product_vendors = resolve(VendorsProductController::class)->Home_most_product_vendors();

        // dd($specialVendors);

        $vendors = resolve(HomeVendorController::class)->Home_index();
        $products = resolve(ProductController::class)->HomeIndex();

        $site_setting = SiteSetting::first();

        $Vendors_count = count(Vendor::all());
        $Products_count = count(Product::all());

        $Articles_count = count(CategoryArticle::all());

        $vendors = Vendor::all();

        return view('home.Admin.edit', compact('vendors', 'popularProducts', 'popularVendorrs', 'Vendors_count', 'Products_count', 'availableSliders', 'Articles_count', 'products', 'site_setting', 'speciallProducts', 'specialVendors', 'most_view_products', 'most_product_vendors'));

    }

    public function TurnOnOffFromHome(Request $request)
    {
        $setting = SiteSetting::first();

        if ($request->sl == "1") {

            if ($request->sliders) {
                $setting->update([

                    'sliders' => 1,
                ]);

            } else {
                $setting->update([

                    'sliders' => 0,
                ]);

            }

        }

        if ($request->g1 == "1") {
            if ($request->HomeG1) {
                $setting->update([

                    'gif1' => 1,
                ]);

            } else {
                $setting->update([

                    'gif1' => 0,
                ]);

            }

        }
        if ($request->g2 == "1") {
            if ($request->HomeG2) {
                $setting->update([

                    'gif2' => 1,
                ]);

            } else {
                $setting->update([

                    'gif2' => 0,
                ]);

            }

        }

        if ($request->str == "1") {
            if ($request->HomeStr) {

                $setting->update([

                    'stories' => 1,
                ]);

            } else {

                $setting->update([

                    'stories' => 0,
                ]);
            }
        }

        if ($request->prd == "1") {
            if ($request->HomePrd) {

                $setting->update([

                    'products' => 1,
                ]);

            } else {

                $setting->update([

                    'products' => 0,
                ]);
            }
        }

        if ($request->lin1 == "1") {
            if ($request->HomeLin1) {

                $setting->update([

                    'insid_links' => 1,
                ]);

            } else {

                $setting->update([

                    'insid_links' => 0,
                ]);
            }
        }

        if ($request->vndr == "1") {
            if ($request->HomeVndrs) {

                $setting->update([

                    'vendors' => 1,
                ]);

            } else {

                $setting->update([

                    'vendors' => 0,
                ]);
            }
        }

        if ($request->lin2 == "1") {
            if ($request->links) {

                $setting->update([

                    'links' => 1,
                ]);

            } else {

                $setting->update([

                    'links' => 0,
                ]);
            }
        }

        if ($request->blgg == "1") {
            if ($request->articles) {

                $setting->update([

                    'articles' => 1,
                ]);

            } else {

                $setting->update([

                    'articles' => 0,
                ]);
            }
        }

        if ($request->slg == "1") {
            if ($request->center && $request->title) {
                $setting3 = Setting::first();

                $setting3->update([

                    'Slogan_title' => $request->title,
                    'Slogan_center' => $request->center,
                ]);

            }
        }

        return redirect()->route('admin.EditHome');
    }

    public function updateGif1(Request $request)
    {
        $setting = Setting::first();

        if ($request->gif1) {
            $gif1 = $request->gif1;

            $fileNameGif1 = generateFileName($gif1->getClientOriginalName());

            $gif1->move(public_path(env('HOME_GIFS_DIRECTORY')), $fileNameGif1);

        } else {
            $fileNameGif1 = $setting->gif1;
        }

        if ($request->gif2) {

            $gif2 = $request->gif2;

            $fileNameGif2 = generateFileName($gif2->getClientOriginalName());

            $gif2->move(public_path(env('HOME_GIFS_DIRECTORY')), $fileNameGif2);

        } else {
            $fileNameGif2 = $setting->gif2;
        }

        $setting->update([
            'gif1' => $fileNameGif1,
            'gif2' => $fileNameGif2,
            'gif1Link' => $request->gif1Link ? $request->gif1Link : $setting->gif1Link,
            'gif2Link' => $request->gif2Link ? $request->gif2Link : $setting->gif2Link,
        ]);

        if ($request->submitBt) {
            return redirect()->route('admin.settindDetail.index');
        }

        return redirect()->back();

    }

    public function subtitle(Request $request)
    {

        $setting = Setting::first();

        return view('admin.setting.subtitle', compact('setting'));
    }

    public function updateguidProductPic(Request $request)
    {

        $ppic = $request->guidProductPic;
        $fileName = generateFileName($ppic->getClientOriginalName());
        $ppic->move(public_path(env('HOME_LINKS_PIC')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'guidProductPic' => $fileName,
        ]);

        return redirect()->back();

    }
    public function updateguidVendorPic(Request $request)
    {
        $vpic = $request->guidVendorPic;

        $fileName = generateFileName($vpic->getClientOriginalName());

        $vpic->move(public_path(env('HOME_LINKS_PIC')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'guidVendorPic' => $fileName,
        ]);

        return redirect()->back();
    }
    public function updateguidBuyPic(Request $request)
    {

        $buypic = $request->guidBuyPic;

        $fileName = generateFileName($buypic->getClientOriginalName());

        $buypic->move(public_path(env('HOME_LINKS_PIC')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'guidBuyPic' => $fileName,
        ]);

        return redirect()->back();

    }

    public function aboute_usImg(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_GUID_ICONS')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'home_icon_about_us' => $fileName,
        ]);

        return redirect()->back();

    }

    public function home_icon_laws(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_GUID_ICONS')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'home_icon_laws' => $fileName,
        ]);

        return redirect()->back();

    }

    public function home_icon_questions(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_GUID_ICONS')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'home_icon_questions' => $fileName,
        ]);

        return redirect()->back();

    }

    public function home_icon_Adds(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_GUID_ICONS')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'home_icon_Adds' => $fileName,
        ]);

        return redirect()->back();

    }

    public function blogPic_news(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_BLOG_IMAGES')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'blogPic_news' => $fileName,
        ]);

        return redirect()->back();

    }

    public function blogPic_share(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_BLOG_IMAGES')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'blogPic_share' => $fileName,
        ]);

        return redirect()->back();

    }

    public function blogPic_Articles(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_BLOG_IMAGES')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'blogPic_Articles' => $fileName,
        ]);

        return redirect()->back();

    }

    public function blogPic_guids(Request $request)
    {
        $file = $request->file;

        $fileName = generateFileName($file->getClientOriginalName());

        $file->move(public_path(env('HOME_LINKS_BLOG_IMAGES')), $fileName);

        $setting = Setting::first();

        $setting->update([
            'blogPic_guids' => $fileName,
        ]);

        return redirect()->back();

    }

    public function EditHomeCounts(Request $request)
    {

        $setting = Setting::first();

        return view('admin.setting.EditHomeCount', compact('setting'));
    }

    public function UpdateHomeCounts(Request $request)
    {

        $setting = Setting::first();

        $setting->update([
            'SpecialPcount' => $request->SpecialPcount,
            'MostViewProduct' => $request->MostViewProduct,
            'PopularPCount' => $request->PopularPCount,
            'SpecialVCount' => $request->SpecialVCount,
            'MostPvendors' => $request->MostPvendors,
            'PopularVCount' => $request->PopularVCount,
            'sliderCount' => $request->sliderCount,
        ]);

        return redirect()->route('admin.settindDetail.index');

    }

    public function editGifsPage()
    {

        $setting = Setting::first();

        return view('admin.setting.gifs', compact('setting'));
    }

    public function dargahSettingPage()
    {

        $setting = SiteSetting::first();

        return view('admin.setting.dargah', compact('setting'));

    }

    public function dargahUpdate(Request $request)
    {

        if (Auth::user()->id != "11" && Auth::user()->id != "12") {

            session()->flash('msg', 'access denied');
            return redirect()->route('admin.settindDetail.index');
        }

        $setting = SiteSetting::first();

        $amounts = $request->only([
            'storyPay',
            'SliderPay',
            'SliderPayThree',
            'SliderPaySix',
            'SliderPayYear',
            'SpcVPay',
            'SpcVPayThree',
            'SpcVPaySix',
            'SpcVPayYear',
            'SpcPPay',
            'SpcPPayThree',
            'SpcPPaySix',
            'SpcPPayYear',
            'ladderPPay',
            'ladderVPay',
        ]);

        foreach ($amounts as $key => $value) {

            if ($value > 0 && $value < 1000) {

                session()->flash('amountErr', 'مقادیر وارد شده نباید کمتر از 1000 ریال باشد');

                return back();

            }

        }

        $setting->update([

            'paymentStatus' => $request->paymentStatus ? 1 : 0,

            'storyPayStatus' => $request->storyPayStatus ? 1 : 0,

            'storyPay' => $request->storyPay ? $request->storyPay : 0,

            'SliderPayStatus' => $request->SliderPayStatus ? 1 : 0,

            'SliderPay' => $request->SliderPay ? $request->SliderPay : 0,
            'SliderPayThree' => $request->SliderPayThree ? $request->SliderPayThree : 0,
            'SliderPaySix' => $request->SliderPaySix ? $request->SliderPaySix : 0,
            'SliderPayYear' => $request->SliderPayYear ? $request->SliderPayYear : 0,

            'SpcVPayStatus' => $request->SpcVPayStatus ? 1 : 0,

            'SpcVPay' => $request->SpcVPay ? $request->SpcVPay : 0,
            'SpcVPayThree' => $request->SpcVPayThree ? $request->SpcVPayThree : 0,
            'SpcVPaySix' => $request->SpcVPaySix ? $request->SpcVPaySix : 0,
            'SpcVPayYear' => $request->SpcVPayYear ? $request->SpcVPayYear : 0,

            'SpcPPayStatus' => $request->SpcPPayStatus ? 1 : 0,

            'SpcPPay' => $request->SpcPPay ? $request->SpcPPay : 0,
            'SpcPPayThree' => $request->SpcPPayThree ? $request->SpcPPayThree : 0,
            'SpcPPaySix' => $request->SpcPPaySix ? $request->SpcPPaySix : 0,
            'SpcPPayYear' => $request->SpcPPayYear ? $request->SpcPPayYear : 0,

            'LadderPPayStatus' => $request->LadderPPayStatus ? 1 : 0,

            'ladderPPay' => $request->ladderPPay ? $request->ladderPPay : 0,

            'ladderVPayStatus' => $request->ladderVPayStatus ? 1 : 0,

            'ladderVPay' => $request->ladderVPay ? $request->ladderVPay : 0,

        ]);

        session()->flash('msg', 'تنظیمات درگاه با موفقیت ذخیره شد');

        return redirect()->route('admin.settindDetail.index');

    }

    public function guidBuyProduct()
    {

    }

    public function picturesBookMarkets()
    {

        $images = ArtcilePictures::latest()->get();

        return view('admin.setting.picturesBookMarkets', compact('images'));

    }

    public function DestroyPicFromBookmarkets(Request $request)
    {

        $image = ArtcilePictures::findOrFail($request->id);

        $filePAth = public_path(env('ARTICLE_IMAGES_UPLOAD_PATH') . $image->image);

        if (file_exists($filePAth)) {
            unlink($filePAth);
        }

        $image->delete();

        session()->flash('deleted', 'عکس مورد نظر با موفقیت حذف شد');
        return redirect()->back();
    }

    public function dashboardHelp()
    {
        return view('user.dashboardHelp');
    }
}
