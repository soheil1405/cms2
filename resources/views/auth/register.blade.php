<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
    <meta name="author" content="Ansonika">
    <title>
        ثبت نام |
        {{ env('APP_NAME') }}
    </title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="sabt2/img/favicon.ico" type="/sabt2/image/x-icon">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" href="sabt2/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" sizes="72x72"
        href="sabt2/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="sabt2/image/x-icon" sizes="114x114"
        href="sabt2/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="/sabt2/image/x-icon" sizes="144x144"
        href="sabt2/img/apple-touch-icon-144x144-precomposed.png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- GOOGLE WEB FONT -->
    <link href="sabt2/css/farsi-font.css" rel="stylesheet">

    <!-- BASE CSS -->
    {{-- <link href="sabt2/css/bootstrap.min.css" rel="stylesheet">
    <link href="sabt2/css/style.css" rel="stylesheet"> --}}
    <link href="sabt2/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    <link href="sabt2/css/menu.css" rel="stylesheet">
    <link href="sabt2/css/animate.min.css" rel="stylesheet">
    <link href="sabt2/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="sabt2/css/skins/square/grey.css" rel="stylesheet">
    <link href="{{ asset('/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/main/css/stylemobilemenu.css') }}" rel="stylesheet">


    <!-- YOUR CUSTOM CSS -->
    <link href="sabt2/css/custom.css" rel="stylesheet">

    <script src="sabt2/js/modernizr.js"></script>
    <!-- Modernizr -->
    <style>
        ::placeholder {
            color: #c1c1c1c6 !important;
        }

        .bg-logo {
            background-image: url(http://instabargh.com/images/home/op100logo.png);
            background-repeat: repeat;
            background-position: inherit;

            height: 100vh;
        }
    </style>

</head>

<body>
    <div class="bg-logo v-100 w-100">



        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div><!-- /Preload -->
        <main class="">
            <div id="form_container">
                <div class="row ">
                    <div class="col-lg-7 auth-left px-5  bg-white p-md-5">

                        <div id="wizard_container ">
                            <div id="top-wizard">
                                <div id="progressbar"></div>
                            </div>
                            <!-- /top-wizard -->
                            <form action="{{ route('registerPost') }}" method="POST">

                                @csrf

                                <!-- Leave for security protection, read docs for details -->
                                <div id="middle-wizard">

                                    <!-- /step-->

                                    <!-- /step-->

                                    <div class="submit step px-3">
                                        <div class="row form-group">
                                            <div class="col-md-6 ">
                                                <div>
                                                    <p class="text-dark">
                                                        نام
                                                        <svg style="width: 11px;height: 11px;color: red;"
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-asterisk"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </p>
                                                    <input type="text" value="{{ old('fname') }}" name="fname"
                                                        class="form-control required"
                                                        placeholder="نام و نام خانوادگی مدیر">
                                                    @error('fname')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        شماره ثابت
                                                       
                                                    </p>
                                                    <input type="text" value="{{ old('number') }}" name="number"
                                                        class="form-control " placeholder="02122222222">
                                                    @error('number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        نام فروشگاه
                                                        <svg style="width: 11px;height: 11px;color: red;"
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-asterisk"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </p>
                                                    <input type="text" value="{{ old('vendorName') }}"
                                                        name="vendorName" class="form-control required"
                                                        placeholder="نام فروشگاه (فارسی)">
                                                    @error('vendorName')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        شماره همراه
                                                        <svg style="width: 11px;height: 11px;color: red;"
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-asterisk"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </p>
                                                    <input type="text" value="{{ old('phone') }}" name="phone"
                                                        class="form-control required" autocomplete="number"
                                                        placeholder="09121234567">
                                                    @error('phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        رمزعبور
                                                        <svg style="width: 11px;height: 11px;color: red;"
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-asterisk"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </p>
                                                    <input type="password" value="{{ old('password') }}"
                                                        name="password" class="form-control required"
                                                        placeholder="رمزعبور">
                                                    @error('password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        آدرس
                                                        <svg style="width: 11px;height: 11px;color: red;"
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-asterisk"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </p>
                                                    <textarea name="address" placeholder="آدرس فروشگاه" rows="" class="form-control">{{ old('address') }}</textarea>

                                                    @error('address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 mb-4">
                                                <div class="captcha">
                                                    <span>{!! Captcha::img('flat') !!}</span>
                                                    <button type="button" class="btn btn-danger" class="reload"
                                                        onclick="reloadCaptcha()">
                                                        &#x21bb;
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">

                                                    <input style="font-size:14px;" type="text"
                                                        placeholder="مقدار فرم اعتبار سنجی را وارد کنید(به انگلیسی)"
                                                        name="captcha" class="form-control required">
                                                    @error('captcha')
                                                        <p class="text-danger">مقدار فرم اعتبار سنجی را به درستی وارد کنید
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /step-->
                                </div>
                                <!-- /middle-wizard -->
                                <div id="bottom-wizard" class="text-center">
                                    <button type="submit" name="process"
                                        class="submit btn btn-block btn-primary w-75 my-3">ثبت
                                        اطلاعات</button>
                                </div>
                                <!-- /bottom-wizard -->
                            </form>
                        </div>
                        <!-- /Wizard container -->
                    </div>
                    <div class="col-lg-5 bg-white border-left border-2 p-md-5 order-md-2 order-xs-2 order-sm-2 ">
                        <div class="text-center" id="left_form">
                            <figure class="text-center"><a href="{{route('home')}}">
                                <a href="{{route('home')}}">
                                    <img class="img-fluid w-50"
                                            src="http://instabargh.com/main/logoasli.png" alt="">
                                </a>
                            </a>
                            </figure>
                            <a class="h4 my-3 text-dark" href="">
                                راهنمای عضویت در سایت اینستابرق

                            </a>

                            <p style="color:black;">شما با عضویت در اینستابرق می توانید موفق شوید از ادمین درست شود</p>

                            <p>{{ env('APP_NAME') }}</p>
                            <ul class="d-flex justify-content-evenly">
                                <li><a class="animated_link m-3 btn btn-secondary " href="{{ route('login') }}">قبلا
                                        ثبت
                                        نام
                                        کرده ام</a></li>
                                <li><a class="animated_link m-3 btn btn-secondary " href="{{ route('home') }}">صفحه
                                        اصلی</a>
                                </li>
                            </ul>
                            <br class="py-5 my-5">
                            <br class="py-5 my-5">
                            <br class="py-5 my-5">

                            {{-- <p><span style="text-align: justify">این وب سایت راهی رو بر شما می گشاید که پایان آن پیداست
                                .<br>
                                ما با کمک مشاوره و شخصیت افراد ، زوج های مناسب را با رضایت آن ها به یکدیگر معرفی می کنیم
                                .<br>
                                اما این پایان کار ما نیست این تازه شروع ماجراست ما با نظارت کامل و حفظ حریم شخصی افراد
                                سعی در
                                ایجاد روابط شفاف و سالم داریم <br> بله درست است ، تمامی کاربران این وب سایت احراز هویت
                                می شوند و
                                ما از هر گونه فعالیت غیرواقعی در وب سایتمان و ایجاد اکانت های جعلی جلوگیری می کنیم.!
                            </span></p> --}}
                            <a href="#" id="more_info" data-toggle="modal" data-target="#more-info"><i
                                    class="pe-7s-info"></i></a>
                        </div>
                    </div>



                </div><!-- /Row -->
            </div><!-- /Form_container -->
        </main>

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
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نافهم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                            تکنولوژی
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
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نافهم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                            تکنولوژی
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
    </div>
    @include('home.sections.mobile_buttom_menu')

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
    function reloadCaptcha() {
        console.log('asdasd');
        $.ajax({
            type: 'POST',
            url: '/reloadCaptch',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                $(".captcha span").html(data.captcha);
            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });
    }
</script>

</html>
