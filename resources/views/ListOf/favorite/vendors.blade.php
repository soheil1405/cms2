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
        <div class="row col-sm-12  text-center " style="overflow: hidden;">


            <h1>
                فروشندگان مورد علاقه من
            </h1>

            <hr>

            <div class=" col-sm-12 bg-white filterBoxfavorite ">


                <a href="{{ route('favorite.vendors') }}" class="  filterr  ">


                    <h4> <strong>

                            فروشگاه ها

                        </strong>

                        (
                        {{ count($vendors) }}
                        )

                    </h4>

                </a>


                <hr>
                <a href="{{ route('favorite.products') }}" class=" filterr">


                    <h4> <strong>


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



            </div>


            <div class=" all row p-1 col-8 display-property">


                @foreach ($vendors as $vendor)
                    <x-vendors  :item="$vendor->vendor" />
                @endforeach

                {{-- @include('layouts.vendors', ['items' => $vendors, 'type' => 'relationable']) --}}

            </div>


        </div>
    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}
        @include('layouts.home.footer.script')
    @endpush
