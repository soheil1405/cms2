<?php

$_SESSION['page'] = 'home';

?>
<?php $setting2 = App\Models\Admin\Setting::first(); ?>




@extends('master')



@section('title', ' تنوع در خرید تحول در فروش')

@section('description',
    'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
    با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')

    @push('header_styles')
        @include('layouts.home.header.styles')
    @endpush


    @push('header_scripts')
        @include('layouts.home.header.scripts')
    @endpush






    @push('headers')
        @include('layouts.home.header.head')
    @endpush



    @push('contents')



        @if (request()->has('adminStories'))
            @include('layouts.home.openstories3')
        @elseif(request()->has('vId'))
            @include('layouts.home.openstories2')
        @endif




        <div class=" d-md-block d-none" style="opacity: 0;">
            d
        </div>


        @if ($site_setting->sliders)
            @include('layouts.home.sliders', ['home' => 'home'])
        @endif





        @if ($site_setting->stories)
            @include('layouts.home.story')
        @endif

        @if ($site_setting->products)
            @include('layouts.home.tabproduct')
        @endif



        @if ($site_setting->insid_links)
            {{-- 3 pic --}}
            <div class="container custome-margin-imgs standardtop">
                <div class="text-center">
                    <h2 style="font-family:'dastnevis' !important;">
                        راهنمای اینستابرق
                    </h2>
                </div>
                <div class="row insideLinkss">

                    <a href="{{ route('home.guid.product') }}" id="sabtproduct" class="col-4  animate__animated img-padding-style">
                        <div class="ertefa imageguide brd25">
                            <img class=" " loading="lazy"
                                src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidProductPic) }}"
                                alt="{{ url(env('HOME_LINKS_PIC') . $setting2->guidProductPic) }}">

                        </div>
                        <div class="text-center textguide">

                            {{ $setting2->guidPTitle }}
                        </div>

                    </a>
                    <a href="{{ route('home.guid.vendor') }}" id="sabtvendor"
                        class="col-4  animate__animated img-padding-style">
                        <div class="ertefa imageguide ">
                            <img loading="lazy" class="" src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidVendorPic) }}"
                                alt="{{ url(env('HOME_LINKS_PIC') . $setting2->guidVendorPic) }}">
                        </div>
                        <div class="text-center textguide">
                            {{ $setting2->guidVTitle }}
                        </div>

                    </a>
                    <a href="{{ route('home.guid.buy') }}" id="buygood" class="col-4   animate__animated img-padding-style">
                        <div class="ertefa imageguide ">
                            <img loading="lazy" class="" src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidBuyPic) }}"
                                alt={{ url(env('HOME_LINKS_PIC') . $setting2->guidBuyPic) }}"">

                        </div>
                        <div class="text-center  textguide">


                            {{ $setting2->guidBuyTitle }}
                        </div>


                    </a>
                </div>
            </div>
        @endif

        @if ($site_setting->vendors)
            {{-- end3pic3 --}}
            {{-- @include('layouts.home.tabvendor') --}}
            @include('layouts.home.newtabvendor')
        @endif
        <div class="container ">
            {{-- counter --}}
            @if ($site_setting->counters)
                @include('layouts.home.counter')
            @endif

            <div class="row g-3 py-3 two-image-size">
                @if ($site_setting->gif1)
                    <div class="col-md-6 col-12 ">
                        <img src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting2->gif1) }}" alt="">

                    </div>
                @endif

                @if ($site_setting->gif2)
                    <div class="col-md-6 col-12 ">
                        <img src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting2->gif2) }}" alt="">

                    </div>
                @endif
            </div>
            @if ($site_setting->brands)
                @include('layouts.home.brandscarousel')
            @endif
            <a href="{{ route('home') }}" id="instaidslogan" class="text-center welcomeCenterText standardtop">


                <h3 style="font-family: 'dastnevis' !important;">
                    {{ $setting2->Slogan_center }}

                </h3>

            </a>

            @if ($site_setting->links)
                <div class="container">
                    <div class="row ">
                        <div class=" linkinsid col-3  animate__animated  special-style" id="page-link-section1">
                            <div class="shadow1">
                                <a href="{{ route('home.aboute_us') }}">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_about_us) }}"
                                        alt="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_about_us) }}">
                                </a>
                                <a class="iransansmedium " style="font-size: 13px!important;"
                                    href="{{ route('home.aboute_us') }}">درباره
                                    ما</a>
                            </div>
                        </div>
                        <div class=" linkinsid col-3  animate__animated special-style" id="page-link-section2">
                            <div class="shadow1">
                                <a href="{{ route('home.laws') }}">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_laws) }}"
                                        alt="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_laws) }}">
                                </a>
                                <a class="iransansmedium " style="font-size: 13px!important;"
                                    href="{{ route('home.laws') }}">شرایط و
                                    قوانین</a>
                            </div>
                        </div>
                        <div class="col-3 linkinsid  animate__animated special-style" id="page-link-section3">
                            <div class="shadow1">
                                <a href="{{ route('home.questions') }}">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_questions) }}"
                                        alt="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_questions) }}">
                                </a>
                                <a class="iransansmedium " style="font-size: 13px!important;"
                                    href="{{ route('home.questions') }}">سوالات
                                    متداول</a>
                            </div>
                        </div>
                        <div class="col-3 linkinsid  animate__animated special-style" id="page-link-section4">
                            <div class="shadow1">
                                <a href="{{ route('home.guid.Add') }}">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_Adds) }}"alt="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_Adds) }}    ">
                                </a>
                                <a class="iransansmedium " style="font-size: 13px!important;"
                                    href="{{ route('home.guid.Add') }}">تبلیغات
                                    در اینستابرق</a>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($site_setting->articles)
                {{-- شروع مجله اینستابرق --}}
                @include('layouts.home.blog')
            @endif

        </div>




        @include('home.sections.mobile_buttom_menu')

    @endpush
    {{-- @dd('asdasd'); --}}

    @push('footer_scripts')
        @include('layouts.home.footer.script')
        <script>
            $(window).scroll(function() {

                if ($("#exTab2")[0].getBoundingClientRect().top < 400) {
                    $("#sabtproduct").addClass("animate__rotateInDownRight animate__delay-1s");
                    $("#buygood").addClass("animate__rotateInDownLeft animate__delay-1s");
                    $("#sabtvendor").addClass("animate__rotateIn animate__delay-1s");
                }
                if ($("#instaidslogan")[0].getBoundingClientRect().top < 900) {
                    $("#page-link-section1").addClass("animate__zoomInDown ");
                    $("#page-link-section2").addClass("animate__zoomInDown ");
                    $("#page-link-section3").addClass("animate__zoomInDown ");
                    $("#page-link-section4").addClass("animate__zoomInDown ");
                }

            });
        </script>
    @endpush
