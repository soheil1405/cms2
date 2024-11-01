<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Vendors';

?>



@extends('master')

@section('title', 'فروشگاه ها')

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
        {{-- <a href="#" onclick="hideOrShowFilterOnMobile()" class="BtOpenCloseFilte btn btn-primary">جستجوی پیشرفته</a> --}}
    @endpush


    @push('contents')



        @if (request()->has('fId'))
            @include('layouts.home.openstories2')
        @endif



        <div class="container-fluid position-relative">
            <div class="row mt-sm-header  ">
                <div class="d-none d-md-block col-md-2">
                    <div class="position-sticky pe-2" style="top:6px;">
                        <div class=" shadow-lg mt-3" style="background-color: #f9f9f9;border-radius: 15px; padding:0 15px;">
                            <form id="form">
                                <h4 onclick="hideOrShowFilterOnMobile()">
                                </h4>
                                <hr>
                                <form id="form`" style="float:left; " method="GET">
                                    <input type="hidden" name="SortBy" id="SortByHiddenInput">
                                    <label class="filterSortBy iransanslight" style="" for="SortBy">نمایش
                                    </label>
                                    <select style="" onchange="formSubmit()" class="form-select iransanslight "
                                        id="SortBy">
                                        <option class="iransanslight" value="latest" <?php  if(request()->has('SortBy') && \request('SortBy')== 'latest' ) {?> selected
                                            <?php }?>>جدید ترین
                                            ها
                                        </option>
                                        <option class="iransanslight" value="pCount" <?php  if(request()->has('SortBy') && \request('SortBy')== 'pCount' ) {?> selected
                                            <?php }?>>
                                            تعداد محصول
                                        </option>
                                        <option class="iransanslight" value="view" <?php  if(request()->has('SortBy') && \request('SortBy')== 'view' ) {?> selected
                                            <?php }?>>
                                            تعداد بازدید
                                        </option>
                                    </select>
                                </form>
                                <br>
                                <hr>
                                <div>
                                    <a style="color:black;" href="{{ route('Vendors.list') }}"
                                        class="form-check-label iransansmedium" for="filterCategury">
                                        همه دسته ها
                                    </a>
                                    <hr>
                                    <h4 class="iransansmedium h5">زیر دسته ها : </h4>
                                    @foreach (\App\Models\Category::where('parent_id', 0)->get() as $category)
                                        <div class="normalFont" style="display: flex; padding:2px; ">
                                            <a class="iransanslight"
                                                style=" color:black;
                        
                        
                                @if (isset($cat_id) && $cat_id == $category->id) color:red;
                                margin-right:30px; @endif
                        
                                "
                                                href="{{ route('vendors.categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <input type="hidden" name="variations" id="variation-form">
                                <input type="hidden" name="SortBy" id="SortByHiddenInput">
                                <input type="hidden" name="brands" id="brands_hidden">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mx-auto  pt-2 col-xs-10  mt-2" style="">

                    <div class="px-3">


                        @foreach ($vendors as $vendor)
                            <x-vendors :item="$vendor" />
                        @endforeach



                        @if (isset($attributes) && isset($category->Articles->body))
                            <hr>
                            {{-- @Html.Raw({{ $category->Articles->body }} --}}
                            {!! $category->Articles->body !!}
                        @endif


                        @if ($vendors->currentPage())
                            @include('layouts.home.header.pagination', ['item' => $vendors])
                        @endif
                    </div>




                </div>

                <div class="col-md-2 col-12 p-3">
                    <div class="position-sticky" style="top:6px;">
                        <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />
                    </div>
                </div>
            </div>
        </div>

        {{-- 3 pic --}}


        {{-- categories filter (right side) --}}
        <div class="col-md-2 "id="formFilter">
        </div>





    @endpush

    @push('footer_scripts')
        @include('layouts.home.footer.script')
    @endpush
