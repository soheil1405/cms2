div<?php

$_SESSION['page'] = 'home';

?>


<?php $setting = App\Models\Admin\SiteSetting::first(); ?>

<?php $setting2 = App\Models\Admin\Setting::first(); ?>


@extends('home.Admin.editMaster')

@section('title', 'home')


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
    @include('home.Admin.silder')


    @include('home.Admin.stroy')


    @include('home.Admin.tabproduct')



    {{-- 3 pic --}}
    <div
        class="container mt-5
        
        
        
        
        @if (!$site_setting->insid_links) notttt @endif
        
        
        
        
        
        ">

        <form method="POST" id="HomeEditLinks1" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}">

            @csrf

            <div class="">

                <label class="switch">

                    <input type="hidden" name="lin1" value="1">

                    <input name="HomeLin1" type="checkbox" id="sliderController" style="display: none;"
                        onchange="$('#HomeEditLinks1').submit();" @if ($site_setting->insid_links) checked @endif>
                    <span class="round"></span>
                </label>

            </div>

        </form>






        <div class="row insideLinkss">

            <a href="{{ route('home.guid.product') }}" class="col-4  guide-pic">
                <div class="ertefa">
                    <img class="brd25 " src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidProductPic) }}" alt="">

                </div>
                {{ $setting2->guidPTitle }}

            </a>
            <form id="guidProductPicForm" action="{{ route('admin.settindDetail.updateguidProductPic') }}" method="post"
                enctype="multipart/form-data">

                @csrf
                <input type="file" name="guidProductPic" onchange="$('#guidProductPicForm').submit();">

            </form>
            <a href="{{ route('home.guid.vendor') }}" class="col-4 guide-pic">
                <div class="ertefa">
                    <img class="brd25" src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidVendorPic) }}" alt="">
                </div>
                {{ $setting2->guidVTitle }}
            </a>
            <form id="guidVendorPicForm" action="{{ route('admin.settindDetail.updateguidVendorPic') }}" method="post"
                enctype="multipart/form-data">

                @csrf
                <input type="file" name="guidVendorPic" onchange="$('#guidVendorPicForm').submit();">

            </form>
            <a href="{{ route('home.guid.buy') }}" class="col-4  guide-pic">
                <div class="ertefa">
                    <img class="brd25" src="{{ url(env('HOME_LINKS_PIC') . $setting2->guidBuyPic) }}" alt="">
                </div>
                {{ $setting2->guidBuyTitle }}
            </a>
            <form id="guidBuyPicForm" action="{{ route('admin.settindDetail.updateguidBuyPic') }}" method="post"
                enctype="multipart/form-data">

                @csrf
                <input type="file" name="guidBuyPic" onchange="$('#guidBuyPicForm').submit();">

            </form>
        </div>
    </div>

    {{-- end3pic3 --}}
    @include('home.Admin.tabvendor')
    <div class="container ">
        {{-- counter --}}
        @include('home.Admin.counter')

        @include('home.Admin.brandscarousel')
        <div class="text-center welcomeCenterText ">

            <form action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}" method="post">

                @csrf

                <input type="hidden" name="slg" value="1">

                <input type="text" name="center" value="{{ $setting2->Slogan_title }}">


                <input type="text" name="title" value="{{ $setting2->Slogan_center }}">


                <input type="submit" value="تایید">
            </form>
        </div>

        <div
            class="container
            @if (!$setting->links) notttt @endif
            
            
            
            
            
            ">

            <form method="POST" id="HomeEditLinks2" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}">

                @csrf

                <div class="">

                    <label class="switch">

                        <input type="hidden" name="lin2" value="1">

                        <input name="links" type="checkbox" id="sliderController" style="display: none;"
                            onchange="$('#HomeEditLinks2').submit();" @if ($site_setting->links) checked @endif>
                        <span class="round"></span>
                    </label>

                </div>

            </form>



            <div class="row">
                <div class=" linkinsid col-sm-3">
                    <div class="shadow1">
                        <a href="{{ route('home.aboute_us') }}">
                            <img class="img-fluid"
                                src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_about_us) }}" alt="">
                        </a>
                        <a href="{{ route('home.aboute_us') }}">درباره ما</a>
                    </div>

                    //////////////////////////////

                    <form id="aboute_usImgForm" action="{{ route('admin.settindDetail.aboute_usImg') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="file" name="file" onchange="$('#aboute_usImgForm').submit();">

                    </form>





                </div>
                <div class=" linkinsid col-sm-3">
                    <div class="shadow1">
                        <a href="{{ route('home.laws') }}">
                            <img class="img-fluid"
                                src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_laws) }}" alt="">
                        </a>
                        <a href="{{ route('home.laws') }}">شرایط و قوانین</a>
                    </div>

                    /////////////////////////////
                    <form id="home_icon_lawsForm" action="{{ route('admin.settindDetail.home_icon_laws') }}"
                        method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="file" name="file" onchange="$('#chome_icon_lawsForm').submit();">

                    </form>


                </div>
                <div class="col-sm-3 linkinsid">
                    <div class="shadow1">
                        <a href="{{ route('home.questions') }}">
                            <img class="img-fluid"
                                src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_questions) }}"
                                alt="">
                        </a>
                        <a href="{{ route('home.questions') }}">سوالات متداول</a>
                    </div>
                    ////////////////////////////////
                    <form id="home_icon_questionsForm" action="{{ route('admin.settindDetail.home_icon_questions') }}"
                        method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="file" name="file" onchange="$('#home_icon_questionsForm').submit();">

                    </form>


                </div>
                <div class="col-sm-3 linkinsid">
                    <div class="shadow1">
                        <a href="{{ route('home.guid.Add') }}">
                            <img class="img-fluid"
                                src="{{ url(env('HOME_LINKS_GUID_ICONS') . $setting2->home_icon_Adds) }}"alt="">
                        </a>
                        <a href="{{ route('home.guid.Add') }}">تبلیغات در اینستابرق</a>

                    </div>
                    ////////////////////////////////
                    <form id="home_icon_AddsForm" action="{{ route('admin.settindDetail.home_icon_Adds') }}"
                        method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="file" name="file" onchange="$('#home_icon_AddsForm').submit();">

                    </form>


                </div>
            </div>
        </div>

        {{-- شروع مجله اینستابرق --}}
        @include('home.Admin.blog')

    </div>
@endpush

@push('footer_scripts')
    @include('layouts.home.footer.script')
@endpush
