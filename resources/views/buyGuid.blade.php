<?php

$_SESSION['page'] = false;

?>





@extends('master')

@section('title', 'راهنمای خرید کالا ')

@section('description',
    'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
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



    @push('contents')

        <div class="container ">


            @if ($setting_detail->buy_video_name)
                <div class="row p-5 text-center ">
                    <video controls>
                        <source src="{{ env('SETTING_VIDEOS_UPLOAD_PATH') . $setting_detail->buy_video_name }}"
                            type="video/webm" />
                    </video>
                </div>
            @endif


            <div class="container bg-white">
                <div class=" p-5 pt-0">
                    {!! $setting_detail->Buy_guid_text !!}

                    @if ($setting_detail->aparat_buy)
                        <div class="col-12">


                            {!! $setting_detail->aparat_buy !!}



                        </div>
                    @endif

                </div>
            </div>




        </div>


    @endpush

    @push('footer_scripts')
        @include('layouts.home.footer.script')
    @endpush
