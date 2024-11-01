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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- GOOGLE WEB FONT -->
    <link href="sabt2/css/farsi-font.css" rel="stylesheet">

    <!-- BASE CSS -->
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('bootstrap/js/bootstrap.min.js') }}"> --}}
    <link href="sabt2/css/style.css" rel="stylesheet">
    <link href="sabt2/css/responsive.css" rel="stylesheet">
    <link href="sabt2/css/menu.css" rel="stylesheet">
    <link href="sabt2/css/animate.min.css" rel="stylesheet">
    <link href="sabt2/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="sabt2/css/skins/square/grey.css" rel="stylesheet">
    {{-- <link href="{{ asset('/css/home.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/main/css/stylemobilemenu.css') }}" rel="stylesheet">



    <!-- YOUR CUSTOM CSS -->
    <link href="sabt2/css/custom.css" rel="stylesheet">

    <script src="sabt2/js/modernizr.js"></script>
    <!-- Modernizr -->



</head>

<body>

    <div class="bg-logo">

        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div><!-- /Preload -->
        <main>
            <div id="form_container">
                <div class="row">

                    <div class="col-lg-5 bg-white border-left border-2">
                        <div id="left_form">
                            <figure class="mt-3 mb-0"><a href="{{ route('home') }}">
                                    <img class="img-fluid " src="http://instabargh.com/main/logoasli.png"
                                        alt="">
                                </a>
                            </figure>
                            <h2 class="irdastnevis  my-2  "> {{ env('APP_NAME') }}</h2>
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
                        <ul style="list-style-type: none;" class="d-flex justify-content-around p-0 mb-0">
                            <li><a href="{{ route('register') }}" class="animated_link btn btn-secondary">ثبت نام</a>
                            </li>
                            <li><a href="{{ route('reset_pass') }}" class="animated_link btn btn-secondary">فراموشی رمز
                                    عبور</a></li>
                            <li><a href="{{ route('home') }}" class="animated_link btn btn-secondary">صفحه اصلی</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-7 auth-left">

                        <div id="wizard_container">
                            <div id="top-wizard">
                                <div id="progressbar"></div>
                            </div>
                            {{-- @dd('asdads'); --}}
                            <!-- /top-wizard -->
                            <form action="{{ route('loginPost') }}" class="mb-5" method="POST">

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
                                                    <input type="text" value="{{ old('phone') }}" name="phone"
                                                        class="form-control required" placeholder="شماره همراه">
                                                    @error('phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <p class="text-dark">
                                                        رمزعبور
                                                    </p>
                                                    <input type="password" value="{{ old('password') }}"
                                                        name="password" class="form-control required"
                                                        placeholder="رمزعبور">
                                                    @error('password')
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

                                                    <input type="text" name="captcha"
                                                        placeholder="مقدار بالا را اینجا وارد کنید"
                                                        class="form-control required">
                                                    @error('captcha')
                                                        <p class="text-danger"> فیلد فرم اعتبار سنجی به درستی وارد نشده است
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <!-- /step-->
                                </div>
                                <!-- /middle-wizard -->
                                <div class="text-center" id="">
                                    <button type="submit" name="process"
                                        class="submit btn-primary btn w-75 my-3 mx-auto">ورود</button>
                                </div>
                                <!-- /bottom-wizard -->
                            </form>
                        </div>
                        <!-- /Wizard container -->
                    </div>

                </div><!-- /Row -->

            </div><!-- /Form_container -->
        </main>

        {{-- <footer id="home" class="clearfix">
            <p>{{ env('APP_NAME') }}</p>
            <ul>
                <li><a href="{{ route('register') }}" class="animated_link">ثبت نام</a></li>
                <li><a href="{{ route('reset_pass') }}" class="animated_link">فراموشی رمز عبور</a></li>
                <li><a href="{{ route('home') }}" class="animated_link">صفحه اصلی</a></li>
            </ul>
        </footer> --}}
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
    </div>
    <!-- /.modal -->
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
                    console.log(dara);
                }
            });
        }
        document.getElementBy
    </script>
</body>

</html>
