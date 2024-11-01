<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notifications\SendSms;
use App\Notifications\UserLogin;
use App\Notifications\UserLogout;
use App\Notifications\UserRegistered;
use App\Notifications\UserUpdateProfile;
use App\Notifications\UserVerified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(request()->has('type'))
        {
            $validator = Validator::make(request()->all(),
                [
                    'type'       => ['string']
                ]
            );
            if(!$validator->fails())
            {
                switch(request()->type)
                {
                    case 'default':
                        $notifs = $user->notifications()->paginate(6);
                    break;

                    case 'newuser':
                        $notifs = $user->notifications()->where('type',UserRegistered::class)->paginate(6);
                    break;

                    case 'userVerified':
                        $notifs = $user->notifications()->where('type',UserVerified::class)->paginate(6);
                    break;

                    case 'updateProfile':
                        $notifs = $user->notifications()->where('type',UserUpdateProfile::class)->paginate(6);
                    break;

                    case 'login':
                        $notifs = $user->notifications()->where('type',UserLogin::class)->paginate(6);
                    break;

                    case 'logout':
                        $notifs = $user->notifications()->where('type',UserLogout::class)->paginate(6);
                    break;

                    case 'sendOtp':
                        $notifs = $user->notifications()->where('type',SendSms::class)->paginate(6);
                    break;

                    default:
                        $notifs = $user->notifications()->paginate(6);
                    break;

                }
            }
        }else{
            $notifs = $user->notifications()->paginate(6);
        }
        
        return view('admin.notification.list',compact('user','notifs'));
    }
}
