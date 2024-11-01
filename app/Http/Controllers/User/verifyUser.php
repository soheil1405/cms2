<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendSms;
use App\Notifications\UserLogin;
use App\Notifications\UserVerified;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class verifyUser extends Controller
{
    public function check_phone_page()
    {


        if (Auth::check()) {


            
            $mobile = Auth::user()->mobile;

            $now = Carbon::now();
            
            $otp = Auth::user()->otp;
           
            $expire = $otp->expire;

            $diff = $now->diffInSeconds($expire);

            $timeExpire = $diff;

            if(Carbon::parse($expire)->isPast()){
           

                $otp->update([
                        'token' => rand(1111 , 9999),
                        'expire' => Carbon::now()->addMinutes(2),
                    ],
                );

                Auth::user()->notify(new UserVerified());


                $expire = $otp->expire;

                $diff = $now->diffInSeconds($expire);
    
                $timeExpire = $diff;
               
            }
           
    
    
        } else {
            session_start();
            $mobile = session()->get('mobile');

            if (is_null($mobile)) {
                Alert::error('ناموفق', 'لطفا دقایقی دیگر مجددا تلاش کنید')->showConfirmbutton('تایید');
                return redirect()->route('login');
            }
        }


        // dd($timeExpire);

        

        

    
        $code = $otp->token;
        

        return view('user.verify.index', compact('timeExpire' , 'code'))->with(['mobile' => $mobile]);
    }

    public function check_code(Request $request)
    {
        request()->validate([
            'code' => ['required', 'numeric'],
        ]);


        // dd($request->all());

        $mobile = $request->mobile;

        $user = User::where('mobile', $mobile)->first();

        if (is_null($user)) {
            return redirect()->route('login');
        }

        $otp = $user->otp;
        if (is_null($otp)) {
        } else {

            $now = Carbon::now();

            $diff = $now->diffInSeconds(Auth::user()->otp->created_at);

            if (request()->code == $otp->token && Carbon::parse($otp->updated_at) < Carbon::now() && Carbon::parse($otp->expire) > Carbon::now()) {
                $user->update([
                    'mobile_verified_at' => Carbon::now(),
                ]);
                $user->notify(new UserVerified());
                Notification::send(User::rolAdmin()->get(), new UserVerified());
                alert::success('موفق', 'شماره همراه شما تایید شد')->showConfirmbutton('تایید');

                return redirect()->route('user.dashboard');
            } elseif ($diff > 200) {

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

                $user->notify(new UserLogin());


                Alert::error('ناموفق', 'کد وارد شده منقضی شده است ، پیامکی حاوی کد جدید برای شما ارسال شد')->showConfirmbutton('تایید');
                return redirect()->back();



            }
        }

        Alert::error('ناموفق', 'کد وارد شده صحیح نمی باشد')->showConfirmbutton('تایید');
        return redirect()->back();
    }

    public function request_code(Request $request)
    {


        // dd($request->all());
        $mobile = $request->mobile;
        $user = User::where('mobile', $mobile)->first();

        if (is_null($user)) {
            return redirect()->route('login');
        }
        // $user = 
        $r = rand(1001, 9999);

        if (Carbon::parse($user->otp->expire) <= Carbon::now()) {
            $user->otp()->updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'token' => $r,
                    'expire' => Carbon::now()->addMinutes(env('SMS_EXPIRE_MINUTES')),
                ],
            );

            $user->notify(new SendSms());

            alert::success('موفق', 'کد تایید جدید به شماره شما ارسال شد')->showConfirmbutton('تایید');
            return redirect()->back();
        }

        alert::warning('ناموفق', 'لطفا تا اتمام شمارنده صبر کنید')->showConfirmbutton('تایید');
        return redirect()->back();
    }
}