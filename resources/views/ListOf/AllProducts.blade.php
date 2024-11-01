<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Allproducts';

?>




@extends('master')

@isset($title)
    @section('title', $title)
@else
@section('title', 'محصولات')
@endisset



@section('description',
'دنیای تخصصی بازار صنعت برق، لوستر و روشنایی ایران | تماس با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس
: تهران لاله زارنو کوچه امین زاده پلاک 20')

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
<br>
<a href="#" onclick="hideOrShowFilterOnMobile()" style="position: static;"
class="BtOpenCloseFilte btn  btn-primary">جستجوی پیشرفته</a>

    <div class="container-fluid position-relative">
        @if (\Request::route()->getName() != 'showByBrand')

            <div class="">

                <div class="TopBarOfProductsPage  p-2" style="display: flex; width:100%; justify-content: space-between;">


                    <div class="" style="font-size: 14px;">

                        <a class="normalFont" href="{{ route('products.index') }}">

                            محصولات</a>



                        @if (isset($selectedCategory))

                            @if ($selectedCategory->parent)
                                @if ($selectedCategory->parent->parent)
                                    <a class="normalFont"
                                        href="{{ route('categories.show', ['category' => $selectedCategory->parent->parent->slug]) }}">

                                        <small>


                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-slash" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z" />
                                            </svg>

                                        </small>


                                        {{ $selectedCategory->parent->parent->name }}</a>
                                @endif



                                <a class="normalFont"
                                    href="{{ route('categories.show', ['category' => $selectedCategory->parent->slug]) }}">

                                    <small>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-slash" viewBox="0 0 16 16">
                                            <path
                                                d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg>

                                    </small>


                                    {{ $selectedCategory->parent->name }}</a>



                                <a class="normalFont"
                                    href="{{ route('categories.show', ['category' => $selectedCategory->slug]) }}">

                                    <small>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-slash" viewBox="0 0 16 16">
                                            <path
                                                d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg>

                                    </small>


                                    {{ $selectedCategory->name }}</a>
                            @else
                                <a class="normalFont"
                                    href="{{ route('categories.show', ['category' => $selectedCategory->slug]) }}">


                                    <small>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-slash" viewBox="0 0 16 16">
                                            <path
                                                d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg>

                                    </small>
                                    {{ $selectedCategory->name }}</a>


                            @endif

                        @endif
                    </div>



                </div>
            </div>

        @endif
        <div class="row">



            @if (\Request::route()->getName() != 'showByBrand')
                <div class="col-xs-12 col-md-2 mt-2 mr-2" id="formFilter">
                    <div class="position-sticky" style="top:5px;">
                        <div class="p-4 shadow-lg filterFormDiv1">


                            <div class="">
                                <h6>مرتب سازی بر اساس : </h6>
                                <form id="form" action="{{ getCurrentRouteForFilterInProductPage() }}" style=" ">
                                    <select style="font-size:13px;" onchange="formSubmit()" name="SortBy"
                                        class=" normalFont   costom-select form-select  " id="SortBy">
                                        <option value="latest" <?php  if(request()->has('SortBy') && \request('SortBy')== 'latest' ) {?> selected <?php }?>>جدید ترین
                                            ها
                                        </option>
                                        <option value="oldest" <?php  if(request()->has('SortBy') && \request('SortBy')== 'oldest' ) {?> selected <?php }?>>قدیمی ترین
                                            ها
                                        </option>
                                        <option value="Inexpensive" <?php  if(request()->has('SortBy') && \request('SortBy')== 'Inexpensive' ) {?> selected <?php }?>> ارزان
                                            ترین
                                            ها </option>
                                        <option value="Expensive" <?php  if(request()->has('SortBy') && \request('SortBy')== 'Expensive' ) {?> selected <?php }?>> گران
                                            ترین
                                            ها
                                        </option>
                                        <option value="view" <?php  if(request()->has('SortBy') && \request('SortBy')== 'view' ) {?> selected <?php }?>> بیشترین
                                            بازدید
                                            ها</option>

                                        <option value="MostRates" <?php  if(request()->has('SortBy') && \request('SortBy')== 'MostRates' ) {?> selected <?php }?>>
                                            بیشترین
                                            امتیاز ها
                                            ها</option>
                                    </select>
                                    <hr>
                                    <div class="">
                                        <input type="checkBox" name="filterImgs" id="JustWithImgsCheckBox"
                                            value="JustWithImgs" onchange="formSubmit()"
                                            @if (request()->has('filterImgs')) checked @endif>
                                        <label style="cursor:pointer;" class="normalFont" for="JustWithImgsCheckBox">فقط
                                            عکسدار
                                            ها</label>
                                    </div>

                                    <div class="">
                                        <input type="checkBox" name="filterPrice" id="JustPriceCheckBox"
                                            value="JustPriceCheckBox"onchange="formSubmit()"
                                            @if (request()->has('filterPrice')) checked @endif>
                                        <label class="normalFont" for="JustPriceCheckBox">فقط قیمت
                                            دارها</label>
                                    </div>

                                </form>
                            </div>
                            <hr>




                            <div class="filterCatDiv" ng-if="category">

                                <h4 onclick="hideOrShowFilterOnMobile()">
                                    <i class="bi bi-funnel-fill"></i>
                                    فیلترها
                                </h4>
                                @if (!isset($selectedCategory))




                                    <div>
                                        <a href="{{ route('products.index') }}" class="form-check-label filterhead"
                                            for="filterCategury">
                                            همه دسته ها
                                        </a>
                                        <br>
                                        <hr>
                                    </div>
                                    @foreach (\App\Models\Category::where('parent_id', 0)->orderBy('id')->get() as $category)
                                        <div class="normalFont filterEachCAt">

                                            <a class="normalFont"
                                                @if (isset($selected_brand)) href="{{ route('categories.show', ['category' => $category->slug, 'brands' => $selected_brand]) }}" 
                                    
                                    
                                    @else
                                    
                                    href="{{ route('categories.show', ['category' => $category->slug]) }}" @endif>{{ $category->name }}</a>

                                        </div>
                                    @endforeach
                                @else
                                    @if (count($selectedCategory->childrens) > 0)
                                        <a @if ($selectedCategory->parent) @if (isset($selected_brand))
    
                                            href="{{ route('categories.show', ['category' => $selectedCategory->parent->slug, 'brands' => $selected_brand]) }}" 
                                            
                                    
                                    @else
                                    
                                    href="{{ route('categories.show', ['category' => $selectedCategory->parent->slug]) }}" @endif
                                        @else href="{{ route('products.index') }}" @endif
                                            class="Filtercatparent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                            </svg>

                                            {{ $selectedCategory->name }}


                                        </a>

                                        @foreach ($selectedCategory->childrens as $p)
                                            <a class="normalFont filterCatchild"
                                                href="{{ route('categories.show', ['category' => $p->slug]) }}">{{ $p->name }}</a>
                                        @endforeach
                                    @else
                                        <a class="normalFont"
                                            @if ($selectedCategory->parent) href="{{ route('categories.show', ['category' => $selectedCategory->parent->slug]) }}"
                                    
                                    @else
                                    href="{{ route('Products.index') }}" @endif
                                            class="Filtercatparent">




                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                            </svg>



                                            <span class="normalFont"> {{ $selectedCategory->name }}
                                            </span>


                                        </a>
                                    @endif

                                    @foreach (\App\Models\Category::where('parent_id', request('id'))->get() as $category)
                                        <div class="normalFont filterEachCAt">
                                            <a class="normalFont "
                                                href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                        </div>
                                    @endforeach

                                    <hr>


                                    <h4> برند ها</h4>
                                    <hr>



                                    <div class="filterBrandDiv">
                                        @foreach ($brands as $brand)
                                            <div ng-if="category d-flex">
                                                <input id="brand" onchange="formSubmit()" type="checkbox"
                                                    value="{{ $brand->id }}"
                                                    @if (request()->has('brands') && in_array($brand->id, explode('-', request('brands')))) checked 
                                                
                                                
                                                
                                                @elseif(isset($selected_brand) && $brand->id == $selected_brand)
                                                
                                                checked @endif>
                                                <label>{{ $brand->name }}</label>

                                            </div>
                                        @endforeach
                                    </div>

                                @endif



                            </div>
                            <hr>



                            {{-- <input type="hidden" name="variations" id="variation-form"> --}}
                            <input type="hidden" name="SortBy" id="SortByHiddenInput">
                            <input type="hidden" name="brands" id="brands_hidden">

                        </div>
                    </div>
                </div>
            @endif


            <div class="col-xs-12 col-md-8 mt-2 row">
                @if (isset($selectedCategory))





                    @if (isset($buyGuid))

                        <div class="col-12">

                            <a href="{{ route('home.BuyProductGuid.show', ['id' => $buyGuid->id]) }}"
                                class=" col-md-4 mt-2">

                                {{ $buyGuid->title }}

                            </a>
                        </div>

                    @endif


                @endif
                <div class="row">




                    @foreach ($products as $product)
                        <x-productsCard :product="$product" />
                    @endforeach

                    {{-- @include('layouts.products', ['item' => $products, 'type' => 'product']) --}}
                </div>


                @if (isset($selectedCategory))



                    <div class="col-12">
                        {!! $selectedCategory->description !!}
                    </div>
                @endif

            </div>



            <div class="col-md-2 col-12">
                <div class="position-sticky" style="top:6px;">
                    <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />
                </div>
            </div>





        </div>

        @if (isset($category))



        @endif

        <div class="col-12">

            @if ($products->currentPage())

                @include('layouts.home.header.pagination', ['item' => $products])

            @endif

        </div>
    </div>

    <input type="hidden" name="SortBy" id="SortByHiddenInput">
    <input type="hidden" name="brands" id="brands_hidden">



@endpush

@push('footer_scripts')
    @include('layouts.home.footer.script')
@endpush
