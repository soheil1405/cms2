<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VendorExcelExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SpecialProductsController;
use App\Http\Controllers\SpecialVendorsController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\VendorsSocialMediaController;
use App\Models\Admin\SpecialProducts;
use App\Models\Admin\SpecialVendors;
use App\Models\Brand;
use App\Models\favorite;
use App\Models\Follow;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\story;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Vendors_SocialMedia;
use App\Repositories\AdminMessageRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;
use Maatwebsite\Excel\Facades\Excel;

class AdminVendorController extends Controller
{

    public function dashboard()
    {

        $most_view_products = resolve(ProductController::class)->Home_most_view_products(5);

        $vendors_Order_By_loginCount = Vendor::OrderByDesc('login_count')->take(7)->get();

        $vendors_Order_By_loginTime = Vendor::OrderByDesc('last_login')
        
        ->take(7)->get();

        
        $activeProducts = Product::all()->count();

        $activeVendores = Vendor::all()->count();


        $activeSpcV = resolve(SpecialVendorsController::class)->get_available()->count();

        $activeSpcP = resolve(SpecialProductsController::class)->get_available()->count();

        $slider = new Sliders();
        $activeSliders = $slider->availableNoe()->count();

        $stories = new story();

        $activeStories = $stories->availables()->count();

        return view(
            'admin.dashboard',
            compact(
                'most_view_products',
                'vendors_Order_By_loginTime',
                'vendors_Order_By_loginCount',
                'activeProducts',
                'activeVendores',
                'activeSpcV',
                'activeSpcP',
                'activeSliders',
                'activeStories'

            )
        );
    }

    public function index(Request $request)
    {
        $vendors = Vendor::where('adminVendor', 'no')->where('status', 'yes')->OrderBy('id')->get();

        $vendors_in_Queue = Vendor::where('adminVendor', 'no')->Where('status', '!=', 'yes')->get();

        $count_of_vendors_in_Queue = count($vendors_in_Queue);

        if ($request->search) {
            $vendors = Vendor::where('adminVendor', 'no')->where('name', "LIKE", '%' . $request->search . "%")->paginate(20);
        }

        if ($request->excelExport) {
            ob_end_clean();
            ob_start();
            return Excel::download(new VendorExcelExport, 'instabargh.vendors' . now() . '.xlsx');
        }

        return view('admin.vendors.index', compact('vendors', 'count_of_vendors_in_Queue', 'vendors_in_Queue'));
    }

    public function show($id, Request $request)
    {

        $vendor = Vendor::find($id);

        $products = Product::where('vendor_id', $vendor->id)->get();

        $users = $vendor->user->AllEmployers;

        $usersId = [];

        $usersCreditCount = 0;
        foreach ($users as $user) {

            array_push($usersId, $user->id);

            $usersCreditCount += $user->CREDIT;
        }

        if ($request->ExcelExport) {

            array_push($usersId, $vendor->user->id);

            $allorders = Orders::whereIn('user_id', $usersId)->get();

            ob_end_clean();
            ob_start();

            $name = "vendor_" . $vendor->name;

            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($allorders, 'userOrdes'), 'instabargh.' . $name . now() . '.xlsx');
        }

        $user = $vendor->user;

        $today = Carbon::today();

        $subMonth = Carbon::today()->subMonth()->format('Y-m-d');

        $subDay = Carbon::today()->subDay()->format('Y-m-d');
        $subWeek = Carbon::today()->subWeek()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');

        $EmployeelastMonthOrdersFinalPays = 0;
        $EmployeelastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();

        $EmployeelastWeekOrdersFinalPays = 0;
        $EmployeelastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();

        $EmployeelastDayOrdersFinalPays = 0;
        $EmployeelastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();

        $EmployeetotalFinalPays = 0;
        $Employeetotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->get();

        //
        foreach ($EmployeelastMonthOrders as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalPays += $item->totalAmount;
            }
        }

        //
        foreach ($EmployeelastWeekOrders as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalPays += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrders as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalPays += $item->totalAmount;
            }
        }
        //
        foreach ($Employeetotal as $item) {

            if ($item->amountAfterOffer) {
                $EmployeetotalFinalPays += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalPays += $item->totalAmount;
            }
        }

        $UserLastMonthOrdersFinal = 0;
        $UserLastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinal = 0;
        $UserLastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinal = 0;
        $UserLastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinal = 0;
        $UserTotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->get();

        //
        foreach ($UserLastMonthOrders as $item) {

            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrders as $item) {

            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrders as $item) {

            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinal += $item->totalAmount;
            }
        }

        foreach ($UserTotal as $item) {

            if ($item->amountAfterOffer) {
                $UserTotalFinal += $item->amountAfterOffer;
            } else {
                $UserTotalFinal += $item->totalAmount;
            }
        }

        $EmployeelastMonthOrdersFinalIncreaseCredit = 0;
        $EmployeelastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();

        $EmployeelastWeekOrdersFinalIncreaseCredit = 0;
        $EmployeelastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();

        $EmployeelastDayOrdersFinalIncreaseCredit = 0;
        $EmployeelastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();

        $EmployeetotalFinalIncreaseCredit = 0;
        $EmployeetotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->whereIn('user_id', $usersId)->get();

        //
        foreach ($EmployeelastMonthOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }

        //
        foreach ($EmployeelastWeekOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeetotalIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeetotalFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalIncreaseCredit += $item->totalAmount;
            }
        }

        $UserLastMonthOrdersFinalIncreaseCredit = 0;
        $UserLastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalIncreaseCredit = 0;
        $UserLastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalIncreaseCredit = 0;
        $UserLastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalIncreaseCredit = 0;
        $UserTotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->get();

        //
        foreach ($UserLastMonthOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }

        foreach ($UserTotalIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserTotalFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalIncreaseCredit += $item->totalAmount;
            }
        }

        $EmployeelastMonthOrdersFinalPaysParFromCredit = 0;
        $EmployeelastMonthOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subMonth, $today])->get();

        $EmployeelastWeekOrdersFinalPaysParFromCredit = 0;
        $EmployeelastWeekOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subWeek, $today])->get();

        $EmployeelastDayOrdersFinalPaysParFromCredit = 0;
        $EmployeelastDayOrdersParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->whereBetween('created_at', [$subDay, $today])->get();

        $EmployeetotalFinalPaysParFromCredit = 0;
        $EmployeetotalParFromCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->whereIn('user_id', $usersId)->get();

        //
        foreach ($EmployeelastMonthOrdersParFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastMonthOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastMonthOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }

        //
        foreach ($EmployeelastWeekOrdersParFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastWeekOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastWeekOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeelastDayOrdersParFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeelastDayOrdersFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeelastDayOrdersFinalPaysParFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($EmployeetotalParFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $EmployeetotalFinalPaysParFromCredit += $item->amountAfterOffer;
            } else {
                $EmployeetotalFinalPaysParFromCredit += $item->totalAmount;
            }
        }

        $UserLastMonthOrdersFinalPayFromCredit = 0;
        $UserLastMonthOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalPayFromCredit = 0;
        $UserLastWeekOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalPayFromCredit = 0;
        $UserLastDayOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalPayFromCredit = 0;
        $UserTotalPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->get();

        //
        foreach ($UserLastMonthOrdersPayFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersPayFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersPayFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }

        foreach ($UserTotalPayFromCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserTotalFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalPayFromCredit += $item->totalAmount;
            }
        }

        //

        array_push($usersId, $user->id);

        $successPayPersianStatus = ['پرداخت از طریق کیف پول', 'پرداخت تایید شده است.'];

        $vendorTotalPayTillNow = $UserTotalFinal + $EmployeetotalFinalPays + $UserTotalFinalIncreaseCredit + $EmployeetotalFinalIncreaseCredit;

        $stories = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'story')->whereIn('user_id', $usersId)->get();

        $sliders = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'slider')->whereIn('user_id', $usersId)->get();

        $ladderPpay = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'ladderPPay')->whereIn('user_id', $usersId)->get();

        $ladderVPay = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'ladderPpay')->whereIn('user_id', $usersId)->get();

        $specialProduct = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'specialProduct')->whereIn('user_id', $usersId)->get();

        $specialVendor = Orders::whereIn('persianStatus', $successPayPersianStatus)->where("orderType", 'specialVendor')->whereIn('user_id', $usersId)->get();

        $storiesSumAmount = 0;
        $slidersSumAmount = 0;

        $ladderPpaySumAmount = 0;
        $ladderVpaySumAmount = 0;

        $specialProductSumAmount = 0;
        $specialVendorSumAmount = 0;

        foreach ($stories as $item) {

            if (is_null($item->amountAfterOffer)) {
                $storiesSumAmount += $item->totalAmount;
            } else {
                $storiesSumAmount += $item->amountAfterOffer;
            }
        }

        foreach ($sliders as $item) {

            if (is_null($item->amountAfterOffer)) {
                $slidersSumAmount += $item->totalAmount;
            } else {
                $slidersSumAmount += $item->amountAfterOffer;
            }
        }

        foreach ($ladderPpay as $item) {

            if (is_null($item->amountAfterOffer)) {
                $ladderPpaySumAmount += $item->totalAmount;
            } else {
                $ladderPpaySumAmount += $item->amountAfterOffer;
            }
        }

        foreach ($ladderVPay as $item) {

            if (is_null($item->amountAfterOffer)) {
                $ladderVpaySumAmount += $item->totalAmount;
            } else {
                $ladderVpaySumAmount += $item->amountAfterOffer;
            }
        }

        foreach ($specialProduct as $item) {

            if (is_null($item->amountAfterOffer)) {
                $specialProductSumAmount += $item->totalAmount;
            } else {
                $specialProductSumAmount += $item->amountAfterOffer;
            }
        }
        foreach ($specialVendor as $item) {

            if (is_null($item->amountAfterOffer)) {
                $specialVendorSumAmount += $item->totalAmount;
            } else {
                $specialVendorSumAmount += $item->amountAfterOffer;
            }
        }

        $finalSum = $specialVendorSumAmount + $specialProductSumAmount + $ladderVpaySumAmount + $ladderPpaySumAmount + $slidersSumAmount + $storiesSumAmount;

        return view(
            'admin.vendors.showDetail',
            compact(
                'vendor',
                'products',
                ///////

                'stories',
                'sliders',

                'ladderPpay',
                'ladderVPay',

                'specialProduct',
                'specialVendor',

                "specialVendorSumAmount",
                'specialProductSumAmount',
                "ladderVpaySumAmount",
                "ladderPpaySumAmount",
                "slidersSumAmount",
                "storiesSumAmount",

                "finalSum",

                //////
                'UserTotal',
                'UserTotalFinal',
                'UserLastDayOrders',
                'UserLastDayOrdersFinal',
                'UserLastDayOrders',
                'UserLastWeekOrdersFinal',
                'UserLastMonthOrders',
                'UserLastMonthOrdersFinal',

                'Employeetotal',
                'EmployeetotalFinalPays',
                'EmployeelastDayOrders',
                'EmployeelastDayOrdersFinalPays',
                'EmployeelastWeekOrders',
                'EmployeelastWeekOrdersFinalPays',
                'EmployeelastMonthOrders',
                'EmployeelastMonthOrdersFinalPays',

                ////////
                'EmployeelastMonthOrdersFinalIncreaseCredit',
                'EmployeelastMonthOrdersIncreaseCredit',
                'EmployeelastWeekOrdersFinalIncreaseCredit',
                'EmployeelastWeekOrdersIncreaseCredit',
                'EmployeelastDayOrdersFinalIncreaseCredit',
                'EmployeelastDayOrdersIncreaseCredit',
                'EmployeetotalFinalIncreaseCredit',
                'EmployeetotalIncreaseCredit',

                'UserLastMonthOrdersFinalIncreaseCredit',
                'UserLastMonthOrdersIncreaseCredit',
                'UserLastWeekOrdersIncreaseCredit',
                'UserLastWeekOrdersFinalIncreaseCredit',
                'UserLastDayOrdersIncreaseCredit',
                'UserLastDayOrdersFinalIncreaseCredit',
                'UserTotalFinalIncreaseCredit',
                'UserTotalIncreaseCredit',

                /////////
                'EmployeelastMonthOrdersFinalPaysParFromCredit',
                'EmployeelastMonthOrdersParFromCredit',
                'EmployeelastWeekOrdersFinalPaysParFromCredit',
                'EmployeelastWeekOrdersParFromCredit',
                'EmployeelastDayOrdersFinalPaysParFromCredit',
                'EmployeelastDayOrdersParFromCredit',
                'EmployeetotalFinalPaysParFromCredit',
                'EmployeetotalParFromCredit',

                'UserLastMonthOrdersFinalPayFromCredit',
                'UserLastMonthOrdersPayFromCredit',
                'UserLastWeekOrdersFinalPayFromCredit',
                'UserLastWeekOrdersPayFromCredit',
                'UserLastDayOrdersFinalPayFromCredit',
                'UserLastDayOrdersPayFromCredit',
                'UserTotalFinalPayFromCredit',
                'UserTotalPayFromCredit',
                /////
                'vendorTotalPayTillNow',
                'usersCreditCount',

            )
        );
    }

    public function edit($id)
    {

        $vendor = Vendor::find($id);

        $user = $vendor->user;

        return view('admin.vendors.edit', compact('vendor', 'user'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        
        $request->validate([
            
            'title'             => 'required|string',
            'phone' => ['required', 'numeric'],
            'phone_number2' => ['numeric', 'nullable'],
            'cellphone' => 'required|numeric',

            'address' => 'required|string',
            'Social_telegram' => 'string',
            'Social_instagram' => 'string',
            'Social_aparat' => 'string',
            'Social_rubika' => 'string',
            'Social_email' => 'string',
            'Social_whatsapp' => 'string',
            'Category' => 'required',

        ]);


        // dd($request->all());
        // try {
            DB::beginTransaction();

            $cats = str_replace(',', '-', $request->Category);

            
            
            // $vendor = $vendor->update([
            //     'name' => ($vendor->name == $request->name) ? $request->name : $vendorName,
            //     'title' => ($vendor->name == $request->name) ? $request->name : $vendorName,
            //     'user_id' => $vendor->user->id,
            //     'category_activity' => strval($cats),
            //     'description' => $request->description,
            //     'address' => $request->address,
            //     'number' => $request->phone,
            //     'phone_number' => $request->cellphone,
            //     'phone_number2' => $request->phone_number2,
            //     'status' => 'yes',

            // ]);

            $newDatas = $vendor->EditedData;
            $decodedData = json_decode($newDatas, true);
    
            if($request->cover){


                $fileNameacover = generateFileName($request->cover->getClientOriginalName());

                $request->cover->move(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')), $fileNameacover);
         
                $vendor->update([
                    'cover'=>$fileNameacover
                ]);
                

            }elseif ( $decodedData && $decodedData['cover']) {
    
                if ($vendor->cover != 'default-cover.jpg' && file_exists(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')) . $vendor->cover)) {
                    unlink(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')) . $vendor->cover);
                }
    
                $vendor->update([
    
                    'cover' => getVendorLastDate($vendor->id, 'cover'),
                ]);
            }


            if($request->avatar){

                $fileNameavatar = generateFileName($request->avatar->getClientOriginalName());

                $request->avatar->move(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')), $fileNameavatar);
         
                $vendor->update([
                    'avatar'=>$fileNameavatar
                ]);
                

            }elseif ( $decodedData && $decodedData['avatar']) {
    
                if ($vendor->avatar != 'default-avatar.png' && file_exists(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $vendor->avatar)) {
    
                    unlink(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $vendor->avatar);
                }
    
                $vendor->update([
    
                    'avatar' => getVendorLastDate($vendor->id, 'avatar'),
                ]);
            }
    
            $venderSocials = Vendors_SocialMedia::where('vendor_id', $vendor->id)->first();
    
            if ($venderSocials) {
    
                $this->editVendorSocialMdia($request, $vendor->id);
            } else {
    
                $this->saveVendorSocialMdia($request, $vendor->id);
            }
    
    

            if($request->title != $vendor->title){
                
                    $vendorName = Username::setModel(Vendor::class)
                    ->setColum('name')
                    ->make(str_replace(' ', '-', $request->title));
    
                    $simpleNameVendor = Vendor::withTrashed()->where('name', 'LIKE', "%" . $vendorName . "%")->get();
                    
                    $count = rand(20, 50);
                    
                    if (count($simpleNameVendor) > 0) {
                        
                        foreach ($simpleNameVendor as $item) {
                        $count++;
                    }
                    
                    if ($count > 1) {
                        $vendorName = Username::setModel(Vendor::class)
                        ->setColum('name')
                        ->make(str_replace(' ', '-', $request->name) . "-" . strval($count + 1));
                    }
                }
            }else{
    
                $vendorName = $vendor->title;
            }   
            
            if ($request->latlng) {
       
                $latlng = explode("," , $request->latlng );
            }else{
                $latlng[0]= $vendor->lat ;
                $latlng[1] = $vendor->lng;
            }
    
            $vendor->update([
                'title' => $request->title,
                'name' => $vendorName,
                'description' => nl2br($request->description)
                ,
                'address' => $request->address,
                'number' => $request->phone,
                'phone_number' => $request->cellphone,
                'phone_number2' => $request->phone_number2,
                "apatatVideoLink" => $request->apatatVideoLink,
                'site_url' => $request->website,
                'status' => 'yes',
                'lat'=>$latlng ? $latlng[0] : $vendor->lat ,
                'lng'=>$latlng ? $latlng[1] : $vendor->lng ,
                'EditedData' => null,
                'category_activity' => $cats ,
                'EditReportText' => null,
            ]);
    
            session()->flash('success', 'تعییرات فروشگاه ' . $vendor->title . "با موفقیت ثبت شد");
            return redirect()->route('admin.vendors.index');
    





            DB::commit();
        // } catch (\Exception $ex) {
        //     DB::rollBack();

        //     // dd($ex);
        //     alert()->error('مشکل در ویرایش فروشگاه', $ex, 'اررور ناخواسته')->persistent('حله');
        //     return redirect()->back();
        // }

        alert()->success('فروشگاه مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.vendors.index');
    }

    public function acceptVendor(Request $request)
    {


        $request->validate([
            'id' => 'required',
        ]);
        $vendor = Vendor::find($request->id);

        if($vendor->status == "new"){
            $vendor->update([
                'laddered_at' => Carbon::now()
            ]);
        }

        $vendor->update([
            'status' => 'yes',
        ]);

        resolve(AdminMessageRepository::class)->sendAcceptVendorMessage($vendor);

        alert()->success('فروشگاه مورد نظر ویرایش شد ', 'باتشکر');

        return redirect()->route('admin.vendors.index');
    }

    public function allUsers(Request $request)
    {
        $users = User::all();

        $vendors = Vendor::latest()->orderBy('updated_at');

        $vendors = $vendors->paginate(20);

        if ($request->search) {

            $users = User::where('name', "LIKE", '%' . $request->search . "%")->paginate(20);
        }

        return view('admin.vendors.usersindex', compact('users', 'vendors'));
    }

    public function deleteUserPage($user)
    {

        $user = User::find($user);

        $vendors = Vendor::all();

        return view('admin.vendors.deleteUser', compact('user', 'vendors'));
    }

    public function destroyUser(Request $request)
    {

        $request->validate([
            'type' => 'required',
        ]);

        $user = User::find($request->username);
        if (!is_null($user->boss_id)) {



            foreach ($user->products as $product) {

                $product->update([

                    'user_id' => $user->boss_id
                ]);
            }

            session()->flash('success', ' کاربر ' . $user->name . 'حذف شد و محصولات ان به مدیر فروشگاه انتقال داده شد ...');


            $user->delete();
            return redirect()->route('admin.allUsers');
        }

        // dd($user);

        if ($request->type == "1") {

            $new_vendor = Vendor::find($request->vendor);

            foreach ($user->vendor->products as $product) {
                $product->update([
                    'vendor_id' => $new_vendor->id,
                    'last_vendor_name' => $user->name,
                ]);

                $this->deleteProductDetails($product);
            }
        } else {

            if ($user->vendor) {
                foreach ($user->vendor->products as $product) {

                    foreach ($product->All_Comments as $comment) {
                        $comment->delete();
                    }

                    $this->deleteProductDetails($product);

                    $product->delete();
                }
            }
        }

        if ($user->vendor) {

            $user->vendor->update([

                'name_before_delete' => $user->vendor->name,
                'name' => null,
            ]);

            $this->deleteVendorDetails($user->vendor);

            $user->vendor->delete();
        }

        $username = $user->name;
        $user->update([
            'mobile_before_delete' => $user->mobile,
            'mobile' => null,
        ]);

        $userEmployers = User::where('boss_id', $user->id)->get();

        foreach ($userEmployers as $Emploers) {

            $Emploers->update([
                'mobile_before_delete' => $Emploers->mobile,
                'mobile' => null,
            ]);

            $Emploers->delete();
        }

        $user->delete();

        if ($request->type == "1") {

            $new_vendor = Vendor::find($request->vendor);
            \Session::flash('success', ' کاربر ' . $username . 'با موفقیت حذف شد و محصولات آن به فروشگاه ' . $new_vendor->name . ' انتقال داده شد ');

            return redirect()->route('admin.allUsers');
        } else {
            \Session::flash('success', ' کاربر ' . $username . ' همراه با تمام اطلاعات آن حذف شذ ...');

            return redirect()->route('admin.allUsers');
        }
    }

    public function deleteVendorPage($vendor)
    {

        $vendor = Vendor::find($vendor);

        $AllVendors = Vendor::where('adminVendor', 'no')->get();

        return view('admin.vendors.deleteVendors', compact('vendor', 'AllVendors'));
    }

    public function destroyVendor(Request $request)
    {

        $request->validate([
            'type' => 'required',
        ]);

        // dd($request->all());

        $vendor = Vendor::findOrFail($request->vendor_id);

        if ($request->type == "1") {

            $new_vendor = Vendor::findOrFail($request->vendor);

            foreach ($vendor->products as $product) {

                $product->update([
                    'vendor_id' => $new_vendor->id,
                    'last_vendor_name' => $vendor->title,
                ]);

                $this->deleteProductDetails($product);
            }
        } else {

            foreach ($vendor->products as $product) {

                $this->deleteProductDetails($product);

                $product->delete();
            }
        }

        foreach ($vendor->favorites as $favorite) {
            $favorite->delete();
        }

        $vendor_name = $vendor->title;

        $this->deleteVendorDetails($vendor);

        $vendor->update([

            'name_before_delete' => $vendor->name,
            'name' => null,
        ]);
        $vendor->delete();

        if ($request->type == "1") {

            $new_vendor = Vendor::find($request->vendor);

            \Session::flash('success', ' فروشگاه( ' . $vendor_name . ')با موفقیت حذف شد و محصولات آن به فروشگاه (' . $new_vendor->name . ')انتقال داده شد ');

            return redirect()->route('admin.vendors.index');
        } else {

            \Session::flash(
                'success',
                ' فروشگاه( ' . $vendor_name . ' )همراه با تمام اطلاعات آن حذف شد ...'
            );
            return redirect()->route('admin.vendors.index');
        }
    }

    private function deleteProductDetails($product)
    {

        foreach ($product->All_Comments as $comment) {
            $comment->delete();
        }

        $stories = story::where('product_id', $product->id)->get();

        foreach ($stories as $item) {
            $item->delete();
        }

        $favorites = favorite::where('product_id', $product->id)->get();

        foreach ($favorites as $item) {
            $item->delete();
        }

        $sliders = Sliders::where('product_id', $product->id)->get();

        foreach ($sliders as $item) {
            $item->delete();
        }

        $specialProducts = SpecialProducts::where('product_id', $product->id)->get();

        foreach ($specialProducts as $item) {
            $item->delete();
        }
    }

    private function deleteVendorDetails($vendor)
    {
        if ($vendor->socialMedias) {
            $vendor->socialMedias->delete();
        }

        $sliders = Sliders::where('vendor_id', $vendor->id)->get();

        foreach ($sliders as $item) {
            $item->delete();
        }

        $special_p = SpecialProducts::where('vendor_id', $vendor->id)->get();
        foreach ($special_p as $s) {
            $s->delete();
        }

        $special_v = SpecialVendors::where('vendor_id', $vendor->id)->get();
        foreach ($special_v as $s) {
            $s->delete();
        }

        foreach ($vendor->AdminMassages as $m) {
            $m->delete();
        }

        foreach ($vendor->favorites as $f) {
            $f->delete();
        }

        $favorited = favorite::where('vendor_iddd', $vendor->id)->get();

        $inFavorite = favorite::where('vendor_id', $vendor->id)->get();

        foreach ($inFavorite as $f) {
            $f->delete();
        }

        foreach ($favorited as $f) {
            $f->delete();
        }

        $followings = Follow::where('following', $vendor->id)->get();

        $followers = Follow::where('vendor_id', $vendor->id)->get();

        foreach ($followers as $f) {
            $f->delete();
        }
        foreach ($followings as $f) {
            $f->delete();
        }

        foreach ($vendor->favorites as $favorite) {
            $favorite->delete();
        }

        $stories = story::where('vendor_id', $vendor->id)->get();

        foreach ($stories as $favorite) {
            $favorite->delete();
        }

        $brands = Brand::where('vendor_id', $vendor->id)->get();

        foreach ($brands as $item) {

            $item->update([
                'vendor_id' => null,
            ]);
        }
    }

    public function loginAsVendor(Request $request)
    {

        $vendor = Vendor::findOrFail($request->vId);

        $user = Auth::user();

    session()->put('adminLogedIn' , Auth::user()->mobile);

        Auth::logout($user);

        Auth::login($vendor->user);

        return redirect()->route('user.dashboard');
    }

    public function productEditList($vId)
    {

        $Vendor = Vendor::find($vId);

        $user = $Vendor->user;

        $newDatas = $Vendor->EditedData;

        $images = $Vendor->Allimages;

        if (!is_null($newDatas) && ($Vendor->status == "edited" || $Vendor->status == "new")) {

            $dataa = json_decode($newDatas, true);

            if ($dataa) {
                return view('admin.vendors.VendorEditList', compact('user', 'dataa'));
            }
        } else {
            abort(404, 'page not found');
        }
    }

    public function saveChanges(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'phone_number2' => 'numeric|nullable',
            'phone_number' => 'required',
            'website' => 'string|nullable',
            'address' => 'required|string',

        ]);


         dd($request->all());
   
        $Vendor = Vendor::findOrFail($request->vendor_id);

        $newDatas = $Vendor->EditedData;
        $decodedData = json_decode($newDatas, true);

        if ($decodedData['cover']) {

            if ($Vendor->cover != 'default-cover.jpg' && file_exists(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')) . $Vendor->cover)) {
                unlink(public_path(env('VENDOR_IMAGES_UPLOAD_PATH')) . $Vendor->cover);
            }

            $Vendor->update([

                'cover' => getVendorLastDate($Vendor->id, 'cover'),
            ]);
        }

        if ($decodedData['avatar']) {

            if ($Vendor->avatar != 'default-avatar.png' && file_exists(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $Vendor->avatar)) {

                unlink(public_path(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH')) . $Vendor->avatar);
            }

            $Vendor->update([

                'avatar' => getVendorLastDate($Vendor->id, 'avatar'),
            ]);
        }

        $venderSocials = Vendors_SocialMedia::where('vendor_id', $Vendor->id)->first();

        if ($venderSocials) {

            $this->editVendorSocialMdia($request, $Vendor->id);
        } else {

            $this->saveVendorSocialMdia($request, $Vendor->id);
        }


        if($request->name != $Vendor->name){

                $vendorName = Username::setModel(Vendor::class)
                ->setColum('name')
                ->make(str_replace(' ', '-', $request->name));

                $simpleNameVendor = Vendor::withTrashed()->where('name', 'LIKE', "%" . $vendorName . "%")->get();
                
                $count = rand(20, 50);
                
                if (count($simpleNameVendor) > 0) {
                    
                    foreach ($simpleNameVendor as $item) {
                    $count++;
                }
                
                if ($count > 1) {
                    $vendorName = Username::setModel(Vendor::class)
                    ->setColum('name')
                    ->make(str_replace(' ', '-', $request->name) . "-" . strval($count + 1));
                }
            }
        }else{

            $vendorName = $Vendor->title;
        }   
        
        $Vendor->update([
            'title' => $request->name,
            'name' => $vendorName,
            'description' => nl2br($request->description)
            ,
            'address' => $request->address,
            'number' => $request->phone,
            'phone_number' => $request->phone_number,
            'phone_number2' => $request->phone_number2,
            "apatatVideoLink" => $request->apatatVideoLink,
            'site_url' => $request->website,
            'status' => 'yes',
            'EditedData' => null,
            'EditReportText' => null,
        ]);

        session()->flash('success', 'تعییرات فروشگاه ' . $Vendor->title . "با موفقیت ثبت شد");
        return redirect()->route('admin.vendors.index');
    }
    public function deleteChanges(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
        ]);

        $Vendor = Vendor::findOrFail($request->vendor_id);

        $Vendor->update([

            'status' => 'yes',
            'EditedData' => null,
            'EditReportText' => null,

        ]);

        session()->flash('success', 'تعییرات فروشگاه ' . $Vendor->name . "حذف شد");
        return redirect()->route('admin.vendors.index');
    }

    public function showVendorUserDetail($usersId, Request $request)
    {

        $user = User::findOrFail($usersId);

        $today = Carbon::today();

        $products = $user->products;

        $subMonth = Carbon::today()->subMonth()->format('Y-m-d');

        $subDay = Carbon::today()->subDay()->format('Y-m-d');
        $subWeek = Carbon::today()->subWeek()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');

        $UserLastMonthOrdersFinal = 0;
        $UserLastMonthOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinal = 0;
        $UserLastWeekOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinal = 0;
        $UserLastDayOrders = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinal = 0;
        $UserTotal = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where('status', "!=", 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->get();

        $UserLastMonthOrdersFinalPayFromCredit = 0;
        $UserLastMonthOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalPayFromCredit = 0;
        $UserLastWeekOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalPayFromCredit = 0;
        $UserLastDayOrdersPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalPayFromCredit = 0;
        $UserTotalPayFromCredit = Orders::where('status', 'CREDIT')->where("orderType", "!=", 'increaseCredit')->where('user_id', $user->id)->get();

        $UserLastMonthOrdersFinalIncreaseCredit = 0;
        $UserLastMonthOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subMonth, $today])->get();

        $UserLastWeekOrdersFinalIncreaseCredit = 0;
        $UserLastWeekOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subWeek, $today])->get();

        $UserLastDayOrdersFinalIncreaseCredit = 0;
        $UserLastDayOrdersIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->whereBetween('created_at', [$subDay, $today])->get();

        $UserTotalFinalIncreaseCredit = 0;
        $UserTotalIncreaseCredit = Orders::where('persianStatus', 'پرداخت تایید شده است.')->where("orderType", 'increaseCredit')->where('user_id', $user->id)->get();
        foreach ($UserLastMonthOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalPayFromCredit += $item->totalAmount;
            }
        }
        foreach ($UserTotalPayFromCredit as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinalPayFromCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalPayFromCredit += $item->totalAmount;
            }
        }

        //
        foreach ($UserLastMonthOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
            } else {
                $UserLastWeekOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrdersIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinalIncreaseCredit += $item->totalAmount;
            }
        }

        foreach ($UserTotalIncreaseCredit as $item) {

            if ($item->amountAfterOffer) {
                $UserTotalFinalIncreaseCredit += $item->amountAfterOffer;
            } else {
                $UserTotalFinalIncreaseCredit += $item->totalAmount;
            }
        }

        //
        foreach ($UserLastMonthOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastMonthOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastMonthOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastWeekOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastWeekOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastWeekOrdersFinal += $item->totalAmount;
            }
        }
        //
        foreach ($UserLastDayOrders as $item) {
            if ($item->amountAfterOffer) {
                $UserLastDayOrdersFinal += $item->amountAfterOffer;
            } else {
                $UserLastDayOrdersFinal += $item->totalAmount;
            }
        }
        foreach ($UserTotal as $item) {
            if ($item->amountAfterOffer) {
                $UserTotalFinal += $item->amountAfterOffer;
            } else {
                $UserTotalFinal += $item->totalAmount;
            }
        }

        if ($request->ExcelExport) {
            $allorders = Orders::where('user_id', $user->id)->get();

            ob_end_clean();
            ob_start();

            $name = "user_" . $user->name;

            // return Excel::download(new ExcelExport  , 'excel.xlsx' ,\Maatwebsite\Excel\Excel::XLSX);
            return Excel::download(new \App\Exports\GeneralExportExcel($allorders, 'userOrdes'), 'instabargh.' . $name . now() . '.xlsx');
        }

        return view(
            'admin.vendors.showUserDetail',
            compact(

                'products',
                ///////
                "user",

                'UserTotal',
                'UserTotalFinal',
                'UserLastDayOrders',
                'UserLastDayOrdersFinal',
                'UserLastDayOrders',
                'UserLastWeekOrdersFinal',
                'UserLastMonthOrders',
                'UserLastMonthOrdersFinal',

                'UserLastMonthOrdersFinalIncreaseCredit',
                'UserLastMonthOrdersIncreaseCredit',
                'UserLastWeekOrdersIncreaseCredit',
                'UserLastWeekOrdersFinalIncreaseCredit',
                'UserLastDayOrdersIncreaseCredit',
                'UserLastDayOrdersFinalIncreaseCredit',
                'UserTotalFinalIncreaseCredit',
                'UserTotalIncreaseCredit',

                'UserLastMonthOrdersFinalPayFromCredit',
                'UserLastMonthOrdersPayFromCredit',
                'UserLastWeekOrdersFinalPayFromCredit',
                'UserLastWeekOrdersPayFromCredit',
                'UserLastDayOrdersFinalPayFromCredit',
                'UserLastDayOrdersPayFromCredit',
                'UserTotalFinalPayFromCredit',
                'UserTotalPayFromCredit',
                /////

            )
        );
    }

    public function reportChanges(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
        ]);

        $Vendor = Vendor::findOrFail($request->vendor_id);

        

        if ($request->text && $request->textStatus == "1") {

            $Vendor->update([

                'status' => "reported",
                'EditReportText' => $request->text,

            ]);
            session()->flash('success', 'تعییرات فروشگاه ' . $Vendor->title . "با موفقیت ریپورت شد");
            return redirect()->route('admin.vendors.index');
        } else {

            $Vendor->update([
                'type' => 'edited-reported',
                'status' => "reported",
            ]);
            session()->flash('success', 'تعییرات فروشگاه ' . $Vendor->title . "با موفقیت ریپورت شد");
            return redirect()->route('admin.vendors.index');
        }
    }

    public function vendorsInQueue()
    {
        $vendorsInQueue = Vendor::where('adminVendor', 'no')->Where('status', '!=', 'yes')->get();

        return view('admin.vendors.vendorInQueue', compact('vendorsInQueue'));
    }

    public function pin(Request $request)
    {

        if ($request->type == "product") {
            $request->validate([
                'id' => 'required|exists:products',
            ]);

            $product = Product::findOrFail($request->id);

            if ($request->pin_number == 0) {

                $product->update([
                    'pin_number' => 0,
                ]);
                $msg = " محصول " . $product->name . " با موفقیت از پین برداشته شد ";

                session()->flash('success', $msg);

                return redirect()->back();
            } else {

                $productExists = Product::where('pin_number', $request->pin_number)->first();

                if ($productExists) {
                    $msg = "شما قبلا پین شماره ی " . $request->pin_number . " را به محصول " . $productExists->name . " اختصاص داده اید";

                    session()->flash('success', $msg);

                    return redirect()->back();
                } else {
                    $product->update([
                        'pin_number' => $request->pin_number,
                    ]);

                    $msg = "محصول " . $product->name . "با موفقیت پین شد";

                    session()->flash('success', $msg);

                    return redirect()->back();
                }
            }
        } elseif ($request->type == "vendor") {
            $request->validate([
                'id' => 'required|exists:vendors',
            ]);

            $Vendor = Vendor::findOrFail($request->id);

            $VendorExists = Vendor::where('pin_number', $request->pin_number)->first();

            if ($request->pin_number == 0) {

                $Vendor->update([
                    'pin_number' => null,
                ]);
                $msg = " فروشگاه  " . $Vendor->name . " با موفقیت از پین برداشته شد ";

                session()->flash('success', $msg);

                return redirect()->back();
            }

            if ($VendorExists) {
                $msg = "شما قبلا پین شماره ی " . $request->pin_number . " را به فروشگاه " . $VendorExists->name . " اختصاص داده اید";

                session()->flash('success', $msg);

                return redirect()->back();
            } else {
                $Vendor->update([
                    'pin_number' => $request->pin_number,
                ]);

                $msg = " فروشگاه " . $Vendor->name . "با موفقیت پین شد";

                session()->flash('success', $msg);

                return redirect()->back();
            }
        }
    }

    public function saveVendorSocialMdia($request, $vendor_id)
    {



        Vendors_SocialMedia::create([
            'vendor_id' => $vendor_id,
            'telegram' =>  $request->telegram ?  'https://telegram.me/' . $request->telegram : ' ',
            'aparat' => $request->aparat ? 'https://www.aparat.com/' . $request->aparat : ' ',
            'robika' =>  $request->robika ,
            'instagram' => $request->instagram ? 'https://www.instagram.com/' . $request->instagram : '',
            'email' =>  $request->email ? $request->email : '',
            'whatsapp' => $request->whatsapp ? 'https://api.whatsapp.com/send?phone=+98' . $request->whatsapp : '',
            'website' =>   $request->website ? 'www.' . $request->website : '',
            'bale' => $request->bale
        ]);
    }


    public function editVendorSocialMdia($request, $vendorId)


    {


        $social = Vendors_SocialMedia::where('vendor_id', $vendorId)->first();

        $social->update([

            'telegram' =>  $request->telegram ?  'https://telegram.me/' . $request->telegram : ' ',
            'aparat' => $request->aparat ? 'https://www.aparat.com/' . $request->aparat : ' ',
            'robika' =>  $request->robika ,
            'instagram' => $request->instagram ? 'https://www.instagram.com/' . $request->instagram : '',
            'email' =>  $request->email ? $request->email : '',
            'whatsapp' => $request->whatsapp ? 'https://api.whatsapp.com/send?phone=+98' . $request->whatsapp : '',
            'website' =>   $request->website ,
            'bale' => $request->bale


        ]);
    }
}
