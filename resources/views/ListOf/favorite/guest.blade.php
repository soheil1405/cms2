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


        <div class="container-fluid  mt-sm-header   ">


            <div class="container ">
                <br>
                <h1 class=" pt-3 pt-md-2 text-center">


                    <p class="h1 pt-md-3 mt-md-3">


                        @if ($typeShow == 'products')
                            محصولات
                        @elseif($typeShow == 'vendors')
                            فروشندگان
                        @elseif($typeShow == 'articles')
                            مقاله های
                        @endif

                        مورد علاقه من
                    </p>
                </h1>
            </div>

            <hr>



            <div class="row ">
                <div class="nav flex-column nav-pills col-md-3 p-md-5 p-2" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button
                        class="nav-link animate__animated animate__fadeInRight
                    
                    @if ($typeShow == 'vendors') active @endif
                    
                    
                    "
                        id="v-pills-vendors-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vendors" type="button"
                        role="tab" aria-controls="v-pills-vendors" aria-selected="true">

                        <a href="{{ route('favorite.vendors') }}" class="    ">


                            <h4 class="favourite-tab"> <strong>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-shop-window" viewBox="0 0 16 16">
                                        <path
                                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    فروشگاه ها

                                </strong>

                                @if (!is_null($vendors))
                                    ({{ count($vendors) }})
                                @else
                                    (0)
                                @endif

                            </h4>

                        </a>

                    </button>
                    <button
                        class="nav-link
                        animate__animated animate__fadeInRight animate__delay product-favourite-delay
                    @if ($typeShow == 'product') active @endif
                    "
                        id="v-pills-products-tab" data-bs-toggle="pill" data-bs-target="#v-pills-products" type="button"
                        role="tab" aria-controls="v-pills-products" aria-selected="false">
                        <a href="{{ route('favorite.products') }}" class=" ">


                            <h4 class="favourite-tab"> <strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-boxes" viewBox="0 0 16 16">
                                        <path
                                            d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
                                    </svg>

                                    محصولات

                                </strong>

                                @if (!is_null($products))
                                    ({{ count($products) }})
                                @else
                                    (0)
                                @endif
                            </h4>
                        </a>
                    </button>



                    <button
                        class="nav-link
                    
                        animate__animated animate__fadeInRight article-favourite-delay 
                    @if ($typeShow == 'articles') active @endif
                    
                    
                    "
                        id="v-pills-articles-tab" data-bs-toggle="pill" data-bs-target="#v-pills-articles" type="button"
                        role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <a href="{{ route('favorite.articles') }}" class="   ">

                            <h4 class="favourite-tab"> <strong>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-layout-text-window" viewBox="0 0 16 16">
                                        <path
                                            d="M3 6.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                                        <path
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v1H1V2a1 1 0 0 1 1-1h12zm1 3v10a1 1 0 0 1-1 1h-2V4h3zm-4 0v11H2a1 1 0 0 1-1-1V4h10z" />
                                    </svg>
                                    مقاله ها

                                </strong>
                                @if (!is_null($articles))
                                    ({{ count($articles) }})
                                @else
                                    (0)
                                @endif

                            </h4>
                        </a>
                    </button>


                </div>
                <div class="tab-content col-md-9" id="v-pills-tabContent">



                    <div class="tab-pane fade show  " id="v-pills-products" role="tabpanel"
                        aria-labelledby="v-pills-products-tab" tabindex="0">


                        <div class="container">
                            @if ($typeShow == 'product' && !is_null($products))
                                {{-- @include('layouts.products', ['item' => $products, 'type' => 'product']) --}}
                                <div class="row">
                                    <div class="col-md-9 row">

                                        @foreach ($products as $product)
                                        @auth
                                        
                                        @if ($product->Product)
                                            
                                        
                                        <x-productsCard :product="$product->Product" />
                                            @else
                                            
                                            @php
                                                $product->delete();    

                                            @endphp
                                            @endif
                                            @endauth

                                            @guest


                                                <x-productsCard :product="$product" />


                                            @endguest
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($typeShow == 'vendors' && !is_null($vendors))
                                {{-- @include('layouts.vendors', ['items' => $vendors, 'type' => 'vendor']) --}}
                                <div class="row ">
                                    <div class="col-md-9">
                                        @foreach ($vendors as $vendor)
                                            @auth


                                                <x-vendors :item="$vendor->vendors" />

                                            @endauth

                                            @guest
                                                <x-vendors :item="$vendor" />


                                            @endguest
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($typeShow == 'articles' && !is_null($articles))
                                {{-- @include('layouts.vendors', ['items' => $vendors, 'type' => 'vendor']) --}}
                                <div class="row  py-4">
                                    <div class="col-md-9 row g-3">

                                        @foreach ($articles as $article)


                                        {{-- @dd($a) --}}

                                        
                                        @auth
                                           @php
                                               
                                           $article = $article->CategoryArticle;
                                             
                                           @endphp
                                        @endauth
                                        
                                        @php
                                        
                                        
                                        $href = route('home.userArticles.show' , ['id'=>$article->slug])
                                        
                                        @endphp
                                        
                                        
                                        
                                            
                                        
                                            <x-articles :article="$article" :href="$href" />

                                            @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>







                </div>
            </div>











        </div>

    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}
        @include('layouts.home.footer.script')
    @endpush
