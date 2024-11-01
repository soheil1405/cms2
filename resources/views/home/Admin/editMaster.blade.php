<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="@yield('ngApp')" dir="rtl">

@stack('top_scripts')

<head>
    <title>اینستابرق - @yield('title')</title>


    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta property="og:site_name" content="InstaBargh">
    <meta property="og:title" content="@yield('metaTitle')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en">
    <meta property="og:url" content="https://instabargh.com/">
    <meta property="og:image" content="@yield('image')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('alt')">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap/js/bootstrap.min.js') }}">
    <link rel="stylesheet" href="{{ url('bootstrap/js/bootstrap.bundle.min.js') }}">
    <link rel="stylesheet" href="{{ url('owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('owlcarousel/owl.carousel.min.js') }}">
    <link rel="stylesheet" href="{{ url('owlcarousel/owl.theme.default.min.css') }}">


    <link rel="shortcut icon" href="{{ url('main/logo.png') }}">
    <link rel="stylesheet" href="{{ url('main/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('main/css/styleAmini.css') }}">

    {{-- <link rel="stylesheet" href="{{ url('main/css/style2.css') }}"> --}}

    <link rel="stylesheet" href="{{ url('main/css/tabsstyle.css') }}">

    @stack('header_styles')


    @stack('header_scripts')



    <?php $setting = App\Models\Admin\Setting::first(); ?>




    <script>
        var scrollableElement = document.body; //document.getElementById('scrollableElement');

        scrollableElement.addEventListener('wheel', checkScrollDirection);

        function checkScrollDirection(event) {
            if (checkScrollDirectionIsUp(event)) {


                $('.mainnn').addClass('stickymain');
                $('.bigCatMenu').css('height', 'auto');
                $('.nav-login').addClass('stickyMenu');

                if (document.body.scrollTop < 200) {
                    $('.nav-login').removeClass('stickyMenu');
                    $('.mainnn').removeClass('stickymain');

                }
            } else {
                if (document.body.scrollTop > 200) {
                    $('.bigCatMenu').css('height', '0px');

                    var e = document.querySelector("#searchResult");


                    var child = e.lastElementChild;
                    while (child) {
                        e.removeChild(child);
                        child = e.lastElementChild;
                    }


                } else {

                    $('.nav-login').addClass('stickyMenu');
                    $('.bigCatMenu').css('height', 'auto');
                }
                $('.mainnn').removeClass('stickymain');
                console.log('Down');

            }
        }

        function checkScrollDirectionIsUp(event) {
            if (event.wheelDelta) {
                return event.wheelDelta > 0;
            }
            return event.deltaY < 0;
        }


        
    </script>



</head>

<header>
    @stack('headers')
</header>


<body class="@stack('bodyClass')" ng-controller="@yield('ngController')" data-ng-init="init()">




    @auth


        @if(Auth::user()->rols()->where('name','admin')->get()->count() >0 )
    <div style="position: fixed; z-index:10000000; top:15%;" class="instarang">

        <a href="{{ route('home') }}" style="font-size: 20px;" class="animate-charcter sideLink1A">  تایید </a>

    </div>

    @endif

    
    @endauth



    @guest
        <div style="" class="sideLink2">
            <a class="animate-charcter" style="font-size: 30px;" href="{{ route('register') }}"> ثبت فروشگاه</a>

        </div>

    @endguest


    @if (Session::has('compList'))
        <?php
        $comp = Session::get('compList');
        ?>


        <a  href="{{ route('compare.index') }}"
            style=" position:fixed; left:10px; bottom: 20px; border-radius: 50%; z-index:1000;width:100px; height:100px; justify-content: center;
            padding:20px;
            
            @if (count($comp) < 1) display:none; @endif"
            
            class="instarang compCounter"
            >


            <span class=" " style="background-color: #ffffff; color:black; padding:0px 5px;  border-radius: 50%; ">
                 {{ count($comp) }} </span>

            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" 
                class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
            </svg>
        </a>
    @endif
    @stack('contents')

    @stack('footer_scripts')

    @include('sweetalert::alert')

    </div>
</body>
<footer class="footer-area footerDiv">

    <section id="footer-link" class="mdb-color darken-4 pb-3 container">
        <div class=" d-flex justify-content-center">
            <div class="col-12 ">
                <div class="vazirFont row justify-content-between">
                    <div class="col-md-3 col-xs-12">
                        <h3 class="header-link-footer">لینک های دسترسی</h3>
                        <ul class="list-unstyled">

                            @foreach (App\Models\footerLinks::all() as $link)
                                <li class="vazirFont mb-2 text-nowrap text-center">
                                    <a href="{{ $link->link }}" class="white-text footerItem">


                                        {{ $link->name }}


                                    </a>
                                </li>
                            @endforeach

    
    
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <h3 class="header-link-footer ">تماس با ما</h3>
                        <ul class="list-unstyled">

                            <li class="mb-2 white-text text-nowrap divItemLi text-center">


                                <span class="d-lg-inline">

                                    <span class="vazirFont">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>

                                        <a class="footerItem" href="tel:{{ $setting->telephone }}">
                                            {{ $setting->telephone }} </a>



                                    </span>

                                </span>

                                <i class="fas fa-phone fa-sm ml-2"></i>
                                <span class="vazirFont">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                    <a class="footerItem" href="tel:{{ $setting->telephone2 }}">
                                        {{ $setting->telephone2 }} </a>

                                </span>

                            </li>

                            <li class="mb-2 white-text text-nowrap text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                    <path
                                        d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                </svg>
                                <span class="vazirFont" class="footerItem">

                                    {{ $setting->email }}

                                </span>
                            </li>
                            <li class="mb-2 white-text text-nowrap text-center">
                                فکس :
                                <span class="vazirFont">

                                    {{ $setting->fax }}

                                </span>
                            </li>
                            <li class="mb-2 white-text text-nowrap text-center">
                                <a rel="noopener nofollow"target="_blank"
                                    href="https://www.instagram.com/{{ $setting->instagram }}"
                                    class="btn-floating transparent z-depth-0 m-0 waves-effect waves-light social-icon-footer"
                                    type="button" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                    </svg> </a>
                                <a rel="noopener nofollow" target="_blank"
                                    class="btn-floating  transparent z-depth-0 m-0 waves-effect waves-light social-icon-footer"
                                    href="https://api.whatsapp.com/send?phone=+{{ $setting->whatsapp }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                    </svg> </a>
                                <!--Telegram-->
                                <a rel="noopener nofollow" target="_blank"
                                    href="https://telegram.me/{{ $setting->telegram }}"
                                    class="btn-floating transparent z-depth-0 m-0 waves-effect waves-light social-icon-footer"
                                    type="button" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                                    </svg> </a>
                                <!--Whatsapp-->

                            </li>


                        </ul>

                    </div>
                    <div class="col-md-3 col-xs-12">
                        <h3 class="header-link-footer ">آدرس ما </h3>
                        <div class="col-12">
                            <p class="footerDetail1">


                                {{ $setting->address }}
                            </p>
                            <a target="_blank" href="https://maps.google.com/?q= <?php echo $setting->latitude . ',' . $setting->longitude; ?>" role="button"
                                class="d-block card-link btn btn-outline-primary btn-block footer_masiryabi mb-2">
                                مسیریابی
                            </a>



                        </div>


                        <div class="col-12">
                            <?php $src = 'https://map.ir/lat/ ' . $setting->latitude . ' /lng/' . $setting->longitude . '/z/15/p/ دفتر اینستابرق  '; ?>

                            <iframe width="100%" height="250px" src=" {{ $src }} "></iframe>


                        </div>
                    </div>

                </div>



            </div>

        </div>
        <hr class="rgba-grey-light my-4">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="">

                    <div class="col-md-6 col-sm-12">

                        <h2>
                            ارسال تیکت به اینستابرق
                        </h2>
                        <div id="ticketSuccess" class="alert alert-success d-none">


                            تیکت شما با موفقیت ارسال شد



                        </div>


                        <div class="col-12">

                            <div class="col-12 text-center ">

                                <input type="text" placeholder="عنوان تیکت :" id="ticketSubject" name="subject"
                                    required class="form-control m-1 ticketSubject">

                                @auth

                                    <input type="hidden" name="username" class="ticketUsername"
                                        value="{{ Auth::user()->vendor->id }} ">

                                @endauth

                                @guest

                                    <input type="hidden" name="username" value="guest" class="ticketUsername_guest">

                                @endguest



                                <input type="email" placeholder="ایمیل شما :" required name="email"
                                    id="ticketEmail" class="form-control ticketEmail  m-1">

                                <textarea name="text" cols="30" rows="10" id="ticketText" class="form-control ticketText">متن تیکت</textarea>

                                <p id="ticketError" style=" display: none;">

                                    <small class="text-danger">

                                        *

                                    </small>

                                    <small id="ticketErrorText">
                                    </small>

                                </p>



                                <button onclick="Sendticket()" class="btn btn-warning m-3">ارسال تیکت

                                </button>

                            </div>


                        </div>

                    </div>




                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="col-md-12 col-xs-12">
                    <div class="" id="insrabargh">
                        <div class="">
                            <div class="col-md-8 text-center">
                              
                                <div class="text-center">
                                    <h1 style="font-family:'dastnevis' !important;">اینستابرق<h1>
                                    <h2 class="footerMainText">
                                        تنوع در خرید،تحول در فروش
                                    </h2>
                                </div>

                                <div class="text-center footerMainText">

                                    {!! $setting->footerText !!}

                                </div>

                            </div>
                            <div class="col-8 footerEnamadDiv d-flex" style="justify-content: space-around;">
                                <img src="{{ url(env('FOOTER_IMAGES') . 'samandehi.png') }}" class="footerEnamadPic"
                                    alt="">
                                <img src="{{ url(env('FOOTER_IMAGES') . 'enamad.png') }}" class="footerEnamadPic"
                                    alt="">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>






    </section>
</footer>


</html>










<style>
    .sc-bottom-bar {
        position: absolute;
        display: flex;

        padding: 16px 36px;
        justify-content: space-between;
        width: 375px;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 32px;

        font-size: 26px;
        background-image: radial-gradient(circle at 36px 6px, transparent 36px, #ffffff 37px);
        filter: drop-shadow(0px -1px 6px rgba(0, 0, 0, 0.08)) drop-shadow(0px -2px 12px rgba(0, 0, 0, 0.12));
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        transition: cubic-bezier(0.57, 0.23, 0.08, 0.96) .45s;
    }

    .sc-nav-indicator {
        position: absolute;

        width: 56px;
        height: 56px;
        bottom: 28px;
        margin: auto;
        left: 0;

        background-color: #000000;
        box-shadow: var(--main-cast-shadow);
        border-radius: 50%;
        transition: cubic-bezier(0.45, 0.73, 0, 0.59) .3s;
    }

    .sc-menu-item {
        color: var(--fore-color);
        transition: ease-in-out .5s;

        cursor: pointer;
    }

    .sc-current {
        position: relative;

        color: #ffffff;

        z-index: 3;
        transform: translate3d(0px, -22px, 0px);
    }
</style>










<script>
    var menu_bar = document.querySelector('.sc-bottom-bar');
    var menu_item = document.querySelectorAll('.sc-menu-item');
    var menu_indicator = document.querySelector('.sc-nav-indicator');
    var menu_current_item = document.querySelector('.sc-current');
    var menu_position;

    menu_position = menu_current_item.offsetLeft - 16;
    menu_indicator.style.left = menu_position + "px";
    menu_bar.style.backgroundPosition = menu_position - 8 + 'px';
    menu_item.forEach(
        function(select_menu_item) {
            select_menu_item.addEventListener('click', function(e) {
                e.preventDefault();
                menu_position = this.offsetLeft - 16;
                menu_indicator.style.left = menu_position + "px";
                menu_bar.style.backgroundPosition = menu_position - 8 + 'px';
                [...select_menu_item.parentElement.children].forEach(
                    sibling => {
                        sibling.classList.remove('sc-current');
                    })
                select_menu_item.classList.add('sc-current');
            });
        }
    )
</script>
