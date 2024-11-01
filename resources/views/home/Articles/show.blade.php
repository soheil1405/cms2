<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Articles';

?>



@extends('master')

@section('title', $article->title)

@section('description',  $article->body )

@push('header_styles')
    @include('layouts.home.header.styles')





@endpush




@push('headers')
    @include('layouts.home.header.head')
    @include('layouts.home.header.scripts')
@endpush


@push('contents')
    {{-- <div class="row col-12 bg-white">
        <div class="vazirFont ArtcleMainDiv col-lg-8 col-sm-12">

            <div  class="sharesss">



                @auth
                    <a class="disslikedArticle" href="#" onclick="addToFAvorite('c' , {{ $article->id }} )"
                        @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $article->id)->get(),
    ) >= 1) style="display:none" @endif>
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                            class="bi bi-heart " viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>

                    </a>


                    <a @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $article->id)->get(),
    ) < 1) style="display:none" @endif class="likedArticle" href="#"
                        onclick="removeFromFavorite('c',{{ $article->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="red"
                            class="bi bi-heart-fill " viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg>
                    </a>

                @endauth










                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                        class="bi bi-share-fill " viewBox="0 0 16 16">
                        <path
                            d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                    </svg>
                </a>

            </div>

            <div class="">
                <h1  class="text-center p-2">


                    عنوان مقاله :{{ $article->title }}


                </h1>
            </div>

            <small>تاریخ انتشار مقاله:</small>
            {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($article->updated_at)) }}

            <hr>



            {!! $article->body !!}

        </div>

        <div class="col-lg-4 bg-reg">


            <div class="row">
                <div class="col-sm-12 my-3">
                    <a href="">
                        <img src="{{ asset('main/images/majale/1.jpg') }}" alt="" class="brd25 img-fluid">
                    </a>
                </div>
                <div class="col-sm-12 my-3">
                    <a href="">
                        <img src="{{ asset('main/images/majale/2.jpg') }}" alt="" class="brd25 img-fluid">
                    </a>
                </div>
                <div class="col-sm-12  my-3">
                    <a href="{{ route('HomeArticles') }}">

                        <img src="{{ asset('main/images/majale/3.jpg') }}" alt="" class="brd25 img-fluid">
                    </a>
                </div>
                <div class="col-sm-12  my-3">
                    <a href="">

                        <img src="{{ asset('main/images/majale/4.jpg') }}" alt="" class="brd25 img-fluid">
                    </a>




                </div>

                <hr>

                <h3 class="text-center">

                    جدید ترین مقاله ها
                </h3>

                <hr>
                @foreach ($more_articles as $item)
                    <div onclick="location.href= {{ route('HomeArticle.show', ['article' => $item->slug]) }} "
                        style="cursor: pointer;border-radius: 15px;margin-bottom:3%;padding-right:10px;width:100%;height:130px;background-color: rgb(240, 237, 237); box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">


                        <div class="ArticlesDiv3">

                            <div style="width: 10%" class="">
                                @if ($item->main_img)
                                    <img src="{{ asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $item->main_img) }} "
                                        alt="" />
                                @endif

                            </div>





                            <div 
                                class="">


                                <a href="{{ route('HomeArticle.show', ['article' => $item->slug]) }}"
                                   class="ArticleItemTitle" >
                                    {{ $item->title }}
                                </a>

                                <small> <?php echo substr($item->pre_show, 0, 200) . '...'; ?> </small>

                                <div class="">
                                    <small>تاریخ انتشار مقاله:</small>
                                    {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($item->updated_at)) }}
                                </div>


                            </div>



                            <div class="provider">


                            </div>

                            <div id="Address"  class="vendorBoxItem">

                                <a class="btn btn-outline-primary m-3 btShowArticle"
                                    href="{{ route('HomeArticle.show', ['article' => $item->slug]) }}">
                                    مشاهده
                                    مقاله</a>

                            </div>

                        </div>


                    </div>
                @endforeach






            </div>

        </div>


    </div> --}}




    


    <div class="container">
        <div class="row ">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="articel">

                    <div class="title-list  text-center  my-2 background-title-articels title-color py-3">

                        <h1 style="font-family:'dastnevis' !important;"> عنوان مقاله :{{ $article->title }}
                        </h1>

                    </div>
                    <div class=" col-md-4 articel-img-title pb-3">
                        <div class=" Articles-card rounded  text-center">
                            <img class="img-fluid"
                                src="{{ asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $article->main_img) }} " alt="{{ $article->title }}">


                        </div>
                    </div>
                    <div class="content-articel ">

                        <a title="اشتراک گذاری" onclick="copyToClipboard()">
                            <img width="30" height="30"
                                src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                                alt="external-send-email-flatart-icons-outline-flatarticons" />
                        </a>


                        {{-- @dd(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->latest()->first()->delete()) --}}
                        
                        @auth
                        <a class="disslikedArticle
                        
                        
                        
                        addToFAvorite_{{$article->id}}
                        " href="#" title="افزودن به علاقه مندی"
                            onclick="addToFAvorite('c' , {{ $article->id }} ) "
                            @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $article->id)->get()) >= 1) style="display:none" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" style="color: #000;" class="bi bi-heart"
                                viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </a>

                        <span @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $article->id)->get()) < 1) style="display:none" @endif 


                            class="likedArticle
                            
                            
                            removeFromFavorite{{$article->id}}
                        
                            "
                            onclick="removeFromFavorite('c',{{ $article->id }})"
                            title="حذف از علاقه مندی ها">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                class="bi bi-heart-fill" style="color: #000;" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </span>



                    @endauth

                    @guest

                        <?php
                        $counter = null;
                        
                        if (Session::has('favorite_c')) {
                            $Articlefavorited = Session::get('favorite_c');

                            foreach ($Articlefavorited as $item) {
                                if ($item['id'] == $article->id) {
                                    $counter = true;
                                }
                            }
                        }
                        
                        ?>






                        <small
                                    
                        @if ($counter) style="display:block;" @else style="display:none;" @endif
                        
                        
                        
                        class="liked removeFromFavorite{{$article->id}}" title="حذف از علاقه مندی ها"
                            onclick="removeFromFavorite('c',{{ $article->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="red" class="bi bi-heart-fill Seticonsinglearticle"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                    </small>
                    
                    <small title="افزودن به علاقه مندی ها" 
                        @if ($counter) style="display:none;"@else style="display:block;" @endif

                        class="dissliked addToFAvorite_{{$article->id}}"


                            onclick="addToFAvorite('c' , {{$article->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" style="color: #000;"
                                class="bi bi-heart Seticonsinglearticle" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                    </small>

                        

                    @endguest



                        <div class="">
                            <small>تاریخ انتشار مقاله:</small>
                            {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($article->created_at)) }}
                        </div>


                        <p style="text-align: justify;">

                            {!! $article->body !!}


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
                                    {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($item->created_at)) }}
                                </div>
    
    
    
                                <a class="btn btn-outline-primary m-3 btShowArticle"
                                    href="{{ route('home.HomeArticle.show', ['article' => $item->slug]) }}">
                                    مشاهده
                                    مقاله</a>
    
    
                            </div>


                        </div>
                    @endforeach
                </div>

                <div class="mt-3 ">
                    <div class=" text-center pb-4 mb-2 background-title-articels title-color">
                        <h5 style="font-family:'dastnevis' !important;">فروشگاههای برتر</h5>

                    </div>
                    <div class=" Articles-card rounded  text-center custome-box-shadow">
                        {{-- <img class="img-effect-Articles" src="{{ asset('images/2.jpg') }}" alt="Jane"> --}}
                       
                        @foreach ($specialVendors as $item)
                        {{-- @foreach ($i as $item) --}}
                        <div class=" m-3">
                            <a href="{{ route('vendor.home', ['vendor' => $item->vendor->name]) }}">
                                <img src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->vendor->avatar) }}"
                                    class="card-img-top round" alt="...">
                            </a>

                            <div class="card-body card-body-h">
                                <h5 class=" iransanslight py-4 normalFont card-title">
                                    {{ $item->vendor->title }}
                                </h5>
                                <p class="card-text pb-3 iransanslight normalFont" style="font-size: px;">
                                    {{-- {{ $item->description }} --}}
                                    {!! \Illuminate\Support\Str::limit(strip_tags($item->vendor->description), 20) !!}
                                </p>

                            </div>
                            <div class="card-footer">
                                <a href="{{ route('vendor.home', ['vendor' => $item->vendor->name]) }}"
                                    class="btn btn-primary w-100" style="font-size: 20px;">
                                    مشاهده فروشگاه
                                </a>
                            </div>
                        </div>

                        {{-- @endforeach --}}
                    @endforeach

                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-12 text-center  background-title-articels-pruducts title-color mt-3">
                <h3 class="p-3" style="font-family:'dastnevis' !important; position:absolute ;"> جایگاه محصولات ویژه</h3>
                {{-- <div class="owl-carousel loop-vendor   ">




                    @include('layouts.products' , ['item'=>$speciallProducts , 'type'=>'favorite'])





                </div> --}}


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
