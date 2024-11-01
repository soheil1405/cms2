<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserLogin;
use App\Notifications\UserLogout;
use Carbon\Carbon;
use App\Models\Rol;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;
use App\Notifications\UserRegistered;
use App\Repositories\AdminMessageRepository;
use App\Rules\AnyNumberAndPersian;
use App\Rules\NumberSabet;
use Illuminate\Support\Facades\DB;
use Mews\Captcha\Facades\Captcha;
use App\Notifications\SendSms;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function logout()
    {



        $user = Auth::user();

        if(is_null($user)){
            return redirect()->route("home");
        }

        $user->vendor->update([
            'last_login' => $user->vendor->currentlogin ? $user->vendor->currentlogin  :  Carbon::now(),
            'currentlogin'=>Carbon::now(),
        ]);


        $user->update([
            'last_login' => $user->vendor->currentlogin ? $user->vendor->currentlogin  :  Carbon::now(),
            'currentlogin'=>Carbon::now(),
        ]);
        $user->notify(new UserLogout());

        Notification::send(User::rolAdmin()->get(), new UserLogout());
        Auth::logout();



        if(\Session::has('adminLogedIn')){
            $session =  \Session::get('adminLogedIn');

            $user = User::where(
                [
                    'mobile' => $session
                ]
            )->first();
        
            Session::forget('adminLogedIn');

            if($user){
                Auth::login($user);

                return redirect()->route('admin.dashboard');

            }
        }

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $user = Auth::user();
        if (!is_null($user)) {
            return redirect()->route('user.dashboard');
        }
        $request->validate([
            'phone' => ['required'],
            'password' => ['required'] ,
            'captcha' => ['required','Captcha']
        ]);


    
        // $rules = ['captcha' => 'required|captcha'];
        // $validator = Validator::make($request->all(), $rules);



        $phone =  convertPersianToEnglishNumber($request->phone);

        $password = convertPersianToEnglishNumber($request->password);

        $user = User::where(
            [
                'mobile' => $phone
            ]
        )->first();

        if (!is_null($user) && Hash::check($password, $user->password)) {

            
            if ($user->status == "-1") {
                Alert::error('ناموفق', 'حساب کاربری شما توسط ادمین غیر فعال شده است')->showConfirmbutton('تایید');
                return back();
            }



            if (!is_null($user->vendor)) {

                Notification::send(User::rolAdmin()->get(), new UserLogin());
                $user->notify(new UserLogin());


                if ($user->status == "-1") {
                    Alert::error('ناموفق', 'حساب کاریری شما توسظ ادمین غیر فعال شده است')->showConfirmbutton('تایید');
                    return back();
                }


                Auth::login($user);



                
                $user->vendor->update([
                    'last_login' => $user->vendor->currentlogin ? $user->vendor->currentlogin  :  Carbon::now(),
                    'currentlogin'=>Carbon::now(),
                    'login_count' => ($user->vendor->login_count) + 1

                ]);
        
        
                $user->update([
                    'last_login' => $user->vendor->currentlogin ? $user->vendor->currentlogin  :  Carbon::now(),
                    'currentlogin'=>Carbon::now(),
                ]);
                // dd(User::rolAdmin()->get());
            } else {




                $vendorName = Username::setModel(Vendor::class)
                    ->setColum('name')
                    ->make(str_replace(' ', '-', $user->name));


                $simpleNameVendor = Vendor::withTrashed()->where('name', 'LIKE', "%" . $vendorName . "%")->get();



                $count = 1;

                if (count($simpleNameVendor) > 0) {
                    foreach ($simpleNameVendor as $item) {
                        $count++;
                    }

                    if ($count > 0) {
                        $vendorName = Username::setModel(Vendor::class)
                            ->setColum('name')
                            ->make(str_replace(' ', '-', $request->vendorName) . "-" . strval($count + 1));
                    }


                }

                // dd($vendorName);



                $vendor = Vendor::create([
                    'user_id' => $user->id,
                    'name' => $vendorName,
                    'title' => $user->name,
                    'description' => 'توضیحات فروشگاه',
                    'address' => $request->address,
                    'number' => $request->number,
                    'phone_number' => $phone,
                ]);


                $r = rand(1001, 9999);
                $otp = $user->otp()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'token' => $r,
                        'expire' => Carbon::now()->addMinutes(env('SMS_EXPIRE_MINUTES')),
                    ],
                );
                $user->notify(new SendSms());
                Notification::send(User::rolAdmin()->get(), new UserRegistered());

                $mobile = $phone;

                $user->notify(new UserLogin());

                DB::commit();

                session_start();
                session()->put('mobile', $mobile);

                resolve(AdminMessageRepository::class)->SendWellcomeText($vendor->id);


                return redirect()->route('user.verify.index');
            }

            return redirect()->route('user.dashboard');
        } elseif (!is_null($user) && !Hash::check($request->password, $user->password)) {

            Alert::error('ناموفق', 'رمز عبور وارد شده صحیح نیست ')->showConfirmbutton('تایید');
            return back();

        }


        Alert::error('ناموفق', 'این شماره در سیستم ثبت نشده است ')->showConfirmbutton('تایید');
        return back();
    }

}