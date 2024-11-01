@php
    $replace_type = [
        'App\Notifications\UserVerified'        => 'حساب کاربری تایید شد',
        'App\Notifications\UserLogin'           => 'وارد شدید',
        'App\Notifications\UserRegistered'      => 'ثبت نام کردید',
        'App\Notifications\SendSms'             => 'کد یک بار مصرف ارسال شد',
        'App\Notifications\UserUpdateProfile'   => 'پروفایل شما بروز رسانی شد',
        'App\Notifications\UserLogout'          => 'خارج شدید',
        'App\Notifications\UserResetPassword'   => 'رمز عبور خود را تغییر دادید'
    ];
@endphp
@foreach( $notif_list as $key => $notif)
<tr>
    <td>{{ ( ($notif_list->currentPage()-1) * $notif_list->perPage() ) + ($key+1) }}</td>
    <td>{{ $replace_type[$notif->type] }}</td>
    <td>{{ $notif->created_at }}</td>
    <td>
        {{ json_encode($notif->data) }}
    </td>
</tr>
@endforeach