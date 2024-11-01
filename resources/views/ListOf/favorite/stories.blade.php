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

            .filterr {



                margin-right: 35px;
                color: black;
                width: 100%;
            }

            .filterBoxfavorite {
                border-radius: 30px;

                box-shadow: 2px 0px 2px 0px black;

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
        @include('ListOf.favorite.filter')

        <div class="col-12  text-center " style="overflow: hidden;">


            <h1>
                محصولات مورد علاقه من
            </h1>


            <a class=" col-2 btn btn-primary filterbt m-3" data-bs-toggle="offcanvas" href="#filterNAv" role="button"
                aria-controls="offcanvasExample" style="display: none;">


                فیلتر ها


            </a>

            <hr>

            <div class=" col-md-2 bg-white filterBoxfavorite ">


                <a href="{{ route('favorite.vendors') }}" class="    ">


                    <h4> <strong>

                            فروشگاه ها

                        </strong>

                        (
                        {{ count($vendors) }}
                        )

                    </h4>

                </a>


                <hr>
                <a href="{{ route('favorite.products') }}" >


                    <h4 class="favourite-tab "> <strong>


                            محصولات

                        </strong>






                        (
                        {{ count($products) }}
                        )
                    </h4>
                </a>
                <hr>

                <a href="{{ route('favorite.articles') }}" class="  filterr ">

                    <h4> <strong>

                            مقاله ها

                        </strong>

                        (

                        {{ count($Articles) }}

                        )

                    </h4>
                </a>

                <hr>

                <a href="{{ route('favorite.stories') }}" class="filterr ">

                    <h4> <strong>

                            استوری ها

                        </strong>


                        (
                        {{ count($stories) }}
                        )

                    </h4>
                </a>


            </div>


            <div class=" all row p-1 col-8">

                به زودی این بخش سایت فعال خواهد شد ...

            </div>


        </div>
    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}
        @include('layouts.home.footer.script')
    @endpush
