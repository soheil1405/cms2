<?php

$_SESSION['page'] = 'aboute_us';

?>





@extends('master')

@section('title', ' درباره ما')

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


    <div id="toppp">


        @push('headers')
            @include('layouts.home.header.head')
        @endpush



        @push('contents')
            <div class="container bg-white">
                <div class=" p-5 pt-0">

                    {!! $setting_detail->aboute !!}
                </div>
            </div>
            @include('home.sections.mobile_buttom_menu')
        @endpush

        @push('footer_scripts')
            @include('layouts.home.footer.script')
        @endpush
