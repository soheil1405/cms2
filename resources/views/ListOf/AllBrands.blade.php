<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'AllBrands';

?>



@extends('master')

@section('title', 'برند ها')

@section('description',
    'اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس با ما :
    ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')


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

        {{-- 3 pic --}}
        <div class="container ">
            <div class=" row  " style="overflow: hidden;">

                {{-- categories filter (right side) --}}
                <div class="col-md-2 p-2 col-xs-12 " id="formFilter">
                </div>
    
    
    
                {{-- products part (center of product page) --}}
    
                <div class="col-md-8  col-xs-10">
    
    
    
    
                    <div class="row" style="justify-content: center;">
                        @foreach (App\Models\Brand::where('is_active', 1)->get() as $brand)
                            <a class="bg-white  eachBrand row align-items-end"
                                href="{{ route('showByBrand', ['brand' => $brand->slug]) }}">
    
                                <img class="image-fluid mx-auto" style="max-width: 125px;"
                                    src="{{ url(env('BRAND_ICON_UPLOAD_PATH') . $brand->icon_name) }}" alt="">
    
                                <h6 class="brandCardNAme iransansmedium"> {{ $brand->name }}
    
                                </h6>
                            </a>
                        @endforeach
                    </div>
    
                </div>
    
             
                
                <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />
            </div>
        </div>


        <div class="container brandPaginationContainer">

            @if ($brands->currentPage())
                @include('layouts.home.header.pagination', ['item' => $brands])
            @endif
        </div>



    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}

        @include('layouts.home.footer.script')
    @endpush
