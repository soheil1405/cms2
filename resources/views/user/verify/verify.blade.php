{{-- @extends('user.layouts.user')

@section('title')
    تایید حساب کاربری
@endsection


@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 p-4 bg-white">
            <div class="mb-4">
                <h5 class="text-center">
                    تایید حساب کاربری
                </h5>
            </div>
            <div>
                <form action="{{ route('user.verify.check') }}" class="form-horizontal" method="post">
                    @csrf

                    @error('code')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                
                    <div class="form-group col-12 col-sm-4 col-md-2 m-auto">
                        <label>تایید شماره همراه :</label>
                        <p>شماره همراه شما : 0{{ Auth::user()->mobile }}</p>
                        <div class="input-group flex-row-reverse ">
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control timepicker">

                            <div class="input-group-append">
                                
                                <button style="background: radial-gradient(ellipse at 70% 70%, #ee583f 8%, #d92d77 42%, #bd3381 58%);color: white;" class="btn btn-secondary" type="submit">بررسی کدتایید</button>
                            </div>

                        </div>
                        <div id="countdown" style="text-align: center;padding-bottom: 7px;" class="mt-4">
                            <x-reverse-counter resendElem=".btn-resend" :expireDate="Auth::user()->otp->expire" msgTry="میتوانید دوباره امتحان کنید" msgWait="تا انتهای شمارش صبر کنید"/>
                        </div>

                        <!-- /.input group -->
                    </div>
                </form>

                <form action="{{ route('user.verify.request') }}" method="post" class="text-center">
                    @csrf
                    <button class="btn btn-primary btn-resend" type="submit">
                        ارسال مجدد کد
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection --}}





<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
    <meta name="author" content="Ansonika">
    <title>
        ورود |
        {{ env('APP_NAME') }}
    </title>

    <!-- Favicons-->
    {{-- <link rel="shortcut icon" href="sabt2/img/favicon.ico" type="/sabt2/image/x-icon">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" href="sabt2/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" sizes="72x72"
        href="sabt2/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" sizes="114x114"
        href="sabt2/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="/sabt2/image/x-icon" sizes="144x144"
        href="sabt2/img/apple-touch-icon-144x144-precomposed.png"> --}}

    <!-- GOOGLE WEB FONT -->
    <link href="sabt2/css/farsi-font.css" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="sabt2/css/bootstrap.min.css" rel="stylesheet">
    <link href="sabt2/css/style.css" rel="stylesheet">
    <link href="sabt2/css/responsive.css" rel="stylesheet">
    <link href="sabt2/css/menu.css" rel="stylesheet">
    <link href="sabt2/css/animate.min.css" rel="stylesheet">
    <link href="sabt2/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="sabt2/css/skins/square/grey.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="sabt2/css/custom.css" rel="stylesheet">

    <script src="sabt2/js/modernizr.js"></script>
    <!-- Modernizr -->

</head>

<body>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->
    <main>
        <div id="form_container">
            <div class="row">
                <div class="col-12 p-4 bg-white">
                    <div class="mb-4">
                        <h5 class="text-center">
                            تایید حساب کاربری
                        </h5>
                    </div>
                    <div>
                        <form action="{{ route('user.verify.check') }}" class="form-horizontal" method="post">
                            @csrf

                            @error('code')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="hidden" name="mobile" value="{{ $mobile }}">
                            <div class="form-group col-12 col-sm-4 col-md-2 m-auto">
                                <label>تایید شماره همراه :</label>
                                <p>شماره همراه شما : 0{{ $mobile }}</p>
                                <div class="input-group flex-row-reverse ">
                                    <input type="text" name="code" value="{{ old('code') }}"
                                        class="form-control timepicker">

                                    <div class="input-group-append">

                                        <button
                                            style="background: radial-gradient(ellipse at 70% 70%, #ee583f 8%, #d92d77 42%, #bd3381 58%);color: white;"
                                            class="btn btn-secondary" type="submit">بررسی کدتایید</button>
                                    </div>

                                </div>
                                
                                
                                <div id="countdown" style="text-align: center;padding-bottom: 7px;" class="mt-4">
                                    <x-reverse-counter resendElem=".btn-resend" :expireDate="Auth::user()->otp->expire"
                                        msgTry="میتوانید دوباره امتحان کنید" msgWait="تا انتهای شمارش صبر کنید" />
                                </div>

                                <!-- /.input group -->
                            </div>
                        </form>


                        
                        <div id="countdown" style="text-align: center;padding-bottom: 7px;" class="mt-4">
                            <x-reverse-counter resendElem=".btn-resend" :expireDate="Auth::user()->otp->expire"
                                msgTry="میتوانید دوباره امتحان کنید" msgWait="تا انتهای شمارش صبر کنید" />
                        </div>
                        <form action="{{ route('user.verify.request') }}" method="post" class="text-center">
                            @csrf

                            <button class="btn btn-primary btn-resend" type="submit">
                                ارسال مجدد کد
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /Form_container -->
    </main>

    <footer id="home" class="clearfix">
        <p>{{ env('APP_NAME') }}</p>
        <ul>
            <li><a href="{{ route('register') }}" class="animated_link">ثبت نام</a></li>
            <li><a href="{{ route('reset_pass') }}" class="animated_link">فراموشی رمز عبور</a></li>
            <li><a href="{{ route('home') }}" class="animated_link">صفحه اصلی</a></li>
        </ul>
    </footer>
    <!-- end footer-->

    <div class="cd-overlay-nav">
        <span></span>
    </div>
    <!-- cd-overlay-nav -->

    <div class="cd-overlay-content">
        <span></span>
    </div>
    <!-- cd-overlay-content -->
    <!-- Modal terms -->
    <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="termsLabel">قوانین و سیاست ها</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نافهم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_1" data-dismiss="modal">بستن</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal info -->
    <div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="more-infoLabel"> ارسال به شما</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نافهم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_1" data-dismiss="modal">بستن</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- SCRIPTS -->
    <!-- Jquery-->
    <script src="sabt2/js/jquery-3.2.1.min.js"></script>
    <!-- Common script -->
    <script src="sabt2/js/common_scripts_min.js"></script>
    <!-- Wizard script -->
    <script src="sabt2/js/registration_wizard_func.js"></script>
    <!-- Menu script -->
    <script src="sabt2/js/velocity.min.js"></script>
    <script src="sabt2/js/main.js"></script>
    <!-- Theme script -->
    <script src="sabt2/js/functions.js"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])


</body>
<script>
var allseconds = parseInt({{ $todays->answer_time }}) * 60;
var minutes = parseInt({{ $todays->answer_time }});

var seconds = allseconds % 60;



const countdown = setInterval(() => {

    if (seconds === 0) {
        minutes = minutes - 1;
        if (minutes < 0) {
            console.log('finished');
            // stopInterval();
        } else {
            seconds = 59;
        }
    } else {
        seconds = seconds - 1;
    }


    console.log('seconds:' + seconds);

    console.log('minutes:' + minutes);



    document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
    document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes




    if (allseconds === 0) {
        clearInterval(countdown)
        document.querySelector(".countdown").innerHTML = 'Happy Birthday Ahmed'
    } else {
        allseconds = allseconds - 1;
    }

}, 1000)
</script>

</html>
