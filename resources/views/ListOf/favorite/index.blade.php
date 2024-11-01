<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'favorite';

?>



@extends('master')


@section('title', 'علاقه مندی ها')


@section('description', 'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
    با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')


    @push('header_styles')
        @include('layouts.home.header.styles')
        <style>
            .favoriteLink {
                color: #ffff !important;
                border-radius: 10px;
                width: 60%;
                height: 100%;
                padding: 10px;
                margin: 10px auto;
            }

            .first {
                margin-top: 10%;
            }
        </style>
    @endpush


    @push('header_scripts')
        @include('layouts.home.header.scripts')
    @endpush


    @push('headers')
        @include('layouts.home.header.head')
    @endpush


    @push('contents')
        <div class="container text-center">

            <div class="row   text-center ">


                <a href="{{ route('favorite.vendors') }}" class="first text-center   favoriteLink instarang  ">


                    <h4> <strong>

                            فروشگاه ها

                        </strong>

                        (
                        {{ count($vendors) }}
                        )

                    </h4>

                </a>


                <a href="{{ route('favorite.products') }}" class=" favoriteLink instarang    text-center ">


                    <h4> <strong>


                            محصولات

                        </strong>






                        (
                        {{ count($products) }}
                        )
                    </h4>
                </a>


                <a href="{{ route('favorite.articles') }}" class=" favoriteLink instarang  text-center   ">

                    <h4> <strong>

                            مقاله ها

                        </strong>

                        (

                        {{ count($Articles) }}

                        )

                    </h4>
                </a>



            </div>
        </div>
    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}
        @include('layouts.home.footer.script')
    @endpush
