<?php

use App\Models\Admin\SpecialProducts;
use App\Models\Admin\SpecialVendors;
use App\Models\Product;
use App\Models\story;
use App\Models\Vendor;
use App\Models\Vendors_SocialMedia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

function generateFileName($name)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $microsecond = Carbon::now()->microsecond;
    return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
}

function convertShamsiToGregorianDate($date)
{
    if ($date == null) {
        return null;
    }
    $pattern = "/[-\s]/";
    $shamsiDateSplit = preg_split($pattern, $date);

    $arrayGergorianDate = verta()->getGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);

    return implode("-", $arrayGergorianDate) . " " . $shamsiDateSplit[3];
}

function getPersianOrderName($orderName)
{

    switch ($orderName) {
        case 'story':

            return "استوری";

            break;
        case 'increaseCredit':

            return "شارژ کیف پول";

            break;

        default:
            # code...
            break;
    }

    function sessionUpdate($array, $update = true)
    {
        foreach ($array as $kay => $value) {
            $session = session()->get($kay);
            if ($session == null) {
                $session = [];
            }
            if ($update and gettype($value) == 'array') {
                updateProperty($session, $value);
                $value = $session;
            }
            session()->put($kay, $value);
            session()->save();
        }
    }
}
function userDashboard(array $wich = null)
{

    $dashSetting = \App\Models\Admin\SiteSetting::first();

    if (is_array($wich)) {

        foreach ($wich as $value) {

            switch ($value) {
                case 'usersSendSlider':

                    if ($dashSetting->usersSendSlider) {
                        return true;
                    }
                    break;
                case 'usersSendStory':

                    if ($dashSetting->usersSendStory) {
                        return true;
                    }
                    break;
                case 'usersLaddelV':

                    if ($dashSetting->usersLaddelV) {
                        return true;
                    }
                    break;
                case 'usersLaddelP':

                    if ($dashSetting->usersLaddelP) {
                        return true;
                    }
                    break;
                case 'usersUpgradeProduct':

                    if ($dashSetting->usersUpgradeProduct) {
                        return true;
                    }
                    break;
                case 'usersUpgradeVendor':

                    if ($dashSetting->usersUpgradeVendor) {
                        return true;
                    }
                    break;

                default:
                    return false;
                    break;
            }
        }
    } else {

        if (
            $dashSetting->usersSendSlider ||
            $dashSetting->usersSendStory ||
            $dashSetting->usersLaddelV ||
            $dashSetting->usersLaddelP ||
            $dashSetting->usersUpgradeProduct ||
            $dashSetting->usersUpgradeVendor
        ) {
            return true;
        } else {
            return false;
        }
    }
}

function getVendorLastDate($vendorId, $type)
{

    $vendor = App\Models\Vendor::findOrFail($vendorId);

    if (!is_null($vendor->EditedData)) {
        $LastUpdated = json_decode($vendor->EditedData, true);
        if (array_key_exists($type, $LastUpdated)) {
            return $LastUpdated[$type];
        } else {
            return $vendor[$type];
        }
    } else {
        if( $vendor->socialMedias){

            $vendorSocialMedia = $vendor->socialMedias->toArray();
            
            if(array_key_exists($type , $vendorSocialMedia)){
                return $vendorSocialMedia[$type];
            }
            
        }
        return $vendor[$type];
    }
}

function getProductLastDate($pid ,  $type){

    $product = App\Models\Product::findOrFail($pid);

    if (!is_null($product->EditedData)) {

        $LastUpdated = json_decode($product->EditedData, true);
        if (array_key_exists($type, $LastUpdated)) {
            return $LastUpdated[$type];
        }elseif(array_key_exists(0, $LastUpdated)  && is_array($LastUpdated[0]) && array_key_exists($type, $LastUpdated[0])){
            return $LastUpdated[0][$type];
        } else {
            return $product[$type];
        }
    } else {
        return $product[$type];
    }
   
}
    
function getVendorLastSocialMediaDate($vendorId, $type)
{

    $vendor = App\Models\Vendor::findOrFail($vendorId);

    if (!is_null($vendor->EditedData)) {

        $LastUpdated = json_decode($vendor->EditedData, true);

        if (array_key_exists($type, $LastUpdated)) {
            return $LastUpdated[$type];
        } else {
            return null;
        }
    } else {

        $socialMedia = App\Models\Vendors_SocialMedia::where('vendor_id', $vendorId)->first();

        
        if ($socialMedia) {
            switch ($type) {
                case 'telegram':
                    $limit = 20;
                    break;
                case 'robika':
                    $limit = 0;
                    break;
                case 'site_url':
                    $limit = 0;
                    break;
                case 'instagram':
                    $limit = 26;
                    break;
                case 'aparat':
                    $limit = 23;
                    break;
                case 'whatsapp':
                    if(strlen($socialMedia['whatsapp']) > 39){
                        $limit = 39;
                    }else{
                        $limit = 0;
                    }
                    break;

                    case 'bale':            
                        $limit = 0;
                        break;
    
                default:
                    $limit = 0;    
                
                    break;
            }
            // return $limit;
            return substr($socialMedia[$type] , $limit ) ;
        } else {
            return null;
        }
    }
}

function loginedUserFollwingVendorStatus($id){

   $vendor =   Vendor::findOrFail($id);

   
   
   if(Auth::user()){
       $thisVendor =  Auth::user()->vendor;

        $followedStatus = $thisVendor->following()->followStatus($id)->get();
        $followerStatus = $thisVendor->followers()->followerStatus($id)->get();

        
        
        

        if(count($followedStatus)>0){
            return 2;
        }elseif(count($followerStatus)>0){
            
            return 1;
            
        }else{
            return 0;
        }
        
   }else{
    return  abort(404);
   }




}

function convertPersianToEnglishNumber($string) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    $num = range(0, 9);

    
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);


    $englishNumbersOnly = preg_replace('/\s+/', '', $englishNumbersOnly);


    return $englishNumbersOnly;
}

function removeCarsInsideNumbers($string){
    
    $convertedToEnglish = "";


    $num = range(0, 9);


    for ($i=0; $i < strlen($string) ; $i++) { 
        
        if(in_array($string[$i] , $num)){
            $convertedToEnglish = $convertedToEnglish.$string[$i];
        }
    }


    if($convertedToEnglish == ""){
        $convertedToEnglish = null ;
    }

    return $convertedToEnglish;

}

function SliderClass($availableSlidersCount ,$key){

    $key = $key+1;

    
    if($availableSlidersCount == 1){
        return "active";
    }elseif($availableSlidersCount%2 == 0 ){
        
        if($key == 2){
            return "active";
        }else{
            if($key < 2 && (2-$key) > 0){
                return "prev-".$key;
            }elseif($key > 2 &&  ( $key - 2) > 0 && ($key-2) < 3 ){
                return "next-".$key;
            }
        }
    }else{

        $center = ceil($availableSlidersCount/2);

    

        if($key ==  $center ){
            return "active";
        }else{
            if($key < $center && ($center-$key) <= 2){
                return "prev-".$center-$key;
            }elseif($key > $center &&  ($key-$center) <= 2 ){
            
                return "next-".$key-$center;
            }
        }
    }

}

function  ProductCardlinkName(){
  
  
    if(Route::currentRouteName() == "products.show"){
        return "مشاهده محصول";
    }
    return "مشاهده فروشگاه";


}

function tagableTextToManual($tagable){

    return strip_tags(nl2br($tagable));
}

function seenedBeforStory($storyVendorId){
    $seenSession = Session::get('viewStory');



    if (is_null($seenSession) || !is_array($seenSession) || !in_array($storyVendorId , $seenSession)) {
        
        return false;
    }

    return true;

}

function checkIfHasActiveSpc($id){

    $product = Product::findOrFail($id);    

    $time_now = Carbon::now();
    
    $lastCreatedAndActiveNow  =  SpecialProducts::Where('vendor_id', $product->vendor_id )
    ->where('toDate', '>=', $time_now)->where("product_id" , $id)->first();

    if ($lastCreatedAndActiveNow){
        return true;
    }

    return false;
}

function checkIfHasActiveSpcVendor($id){

    $vendor = Vendor::findOrFail($id);    

    $time_now = Carbon::now();
    
    $lastCreatedAndActiveNow  =  SpecialVendors::Where('vendor_id', $vendor->id )
    ->where('toDate', '>=', $time_now)->first();

    if ($lastCreatedAndActiveNow){
        return true;
    }

    return false;
}

function checkIfHasActiveStory($id){

    $product = Product::findOrFail($id);    

    $to = Carbon::now();
        
    $from = Carbon::now()->subHours(24);

    $lastCreatedAndActiveNow  =  story::whereBetween('created_at', [$from, $to])->

    where("product_id" , $id)->first();

    if ($lastCreatedAndActiveNow){
        return true;
    }

    return false;
}



function productPageDoesentSort(){
    
    if (request()->has('SortBy') ) {
        if(request()->SortBy == "latest"){
            return true;
        }
        return false;
    }

    return true;

}


function getCurrentRouteForFilterInProductPage(){
    $route = \Request::route()->getName();

    
    if ($route == "categories.show" || $route == "showByBrand"){
        return url()->full();
    }
    
    return route($route);
}

function getCompCount() : int {
    if(Session::has('compList')){

        $comp = Session::get('compList');
        $compCount = count($comp);
    }else{
        $compCount = 0;
    }
    return $compCount;
}