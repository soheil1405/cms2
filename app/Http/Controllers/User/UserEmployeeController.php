<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

use Carbon\Carbon;
class UserEmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        

        if (!is_null($user->boss_id)) {
            $masg = "فقط مدیر فروشگاه می تواند به این قسمت دسترسی داشته باشد";
            return view('user.errors.403' , compact('masg') );
        }


        $Employers = $user->Employers();

        return view('user.Employers.index', compact('Employers'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $routes = Route::getRoutes();

        // dd($routes);

        return view('user.Employers.create');


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'number' => 'required|digits:11',
            // 'pass'=>'required|same:repass'
        ]);


        $sameNumber = User::where('mobile', $request->number)->first();


        if (!is_null($sameNumber)) {

            session()->flash('NumberErr', 'شماره مورد نظر قبلا در سیستم ثبت شده');

            return redirect()->back();

        }



        $data = [
            //products
            'user.products.create' => $request->newp ? 1 : NULL,
            'user.products.edit' => $request->editp ? 1 : NULL,
            'user.deleteProduct' => $request->deletep ? 1 : NULL,

            //adds
            'user.story.create' => $request->newS ? 1 : NULL,
            'user.products.ladder' => $request->ladderP ? 1 : NULL,
            'user.ladderVendor' => $request->ladderV ? 1 : NULL,
            'user.SpecialVendors.create' => $request->newSpcV ? 1 : NULL,
            'user.upgradeproduct.create' => $request->newSpcP ? 1 : NULL,
            'user.vendorSliedrPage' => $request->SendSlider ? 1 : NULL,

            //more
            'user.vendor.images.edit' => $request->editV ? 1 : NULL,
            'user.tickets.userIndex' => $request->TicketController ? 1 : NULL,
            'user.tickets.createNew' => $request->TicketController ? 1 : NULL,
            'user.tickets.show' => $request->TicketController ? 1 : NULL,
            'user.comments' => $request->commentController ? 1 : null,
            'maxUseMoney' => $request->maxUseMoney ? $request->maxUseMoney : 0,

        ];

        $decoded = json_encode($data);



        
        if($request->maxUseMoney > Auth::user()->CREDIT){
           
            

            session()->flash('notEnoghMoney' , 'موجودی شما برای افزودن این مبلغ به کیف پول کاربر کافی نیست');
            return back();



        }else{
            

            $userCredit = $request->maxUseMoney;

            if(is_null($userCredit)){

                $userCredit = 0;
            }

            $user = Auth::user();

            $newCredit = $user->CREDIT - $userCredit;

            $user->update([
                "CREDIT"=>$newCredit
            ]);


            

        }


        $password = Hash::make($request->pass);


        $user = User::create([
            'mobile' => $request->number,
            'name' => $request->name,
            'boss_id' => Auth::user()->id,
            'password' => Hash::make($request->pass),
            'permissions' => $decoded,
            'mobile_verified_at'=>Carbon::now() ,
            "CREDIT"=>$userCredit 
        ]);

        $role = Rol::where('name', 'user')->first();
        $user->rols()->save($role);

        if (is_null($user)) {


            session()->flash('msg', 'عملیات با شکست مواحه شد');

        } else {

            session()->flash('msg', 'کاربر جدید با موفقیت ایحاد شد');

        }

        return redirect()->route('user.Employees.index');


    }
    
    public function edit($id)
    {


        $user = User::findOrFail($id);


        $jsonedPermissions = json_decode($user->permissions);


        $UserPermissions = get_object_vars($jsonedPermissions);


        if (is_null($user->boss_id)) {
            return abort(404);
        } else {

            return view('user.Employers.edit', compact('user', 'UserPermissions'));

        }


    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',

            // 'pass'=>'required|same:repass'
        ]);



        $user = User::findOrFail($request->id);


        $data = [
            //products
            'user.products.create' => $request->newp ? 1 : NULL,
            'user.products.edit' => $request->editp ? 1 : NULL,
            'user.deleteProduct' => $request->deletep ? 1 : NULL,

            //adds
            'user.story.create' => $request->newS ? 1 : NULL,
            'user.products.ladder' => $request->ladderP ? 1 : NULL,
            'user.ladderVendor' => $request->ladderV ? 1 : NULL,
            'user.SpecialVendors.create' => $request->newSpcV ? 1 : NULL,
            'user.upgradeproduct.create' => $request->newSpcP ? 1 : NULL,
            'user.vendorSliedrPage' => $request->SendSlider ? 1 : NULL,

            //more
            'user.vendor.images.edit' => $request->editV ? 1 : NULL,
            'user.tickets.userIndex' => $request->TicketController ? 1 : NULL,
            'user.tickets.createNew' => $request->TicketController ? 1 : NULL,
            'user.tickets.show' => $request->TicketController ? 1 : NULL,
            'user.comments' => $request->commentController ? 1 : null,
            'maxUseMoney' => $request->maxUseMoney ? $request->maxUseMoney : 0,

        ];



        try {
            $decoded = json_encode($data);
            $user->update([

                'name' => $request->name,
                'permissions' => $decoded,

            ]);
            session()->flash('msg', 'کاربر جدید با موفقیت ایحاد شد');



        } catch (\Exception $e) {
            session()->flash('msg', 'عملیات با شکست مواحه شد');

        }



        return redirect()->route('user.Employees.index');




    }

    


    public function EmployeesLogs($id){
        $user = User::findOrFail($id);


        $logs = $user->logs;
        

        return view('user.Employers.userLogs' , compact('user' , 'logs'));

    }





    public function me(){
        
        $user = Auth::user();

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

        return view('user.me', compact(

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


        return view('user.me' , compact('user'));

    }



}