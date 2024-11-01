<?php

namespace App\Models;

use App\Models\Admin\ProductComments;
use App\Models\Admin\SpecialProducts;
use App\Models\Admin\SpecialVendors;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "vendors";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    

    public function notPinnedProdducts()
    {
        return $this->hasMany(Product::class)->whereNull('VendorPinNumber')->where('status' , '!=' , 'new')->orderByDesc('VendorPinNumber')->latest();

    }

    public function pinnedProducts()
    {
        return $this->hasMany(Product::class)->whereNotNull('VendorPinNumber')->where('status' , '!=' , 'new')->orderByDesc('VendorPinNumber')->latest();
    }
    public function home_products()
    {
        return $this->hasMany(Product::class)->where('status' , '!=' , 'new')->limit(5);
    }

    public function anotherProducts()
    {
        $query =  $this->hasMany(Product::class)->where('status' , '!=' , 'new')->orderByDesc('VendorPinNumber')->orderByDesc('ladder_product');



        if(Route::currentRouteName() == "home"){
            $query->limit(5);
        }

        return $query;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_replace([' '], ['-'], $value);
    }

    public function socialMedias()
    {
        return $this->hasOne(Vendors_SocialMedia::class);
    }

    public function AdminMassages()
    {
        return $this->hasMany(MessageFromAdmin::class)->latest();
    }

    public function unreadMassages()
    {
        return $this->hasMany(MessageFromAdmin::class)->whereNull('seen_at');

    }

    public function unreadNotifableMassage()
    {
        return $this->hasMany(MessageFromAdmin::class)->whereNull('seen_at')->where('subject', 'تایید محصول')->orWhere('subject', 'تایید قزوشگاه')->orderByDesc('id');

    }

    public function ActivProducts()
    {
        return $this->hasMany(Product::class)->where('status', '!=', 'new');
    }

    public function Available_comments()
    {
        return $this->hasMany(ProductComments::class)->where('is_active', 1)->whereNull('MainParent');
    }

    public function SpeciallProducts()
    {
        return $this->hasMany(SpecialProducts::class);
    }

    public function favorites()
    {
        return $this->hasMany(favorite::class);
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'vendor_id');
    }

    public function followers()
    {

        return $this->hasMany(Follow::class, 'following');

    }

    public function followedOrNot($id)
    {
        return $this->hasOne(Follow::class)->where('following', $id)->where('vendor_id', Auth::user()->vendor->id)->get();
    }

    public function Tickets()
    {
        return $this->hasMany(Ticket::class, 'username')->whereNull('answered_to')->orderByDesc('id');
    }

    public function rates()
    {
        return $this->hasMany(RateVendor::class, 'vendor_id');
    }

    public function mySliders()
    {
        return $this->hasMany(Sliders::class, 'vendor_id')->latest();
    }

    public function stories()
    {
        return $this->hasMany(story::class);
    }

public function activeStories()
    {

        $to = Carbon::now();

        $from = Carbon::now()->subHours(24);

        return $this->hasMany(story::class)->where('sendBy', 'vendor')->where('paymentStatus' , '!=' , 'inPaymentQueue')->whereNotNull('acceptedbyAdmin')->whereBetween('created_at', [$from, $to]);
    }

    public function archivedStories()
    {
        $newDateTime = Carbon::now();
        $from = Carbon::now()->subHours(24);

        return $this->hasMany(story::class)->whereNotNull('acceptedbyAdmin')->whereDate('to', '<', $newDateTime);
    }

    public function StoriesInQueue()
    {

        $to = Carbon::now();

        $from = Carbon::now()->subHours(24);

        return $this->hasMany(story::class)->whereNull('acceptedbyAdmin')->whereBetween('created_at', [$from, $to]);
    }

    public function deniedStories()
    {

        return $this->hasMany(story::class)->where('status', 0);
    }

    public function hasActiveStory($vendor_id  = null)
    {


        if(is_null($vendor_id)){
            $vendor_id = $this->id;
        }

        $to = Carbon::now();

        $from = Carbon::now()->subHours(24);

        $story = story::where('vendor_id', $vendor_id)->where('sendBy', 'vendor')->whereNotNull('acceptedbyAdmin')->where('paymentStatus', "!=", "inPaymentQueue")->whereBetween('created_at', [$from, $to])
            ->where('sendBy', 'vendor')
            ->get();

        if (count($story) > 0) {

            return 1;
        } else {
            return 0;
        }

    }

    public function scopeNotNew($query)
    {
        return $query->where('status', '!=', 'new')->where('status', '!=', 'no');

    }



    

    public function SpecialVendors()
    {
        return $this->hasMany(SpecialVendors::class)->OrderBy('fromDate');
    }

    public function articles()
    {
        return $this->hasMany(UserArticles::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function newComments(){

        return $this->hasMany(ProductComments::class)->where('seenOrNot' , 0)->where('is_active' , 1);

    }

    public function getCommentCounts()
    {
        return $this->hasMany(ProductComments::class);
    }


    public function scopeNotAdmin($query){
    

        

    }
}
