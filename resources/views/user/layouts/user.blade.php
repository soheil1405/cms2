<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('main/datepicker/datepicker.css') }}" />


    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    @yield('style')
    @stack('header_styles')
    @stack('header_scripts')


    <link href="sabt2/css/custom.css" rel="stylesheet">

    <script src="sabt2/js/modernizr.js"></script>
    <!-- Modernizr -->


    <link href="sabt2/css/style.css" rel="stylesheet">
    <link href="{{ asset('/main/css/stylemobilemenu.css') }}" rel="stylesheet">


    <style>
        @font-face {
            font-family: dastnevis;
            src: {{ asset('main/fonts/irdastnevis/IRDastNevis.eot') }},
                url("../../main/fonts/irdastnevis/IRDastNevis.woff") format("woff"),
                url("../../main/fonts/irdastnevis/IRDastNevis.woff2") format("woff2");
            font-weight: normal;
            font-style: normal;
        }

        .addneww {
            padding: 10px;




            border-radius: 8px;

            background-color: red;
        }

        .addnewwq {
            text-transform: uppercase;
            font-size: 55px !important;
            background-image: linear-gradient(-225deg,
                    #0000 0%,
                    #ffff 29%,
                    #efefef 67%,
                    gray 90%,
                    #ffff 100%);
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 3s linear infinite;
            /* display: inline-block; */

        }

        .zirdokme {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            background-color: #f74040;
            border-radius: 15px;
            margin-bottom: 10px;

        }

        @media screen and (max-width: 769px) {
            .zirdokme {
                width: 85%;
            }
        }



        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }

        @media only screen and (min-width:0) and (max-width: 576px) {

            .addnewwq {
                padding-top: 8px !important;
                font-size: 30px !important;
            }

            .addneww {
                height: 100px !important;
            }

        }

        .ijad {
            position: relative;
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin: 2px 0;
            padding: 5px 0px;
            text-align: center;
            color: white;
            background-color: red !important;
            padding: 5px 10px;
            padding-top: 10px;



        }

        .ijad:hover {

            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px red,
                0 0 25px #6d025b,
                0 0 50px #f32c4d,
                0 0 100px #d10000;
            text-decoration: none;
        }

        .ijad span {
            position: absolute;
            display: block;
        }

        .ijad span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ffffff);
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }

            50%,
            100% {
                left: 100%;
            }
        }

        .ijad span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #ffffff);
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }

            50%,
            100% {
                top: 100%;
            }
        }

        .ijad span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(270deg, transparent, #ffffff);
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }

            50%,
            100% {
                right: 100%;
            }
        }

        .ijad span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(360deg, transparent, #ffffff);
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }

            50%,
            100% {
                bottom: 100%;
            }
        }

        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }



        .overlay {
            height: 0%;
            width: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            justify-content: center;
            left: 0;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
            overflow-y: hidden;
            transition: 0.5s;
        }

        .overlay-content {
            position: relative;
            top: 25%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        .overlay a {
            padding: 4px;
            text-decoration: none;
            font-size: 26px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay a:hover,
        .overlay a:focus {
            color: #f1f1f1;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media screen and (max-height: 450px) {
            .overlay {
                overflow-y: auto;
            }

            .overlay a {
                font-size: 20px
            }

            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }

        .animate-charcter {
            text-transform: uppercase;


            background-image: linear-gradient(-225deg,
                    #231557 0%,
                    #44107a 29%,
                    #ff1361 67%,
                    #fff800 100%);

            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #000000;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;

        }

        @keyframes textclip {
            to {
                background-position: 200%;
            }
        }
    </style>



</head>

@auth


    <?php
    $newComments = Auth::user()->vendor->newComments;
    
    $unread_notifable = Auth::user()->vendor->unreadNotifableMassage[0];
    
    ?>


@endauth





<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Preload -->


<div id="overlay">

    <div class="cv-spinner">
        <h4 style="color:white; margin:5%;">
            لطفا منتظر بمانید
        </h4>

        <span class="spinner"></span>

        <hr>


    </div>
</div>




<body id="page-top">
    @if (isset($vendorrr) && !is_null($vendorrr))
        @include('layouts.home.openstories2')
    @endif
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('user.sections.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('user.sections.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->


                <div class="container-fluid">

                    {{-- <a class="ijad float-left" href="https://stand-co.com/administrator/category/create">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            ایجاد دسته بندی جدید
                        </a> --}}

                    @if (Route::currentRouteName() != 'user.products.create' && Route::currentRouteName() != 'user.products.edit')
                        <div class="text-center zirdokme">
                            <a href="{{ route('user.products.create') }}" style=""
                                class="addnewwq text-center ijad">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                افزودن کالا

                            </a>
                        </div>
                    @endif

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('user.sections.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('user.sections.scroll_top')
    @include('home.sections.mobile_buttom_menu')


    <!-- JavaScript-->
    <script src="{{ asset('/js/admin.js') }}"></script>

    @include('sweetalert::alert', ['cdn' => env('SWEET_ALERT_CDN')])


    @yield('script')

    @stack('footer_scripts')


    <div class="col-12">



        {{-- @if ($unread_notifable)

            @php
                
                $showed = Session::get('showedNotificationSession');
                
                $counter = 0;
                
            @endphp

            @if (!is_null($showed))

                @foreach ($showed as $item)
                    @if ($item == $unread_notifable->id)
                        @php
                            
                            $counter++;
                            
                        @endphp
                    @endif
                @endforeach

                @if ($counter == 0)
                    @include('user.sections.notification')
                @endif
            @else
                @include('user.sections.notification')


            @endif

        @endif --}}

    </div>



    <script src="sabt2/js/functions.js"></script>


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
    </script>

</body>

</html>
