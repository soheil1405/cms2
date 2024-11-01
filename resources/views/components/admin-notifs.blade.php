@php
    $replace_type = [
        'App\Notifications\UserVerified'        => 'حساب کاربری تایید شد',
        'App\Notifications\UserLogin'           => 'کاربر وارد شد',
        'App\Notifications\UserRegistered'      => 'کاربر ثبت نام کرد',
        'App\Notifications\SendSms'             => 'کد یک بار مصرف ارسال شد',
        'App\Notifications\UserUpdateProfile'   => 'پروفایل کاربر بروز رسانی شد',
        'App\Notifications\UserLogout'          => 'کاربر خارج شد',
        'App\Notifications\UserResetPassword'   => 'رمز عبور کاربر تغییر کرد'
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