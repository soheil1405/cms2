<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Articles';

?>



@extends('master')

@section('title', $userArticles->name)

@section('description', $userArticles->discreption)





@push('header_styles')
    @include('layouts.home.header.styles')
@endpush




@push('headers')
    @include('layouts.home.header.head')
    @include('layouts.home.header.scripts')
@endpush


@push('contents')
 
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="articel">

                    <div class="title-list articel-title-style text-center  mb-2 background-title-articels title-color">

                        <h3 style="font-family:'dastnevis' !important;"> عنوان مقاله :{{ $userArticles->name }}
                        </h3>

                    </div>



                    




                    <div class="content-articel ">


                        <div class="">
                            <small>تاریخ انتشار مقاله:</small>
                            {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($userArticles->created_at)) }}
                        </div>
                        <hr>

                        <div class="">
                            <a
                            
                            href="{{ route('vendor.home', ['vendor' => $userArticles->vendor->name]) }}"

                            
                            >منتشر شده توسط فروشگاه  : {{$userArticles->vendor->title}}</a>
                            
                        </div>

                        <p style="text-align: justify;">
                            {!! $userArticles->body !!}
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="title-box-articel mt-3">
                    <div class="title-list text-center pb-4 mb-2 background-title-articels title-color">
                        <h5 style="font-family:'dastnevis' !important;">جدید ترین مقالات </h5>
                    </div>
                    {{-- <div class="article-list text-center ">
                        <h6>جدید ترین مقالات </h6>
                    </div> --}}


{{-- 
                    @foreach ($more_articles as $item)
                        <div class="text-center row ">


                            <div class="">
                                @if ($item->main_img)
                                    <img src="{{ asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $item->main_img) }} "
                                        alt="" />
                                @endif








                                <a href="{{ route('home.HomeArticle.show', ['article' => $item->slug]) }}">
                                    {{ $item->title }}
                                </a>


                            </div>

                            <div class="">
                                <div class="">
                                    <small>تاریخ انتشار مقاله:</small>
                                    {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($item->updated_at)) }}
                                </div>
    
    
    
                                <a class="btn btn-outline-primary m-3 btShowArticle"
                                    href="{{ route('home.HomeArticle.show', ['article' => $item->slug]) }}">
                                    مشاهده
                                    مقاله</a>
    
    
                            </div>


                        </div>
                    @endforeach --}}
                </div>

                <div class="mt-3 ">
                    <div class=" text-center pb-4 mb-2 background-title-articels title-color">
                        <h5 style="font-family:'dastnevis' !important;">فروشگاههای برتر</h5>

                    </div>
                    <div class=" Articles-card rounded  text-center custome-box-shadow">
                        <img class="img-effect-Articles" src="{{ asset('images/2.jpg') }}" alt="Jane">


                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-12 text-center  background-title-articels-pruducts title-color mt-3">
                <h3 class="p-3" style="font-family:'dastnevis' !important;"> جایگاه محصولات ویژه</h3>
            </div>

        </div>
        <div class="row">
            <div class="titile-articel text-center mt-3
            ">
                <h3 style="font-family:'dastnevis' !important;">مجله اینستابرق</h3>

            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12  my-3">
                <a href="">
                    <img src="{{ asset('main/images/majale/1.jpg') }}" alt="" class="brd25 img-fluid">
                </a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12  my-3">
                <a href="">
                    <img src="{{ asset('main/images/majale/2.jpg') }}" alt="" class="brd25 img-fluid">
                </a>
            </div>
            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12    my-3">
                <a href="{{ route('home.HomeArticles') }}">

                    <img src="{{ asset('main/images/majale/3.jpg') }}" alt="" class="brd25 img-fluid">
                </a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12   my-3">
                <a href="">

                    <img src="{{ asset('main/images/majale/4.jpg') }}" alt="" class="brd25 img-fluid">
                </a>




            </div>
        </div>
    </div>

    <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />

@endpush

@push('footer_scripts')
    @include('layouts.home.footer.script')
@endpush
