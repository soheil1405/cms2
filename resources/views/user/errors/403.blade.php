@extends('user.layouts.user')


<style>
    .main {

        width: 100%;
        height: 50%;
        background-image: url("https://instabargh.com/main/403.png");

        background-position: center;
    }

    .txx {
        color: black !important;
        margin: 50px;
    }
</style>

@section('title')
    access denied
@endsection


@section('content')
    <div class="col-12 main"></div>

    <h1 class="text-center txx">

        @isset($masg)
            {{ $masg }}
        @else
            دسترسی شما به این قسمت توسط مدیر فروشگاه مسدود شده است .
        @endisset


    </h1>
@endsection
