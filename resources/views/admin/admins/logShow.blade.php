@extends('admin.layouts.admin')

@section('title')
    تاریخچه کاربر
@endsection




@section('content')
    نام ادمین: <a href="">{{ $admin->name }}</a>

    <hr>
    url : {{ $log->url }}

<hr>

    پارامتر های ارسالی: {{ $log->parameters }}

<hr>

    تاریخ و ساعت : {{ \Morilog\Jalali\Jalalian::forge($log->created_at) }}

    <hr>


    <a class="btn btn-secondary" href="{{route('admin.admins.index')}}">بازگشت</a>



@endsection
