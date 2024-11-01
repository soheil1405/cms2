<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
    <meta name="author" content="Ansonika">
    <title>
        بازیابی |
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
    <link href="{{ asset('/main/css/stylemobilemenu.css') }}" rel="stylesheet">

</head>

<body>
    <div class="bg-lo5go">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div><!-- /Preload -->
        <main>
            <div id="form_container-2" class="mt-4 container">
                <div class="row">
                    <div class="col-lg-5 auth-right-2">
                        <div id="left_form">
                            <figure><img class="img-fluid" src="http://instabargh.com/main/logoasli.png" alt="">
                            </figure>
                            <h2>بازیابی رمز عبور</h2>
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

                        </div>
                    </div>
                    <div class="col-lg-7 auth-left">

                        <div id="wizard_container">
                            <div id="top-wizard">
                                <div id="progressbar"></div>
                            </div>
                            <!-- /top-wizard -->
                            <form action="{{ route('reset_passPost') }}" method="POST">

                                @csrf

                                <!-- Leave for security protection, read docs for details -->
                                <div id="middle-wizard">

                                    <!-- /step-->

                                    <!-- /step-->

                                    <div class="submit step">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        شماره همراه
                                                    </p>
                                                    <input type="text" value="{{ old('mobile') }}" name="mobile"
                                                        class="form-control required" placeholder="شماره همراه">
                                                    @error('mobile')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- @if (Session::has('token'))
                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="text-dark">
                                                    رمزعبور جدید
                                                </p>
                                                <input type="text" value="{{old('password')}}" name="passwd" hidden class="form-control required"
                                                    placeholder="رمزعبور جدید">
                                                
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="text-dark">
                                                    رمزعبور جدید
                                                </p>
                                                <input type="password" value="{{old('password')}}" name="password" class="form-control required"
                                                    placeholder="رمزعبور جدید">
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif --}}
                                            @if (Session::has('token'))
                                                <div class="col-12">
                                                    <div class="form-group">

                                                        <p class="text-dark">
                                                            کد یک بار مصرف
                                                        </p>
                                                        <input type="text" class="form-control required"
                                                            placeholder="کد" name="code" required>
                                                        @error('code')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror

                                                    </div>


                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- /step-->
                                </div>
                                <!-- /middle-wizard -->
                                <div class="text-center" id="">
                                    <button type="submit" name="process"
                                        class="submit w-75 btn btn-block m-3">بازیابی</button>
                                </div>
                                <!-- /bottom-wizard -->
                            </form>
                        </div>
                        <!-- /Wizard container -->
                    </div>
                </div><!-- /Row -->
            </div><!-- /Form_container -->
        </main>

        <footer id="home" class="clearfix mt-3">

            <ul>
                <li><a href="{{ route('register') }}" class="animated_link btn btn-secondary m-1 ">ثبت نام</a></li>
                <li><a href="{{ route('login') }}" class="animated_link btn btn-secondary m-1 ">ورود</a></li>
                <li><a href="{{ route('home') }}" class="animated_link btn btn-secondary m-1 ">صفحه اصلی</a></li>
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
    <!-- SCRIPTS -->
    @include('home.sections.mobile_buttom_menu')

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

</html>
