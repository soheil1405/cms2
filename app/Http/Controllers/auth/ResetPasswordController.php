<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendSms;
use App\Notifications\UserNewCode;
use App\Notifications\UserResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;
use Mews\Captcha\Facades\CaptchaServiceProvider;
use ReCaptcha\ReCaptcha;
use Vtiful\Kernel\Excel;

class ResetPasswordController extends Controller
{

    //vared kardan shomareh
    public function index()
    {
        return view('auth.reset');
    }


    //ersale kod
    public function resetpass(Request $request)
    {
        if ($request->has('code')) {
            $request->validate([
                'mobile' => ['required', 'digits:11'],
                'code' => ['required'],
                // 'passwd'        => ['required']
            ]);

            $user = User::where('mobile', $request->mobile)->first();

            if (is_null($user)) {
                Alert::error('ناموفق', 'این شماره در سیستم ثبت نشده است ')->showConfirmbutton('تایید');
                return back();
            }

            if ($user->otp->token == $request->code) {
                Auth::login($user);
                return redirect()->route('user.go_to_reset_pass');
            }

            Alert::error('ناموفق', 'کد وارد شده نامعتبر است')->showConfirmbutton('تایید');
            return back()->with(['token' => 'block']);
        } else {
            $request->validate([
                'mobile' => ['required', 'digits:11'],
                // 'password'      => ['required']
            ]);

            $user = User::where('mobile', $request->mobile)->first();
            if (is_null($user)) {
                Alert::error('ناموفق', ' شماره وارد شده در سیستم موجود نیست  ')->showConfirmbutton('تایید');
                return back();
            }

            $r = rand(1001, 9999);

            if (!is_null($user->otp) && Carbon::parse($user->otp->expire) <= Carbon::now()) {
                $user->otp()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'token' => $r,
                        'expire' => Carbon::now()->addMinutes(env('SMS_EXPIRE_MINUTES')),
                    ],
                );

                Notification::send(User::rolAdmin()->get(), new UserNewCode());
                $user->notify(new SendSms());

                Alert::success('موفق', 'کد تایید جدید به شماره شما ارسال شد')->showConfirmbutton('تایید');
                return back()
                    ->withInput(['mobile' => $request->mobile, 'password' => $request->password])
                    ->with(['token' => 'block']);
            }else{
                $user->otp()->createOrUpdate(
                    [
                        'user_id' => $user->id,
                        'token' => $r,
                    ],
                    [
                        'expire' => Carbon::now()->addMinutes(env('SMS_EXPIRE_MINUTES')),
                    ],
                );

                Notification::send(User::rolAdmin()->get(), new UserNewCode());
                $user->notify(new SendSms());

    
    
                

                Alert::success('موفق', 'کد تایید جدید به شماره شما ارسال شد')->showConfirmbutton('تایید');
                return back()
                    ->withInput(['mobile' => $request->mobile, 'password' => $request->password])
                    ->with(['token' => 'block']);
       
            }

            Alert::error('ناموفق', 'لطفا تا اتمام شمارنده صبر کنید')->showConfirmbutton('تایید');
            return back()->with(['token' => 'block']);
        }
    }


    //login & go to reset pass
    public function go_to_reset_pass()
    {
        return view('auth.resetPass-form');
    }




    //final reset pass
    public function final_reset_pass(Request $request)
    {
        $request->validate([
            'password' => 'required|same:password_verify',
        ]);


        $user = Auth::user();


        $user->update([
            'password' => Hash::make($request->password),
        ]);


        Notification::send(User::rolAdmin()->get(), new UserResetPassword());
        $user->notify(new UserResetPassword());


        Alert::success('موفق', 'رمز عبور شما با موفقیت تغییر کرد')->showConfirmbutton('تایید');


        return redirect()->route('user.dashboard');

    }
}