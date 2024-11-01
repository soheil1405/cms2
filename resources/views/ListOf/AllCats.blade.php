<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Articles';

?>

<style>
    li {
        margin-right: 10%;
    }

    .level-1>.active {
        margin-left: -10px;
        margin-right: 10px;
        transition: .5s;
    }

    .accordion-button::after {
        margin-left: 0 !important;
    }

    .font-cat {
        font-size: 12px !important;
        line-height: 1.5rem;
    }

    .cat-color {
        line-height: 1.5rem;
    }

    .nav-link {
        color: rgb(32, 32, 32) !important;
    }

    .nav-link.active {
        color: #fff !important;
    }

    .pos-button {
       
        position: sticky;
        /* margin-top: 98px; */
    }
</style>

@extends('master')

@section('title', 'دسته بندی ها')


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


        <a href="#" onclick="hideOrShowFilterOnMobile()" class="BtOpenCloseFilte btn pos-button  btn-primary">جستجوی
            پیشرفته</a>
    @endpush

    @push('contents')

        {{-- <div style="opacity: 0;margin-bottom:-10px;" class="bg-white">
            s
        </div> --}}


        <div class="container bg-white p-3 pt-5">
            <div class="row bg-white iransansmedium">
                <div class="nav col-4 flex-column nav-pills  level-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach ($categories as $category)
                        <div class="nav-link border text-center p-1" id="v-pills-{{ $category->id }}-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-{{ $category->id }}" type="button" role="tab"
                            aria-controls="v-pills-home" aria-selected="true">
                            <img style="width:30px;" src="{{ url(env('CATEGORY_ICON_UPLOAD_PATH') . $category->icon) }}">


                            <h6 class="d-block mt-2 font-cat cat-color">
                                {{ $category->name }}

                            </h6>




                        </div>
                    @endforeach

                </div>
                <div class="tab-content col-8" id="v-pills-tabContent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade " id="v-pills-{{ $category->id }}" role="tabpanel"
                            aria-labelledby="v-pills-{{ $category->id }}-tab" tabindex="0">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                {{-- level 2 show  --}}
                                @foreach ($category->childrens as $cat2)
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne" style="direction: rtl">
                                                <button class="accordion-button text-end collapsed font-cat" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $cat2->id }}"
                                                    aria-expanded="true" aria-controls="collapse{{ $cat2->id }}">
                                                    <a href="{{ route('categories.show', [$cat2->slug]) }}">

                                                    <strong> {{ $cat2->name }}</strong>
                                                    </a>

                                                </button>
                                            </h2>
                                            @foreach ($cat2->childrens as $cat3)
                                                <div id="collapse{{ $cat2->id }}" class="accordion-collapse collapse "
                                                    aria-labelledby="heading{{ $cat2->id }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body p-2 font-cat">
                                                        <a href="{{ route('categories.show', [$cat3->slug]) }}">

                                                            {{ $cat3->name }}
                                                        </a>


                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    {{-- <div class="nav-link border text-center" id="v-pills-{{ $cat2->id }}-tab"
                                        data-bs-toggle="pill" data-bs-target="#v-pills-{{ $cat2->id }}" type="button"
                                        role="tab" aria-controls="v-pills-{{ $cat2->id }}" aria-selected="true">



                                    </div> --}}
                                @endforeach
                            </div>
                            {{-- level 3 show --}}
                            {{-- <div class="tab-content" id="v-pills-tabContent">
                                @foreach ($category->childrens as $cat2)
                                    <div class="tab-pane fade  " id="v-pills-{{ $cat2->id }}" role="tabpanel"
                                        aria-labelledby="v-pills-{{ $cat2->id }}-tab" tabindex="0">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">

                                            @foreach ($cat2->childrens as $cat3)
                                                <div class="text-secondary text-center" id="v-pills-{{ $cat2->id }}-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-{{ $cat2->id }}"
                                                    type="button" role="tab" aria-controls="v-pills-{{ $cat2->id }}"
                                                    aria-selected="true">

                                                    <h6>
                                                        {{ $cat3->name }}
                                                    </h6>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div> --}}
                        </div>
                    @endforeach



                </div>

            </div>
        </div>


        {{-- <ul>

            @foreach ($categories as $category)
                <li>
                    <a class="normalFont"
                        href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a>

                    <ul>

                        @foreach ($category->childrens as $fistCatChild)
                            <li>


                                <a class="normalFont"
                                    href="{{ route('categories.show', ['category' => $fistCatChild->slug]) }}">{{ $fistCatChild->name }}</a>

                                @if (count($fistCatChild->childrens) > 0)
                                    <ul>

                                        @foreach ($fistCatChild->childrens as $secondChild)
                                            <li>


                                                <a class="normalFont"
                                                    href="{{ route('categories.show', ['category' => $secondChild->slug]) }}">{{ $secondChild->name }}</a>

                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <ul>

                                </ul>

                            </li>
                        @endforeach

                    </ul>


                </li>





                <hr>
            @endforeach
        </ul> --}}





    @endpush
