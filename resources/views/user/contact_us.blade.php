<?php

$_SESSION['page'] = 'contact_us';

?>





@extends('user.layouts.user')

@section('title', 'تماس با ما')

@section('description', 'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
    با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')

    @push('header_styles')
        @include('layouts.home.header.styles')
    @endpush


    @push('header_scripts')
        @include('layouts.home.header.scripts')

        <script>
            window.addEventListener('scroll', function() {
                if (window.pageYOffset) {
                    $('#toppp').css('display', 'none');
                } else {
                    jQuery('#toppp').css({
                        position: 'fixed',
                        width: 100 % ,
                        z - index: 1000,
                        top: '',
                        display: 'block'
                    });
                }

            })
        </script>
    @endpush


    @push('headers')
        @include('layouts.home.header.head')
    @endpush



    @section('content')
        <div class="container  ">

            <div class="row justify-content-center border-box-custome  m-3 ">

                <div class=" col-12 img-contact-us text-center">
                    <img src="{{ asset('images/13105774_5143151.png') }}" alt="">
                </div>


                <div class="col-3  mt-3 display-moblie ">
                    <div class=" text-center iransanslight change-size-elements">
                        <div class="background-title">
                            <h3 class=" iransansmedium mb-4 title-color">اطلاعات تماس</h3>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p> {{ $setting_detail->whatsapp }} </p>
                            </div>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1744.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p>{{ $setting_detail->telephone }}</p>

                            </div>
                        </div>

                        <div class="telinfo   secondborderboxinfo mt-3">
                            <div class="imgcontact-size imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1744.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p>{{ $setting_detail->telephone2 }}</p>
                            </div>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-11.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p> {{ $setting_detail->fax }} </p>
                            </div>
                        </div>


                        <div class="Emailinfo secondborderboxinfo mt-3 ">
                            <div class="email-icon-size imgemail secondboxshadow ">
                                <img src="{{ asset('images/Untitled-17.png') }}" alt="">
                            </div>
                            <div class="infoemail mt-2 custome-margin ">

                                <p>info@instabargh.com</p>
                            </div>
                        </div>
                        <div class="showmap  mt-3">
                            <div class="imgemail secondboxshadow ">
                                <img src="{{ asset('images/Location-icon-design-on-transparent-background-PNG (1)12222.png') }}"
                                    alt="">
                            </div>
                            <div class="infoemail infoemail mt-2 contact-style-info ">

                                <p>آدرس ما :

                                    {{ $setting_detail->address }}

                                </p>
                            </div>
                            <div class=" change-size-elements">
                                <a target="_blank"
                                    href="https://maps.google.com/?q={{ $setting_detail->latitude }},{{ $setting_detail->longitude }}"
                                    role="button"
                                    class="d-block card-link btn btn-outline-primary btn-block footer_masiryabi mb-2">
                                    مسیریابی
                                </a>
                            </div>
                        </div>
                        <p id="ticketError" style=" display: none;">


                            <small id="ticketErrorText">
                            </small>

                        </p>






                    </div>

                </div>




            </div>
        </div>
        @include('home.sections.mobile_buttom_menu')

    @endsection
