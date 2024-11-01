@component('mail::message')
    # Introduction



    {{ $details['msg'] }}


    @component('mail::button', ['url' => $details['link']])
        مشاهده پاسخ
    @endcomponent

    با تشکر<br>
    {{ config('app.name') }}
@endcomponent
