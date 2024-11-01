@extends('user.layouts.user')

@section('title')
    index products
@endsection

@section('content')
    @if (Session::has('storyStore'))
        <div class="alert alert-success">
            {{ Session::get('storyStore') }}
        </div>
    @endif

    <a href="{{route('user.upgrade')}}" class="btn btn-secondary">بازگشت</a>


    <div class="alert alert-info">

         تعداد  محصولات ویژه در تاریخ انتخاب شده تکمیل است 

        برای ارسال محصول به صفحه اول با پشتیبانی تماس بگیزید

    </div>

@endsection

<script></script>
