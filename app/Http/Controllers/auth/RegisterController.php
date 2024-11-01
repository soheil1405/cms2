<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Vendors_SocialMedia;
use App\Notifications\SendSms;
use App\Notifications\UserLogin;
use App\Notifications\UserRegistered;
use App\Repositories\AdminMessageRepository;
use App\Rules\AnyNumberAndPersian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\MessageBag;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = Auth::user();
        
        if (!is_null($user)) {
            return redirect()->route('user.dashboard');
        }

        $request->validate([
            'fname' => ['required'],
            'phone' => ['required', 'max:11', 'min:11'],
            // 'number' => ['min:11' , 'max:11'] ,
            'address' => ['required', new AnyNumberAndPersian()],
            'vendorName' => ['required'],
            'password' => ['required', 'min:4'],
            'captcha' => 'required|captcha',
        ]);

        
    $phone =  convertPersianToEnglishNumber($request->phone);
        $number = convertPersianToEnglishNumber($request->number);

        $user = User::where([
            'mobile' =>$phone,
        ])->first();

        if (!is_null($user)) {
            Alert::error('شما قبلا در سایت ثبت نام کردید', 'لطفا وارد شوید یا رمز عبور خود را بازیابی کنید')->persistent('حله');
            return redirect()->route('login');
        }
        DB::beginTransaction();

        try {

            $user = User::create([
                'mobile' =>$phone,
                'name' => $request->fname,
                'password' => Hash::make($request->password),
            ]);

            $vendorName = Username::setModel(Vendor::class)
                ->setColum('name')
                ->make(str_replace(' ', '-', $request->vendorName));

            $simpleNameVendor = Vendor::withTrashed()->where('name', 'LIKE', "%" . $vendorName . "%")->get();

            $count = rand(20, 50);

            if (count($simpleNameVendor) > 0) {

                foreach ($simpleNameVendor as $item) {
                    $count++;
                }

                if ($count > 1) {
                    $vendorName = Username::setModel(Vendor::class)
                        ->setColum('name')
                        ->make(str_replace(' ', '-', $request->vendorName) . "-" . strval($count + 1));
                }
            }

            $vendor = Vendor::create([
                'user_id' => $user->id,
                'name' => $vendorName,
                'title' => $request->vendorName,
                'address' => $request->address,
                'number' => $number,
                'phone_number' =>$phone,
                'status'=>'no',
                "laddered_at"=>Carbon::now()
            ]);

            $role = Rol::where('name', 'user')->first();
            $user->rols()->save($role);
            
            
            Auth::login($user);




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

            $mobile =$phone;

            $user->notify(new UserLogin());

            DB::commit();

            session_start();
            session()->put('mobile', $mobile);

            resolve(AdminMessageRepository::class)->SendWellcomeText($vendor->id);

            Vendors_SocialMedia::create([
                'vendor_id' => $vendor->id,
                "whatsapp" => $mobile,
            ]);



            return redirect()->route('user.verify.index');
        } catch (\Throwable $ex) {
            DB::rollBack();
            
            Alert::error('خطا در اطلاعات ورودی')->persistent('حله');
            return redirect()->route('login');
            
        }


    }
}
