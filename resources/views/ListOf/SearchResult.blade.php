<?php

$_SESSION['page'] = 'search';

?>
@extends('master')



@section('title' , 'نتیایج جستجو')

@push('header_styles')

    @include('layouts.home.header.styles')

@endpush


@push('header_scripts')
    
    <script type="text/javascript">
       // function formSubmit(type) {
         //   var url = {{ url()->full()}}
           // if (type == "brand"){
             //   url = url + "&brands=" + $(".filterBrand").val()
           // }elseif(type == "filterPrice"){
                
           // }

          //  window.location.replace(url);

       // }
    </script>


    @include('layouts.home.header.scripts')
@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush


@push('contents')

    <div class="container pt-mob-search-page">

        @if (isset($product))

        
        <div class="col-md-2 mt-2 mr-2" id="formFilter">
            <div class="p-4 shadow-lg filterFormDiv1">


                <form id="form" action="{{ url()->full()  }}">





                    <h4 onclick="hideOrShowFilterOnMobile()">
                        <i class="bi bi-funnel-fill"></i>
                        فیلترها
                    </h4>

                    <hr>


                    <div class="filterCatDiv" ng-if="category">

                        @if (!isset($selectedCategory))


                            @foreach (\App\Models\Category::where('parent_id', 0)->orderBy('id')->get() as $category)
                                <div class="normalFont filterEachCAt">

                                    <a class="normalFont"
                                        @if (isset($selected_brand)) href="{{ url()->full().'&category='.$category->slug }}" 
                            
                            
                            @else
                            
                            href="{{ url()->full().'&category='.$category->slug }}" @endif>{{ $category->name }}</a>

                                </div>
                            @endforeach
                        @else
                            @if (count($selectedCategory->childrens) > 0)
                                <a @if ($selectedCategory->parent) 
                            
                                    href="{{ url()->full().'&category='.$selectedCategory->parent->slug }}" 
                                    
                                @else href="{{  url()->full().'&category=' }}" @endif
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
                                        href="{{ url()->full().'&category='.$p->slug }}">{{ $p->name }}</a>
                                @endforeach
                            @else
                                <a class="normalFont"
                                    @if ($selectedCategory->parent) href="{{ url()->full().'&category='.$category->slug }}"
                            
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
                                        href="{{ url()->full().'&category='.$category->slug }}">{{ $category->name }}</a>
                                </div>
                            @endforeach
{{--  
                            <hr>
                            <div class="">
                                <input type="checkBox" name="filterImgs" id="JustWithImgsCheckBox" value="JustWithImgs"
                                    onchange="formSubmit('filterImgs')" @if (request()->has('filterImgs')) checked @endif>
                                <label style="cursor:pointer;" class="normalFont" for="JustWithImgsCheckBox">فقط عکسدار
                                    ها</label>
                            </div>

                            <div class="">
                                <input type="checkBox" name="filterPrice" id="JustPriceCheckBox"
                                    value="JustPriceCheckBox"onchange="formSubmit('filterPrice')"
                                    @if (request()->has('filterPrice')) checked @endif>
                                <label class="normalFont" for="JustPriceCheckBox">فقط قیمت
                                    دارها</label>
                            </div>



                            <hr>


                            <h4> برند ها</h4>
                            <hr>



                            <div class="filterBrandDiv">
                                @foreach ($brandsInCat as $brand)
                                    <div ng-if="category d-flex">
                                        <input id="brand" class="filterBrand"  onchange="formSubmit('brand')" type="checkbox"
                                            value="{{ $brand->id }}"
                                            @if (request()->has('brands') && in_array($brand->id, explode('-', request('brands')))) checked 
                                        
                                        
                                        
                                        @elseif(isset($selected_brand) && $brand->id == $selected_brand)
                                        
                                        checked @endif>
                                        <label>{{ $brand->name }}</label>

                                    </div>
                                @endforeach
                            </div>  --}}

                        @endif



                    </div>
                    <hr>



                    {{-- <input type="hidden" name="variations" id="variation-form"> --}}
                    <input type="hidden" name="SortBy" id="SortByHiddenInput">
                    <input type="hidden" name="brands" id="brands_hidden">
                </form>

            </div>
        </div>

        

            <div class=" all row  col-10  ">
                {{-- @for ($i = 0; $i < count($product); $i++)
                    <div class=" border col-12 p-1 card productCard Product-card-style">
                        <a href="{{ route('products.show', ['vendor' => $product[$i]->vendor->name, 'product' => $product[$i]->slug]) }}"
                            class="  productImgDiv card-img" style=" ">
                            <div class="  productImgDiv card-img">
                                <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product[$i]->primary_image) }}"
                                    id="product_img" class="card-img-top"  alt="{{ $product[$i]->name }}">


                            </div>
                            <div class="card-text-container" style="float: right; padding:0 !important;">



                                <h2 class="product_name" class="">
                                    {{ $product[$i]->name }}

                                </h2>


                                <div class="product_detail">

                                    <div class="">
                                        <p class="product_p">

                                            <small class=" pCatName">

                                                {{ $product[$i]->category->name }}

                                            </small>

                                        </p>


                                        <p class="product_p">

                                            <small class=" productBrandName">

                                                {{ $product[$i]->brand->name }}

                                            </small>

                                        </p>


                                    </div>
                                    <div class="btLikeDiv">

                                        @auth
                                            <small class="dissliked" href="#"
                                                onclick="addToFAvorite('p' , {{ $product[$i]->id }} ); window.location.reload();"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                title="افزدون به علاقه مندی ها"
                                                @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product[$i]->id)->get()) >= 1) style="display:none ;" @endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path
                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg>

                                            </small>


                                            <small @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product[$i]->id)->get()) < 1) style="display:none" @endif class="liked"
                                                href="#"
                                                onclick="removeFromFavorite('p',{{ $product[$i]->id }}); window.location.reload();">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                </svg>
                                            </small>

                                        @endauth

                                        <small href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                                            </svg>
                                        </small>

                                        <small onclick="addTocomp({{ $product[$i]->id }})  window.location.reload();"
                                            href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                                            </svg>
                                        </small>
                                    </div>


                                </div>





                                <?php if($product[$i]->product_price !=null ) { ?>
                                <p class="productgheymat">
                                    قیمت
                                    <small class="iransansbold productgheymat" class="text-center texr-danger">
                                        {{ $product[$i]->product_price }}
                                    </small>
                                    تومان
                                </p>
                                <?php } ?>

                            </div>
                            <div class="btn producthowVendor">
                                <span class="btn btn-primary">
                                    مشاهده فروشگاه
                                </span>
                            </div>
                        </a>

                    </div>
                @endfor --}}
                @foreach ($product as $productss)
                        
                <x-productsCard  :product="$productss" />

                @endforeach

            </div>


            <div class="row">

                @if ($product->links())
                      {!! $product->links() !!}
                @endif

            </div>
        @endif





        @if (isset($vendors))
            <div class="col-md-8 col-sm-12 ">



                <div class=" all row p-4 col-12">
                    @for ($i = 0; $i < count($vendors); $i++)
                        <x-vendors  :item="$vendors[$i]" />
                    @endfor
                </div>
        @endif











        @if (isset($brands))
            {{-- product part (center of product page) --}}

            <div class="col-md-8 m-auto col-xs-10">

                <div class="col-lg-12 col-sm-12 ">
                    <div class="row" style="justify-content: center;">
                        @foreach ($brands as $brand)
                            <a class=" card eachBrand" href="{{ route('showByBrand', ['brand' => $brand->slug]) }}">

                                <img class="image-fluid"
                                    src="{{ url(env('BRAND_ICON_UPLOAD_PATH') . $brand->icon_name) }}" alt="">

                                <p class="brandCardNAme"> {{ $brand->name }}

                                </p>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        @endif



    </div>
@endpush

@push('footer_scripts')
    {{-- <div class="container"> --}}

    @include('layouts.home.footer.script')
@endpush
