<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'favorite';

?>



@extends('master')

@section('title', 'علاقه مندی ها')

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


        @include('ListOf.favorite.filter')

        <div class="container">
            <div class="col-12  text-center " style="overflow: hidden;">


                <h1>
                    مقاله های مورد علاقه من
                </h1>

                <a class="  btn btn-primary filterbt m-3 d-none" data-bs-toggle="offcanvas" href="#filterNAv" role="button"
                    aria-controls="offcanvasExample">


                    فیلتر ها


                </a>

                <hr>

                <div class="  col-sm-12 bg-white filterBoxfavorite ">


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

                            {{ count($articles) }}

                            )

                        </h4>
                    </a>

                </div>


                <div class=" all row p-1 col-8">


                    @foreach ($articles as $a)
                        <x-articles a="$a" />
                    @endforeach

                </div>


            </div>
        </div>

    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}
        @include('layouts.home.footer.script')
    @endpush
