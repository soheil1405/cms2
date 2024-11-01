@extends('user.layouts.user')

@section('title')
    راهنمای داشبورد
@endsection

@section('content')
    <h1>
        راهنمای داشبورد
    </h1>
    <?php $setting2 = App\Models\Admin\Setting::first(); ?>



    <p>
        متن راهنمای داشبورد کاربر
    </p>



    <a href=" {{ route('home.guid.product') }}">{{ $setting2->guidPTitle }}</a>

    <hr>

    <a href=" {{ route('home.guid.vendor') }}">{{ $setting2->guidVTitle }}</a>

    <hr>
    <a href="{{ route('home.guid.buy') }}">{{ $setting2->guidBuyTitle }}</a>
@endsection
