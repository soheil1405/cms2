<?php

$_SESSION['page'] = false;

?>





@extends('master')

@section('title', 'راهنمای خرید کالا ')

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



    @push('contents')
        <div class="container ">



            <div class="container">
                <div class="bg-white p-5">

                    <h1>
                        {{ $buyguid->title }}
                    </h1>

                    {!! $buyguid->body !!}

                </div>
            </div>




        </div>
    @endpush

    @push('footer_scripts')
        @include('layouts.home.footer.script')
    @endpush
