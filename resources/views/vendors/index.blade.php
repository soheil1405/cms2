@extends('vendors.layouts.master')

@section('title', $vendor->title)


@section('metaTitle')
    {{ $vendor->ttile }}
@endsection






@section('description')
    {{ $metaDescription }}
@endsection

@section('image')
    {{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}
@endsection


@section('alt')
    {{ $vendor->name }}
@endsection



@push('header_styles')
    @include('layouts.home.header.styles')
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')

    @if (isset($vendorrr) && !is_null($vendorrr))
        @include('user.vendor.story.openstories2')
    @endif



    <link rel="stylesheet" type="text/css" href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL">
    </script>
    <script type="text/javascript" src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush




@push('contents')


    @if (request()->has('fId'))
        @include('layouts.home.openstories2')
    @endif


    <div class="container-fluid bg-white p-2">


        {{-- قسمت اطلاعات فروشگاه دسکتاپ  --}}
        <div class="container vendor-display-desk">
            <div class="row">

                @if ($vendor->cover != 'default-cover.jpg')
                    <div class="cover-vendor-div  d-none d-sm-block">
                        <img src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $vendor->cover) }}" class=" "
                            alt="Responsive image">
                    </div>
                @endif
                <div class="col-md-4">
                    <div class=" text-center  @if ($vendor->cover != 'default-cover.jpg') avater-vendor-page @endif">
                        <a
                            @if ($vendor->hasActiveStory($vendor->id) == 1) href='{{ route('vendor.home', ['vendor' => $vendor->name, 'lastOne' => $vendor->id, 'urlback' => url()->full(), 'fId' => $vendor->id]) }}' @endif>
                            <img @if ($vendor->hasActiveStory($vendor->id) == 1) style="border:2px solid Red;
                            
                            

                            @if (seenedBeforStory($vendor->id))
                                background:none;border:1px solid #000; @endif "
                                                                                    


                                                                                                  
                                @endif
                            src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}"
                            class="vendorFigImg figure-img img-thumbnail rounded-circle "></a>
                        <div>
                            <h1 class=" VendorTitle  dastnevis text-center">

                                {{ $vendor->title }}

                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-10 m-auto p-3">



                    <figure class="vendorFig" class="  figure">
                        {{-- نام فروشگاه  --}}

                        <div>








                            @auth

                                @if (Auth::user()->id == $vendor->user->id)
                                    <div class="col-md-4 my-1 my-store-button">


                                        <a class="vendordissliked btn btn-primary"
                                            href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}">


                                            ویرایش فروشگاه من

                                        </a>



                                    </div>
                                @else
                                    {{-- فالو انفالو   --}}
                                    <div class="col-md-12 ">




                                        <div class="row " style="align-items: center;">



                                            <span onclick="follow({{ $vendor->id }})"
                                                @if ($followingStatus) style="display : none" @endif
                                                id="followBt_{{ $vendor->id }}"
                                                class="btn btn-outline-primary m-1
                                        
                                        
                                        
                                        ">دنبال
                                                کردن </span>
                                            <span @if (!$followingStatus) style="display : none" @endif
                                                id="unfollowBt_{{ $vendor->id }}" onclick="unfollow({{ $vendor->id }})"
                                                class="btn 
                                        
                                        
                                        
                                        btn-primary iransansmedium m-1 ">

                                                دنبال نکردن
                                            </span>





                                        </div>





                                    </div>
                                @endif

                            @endauth




                        </div>


                        <div>
                            <div class="" style="margin-left:20px;">
                                <div class="float-left d-inline-block toolbarproduct">

                                    {{-- share   --}}
                                    <a href="#comments" title="دیدگاه ها" style="color:#000;">
                                        <svg width="30" height="30" style="" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="var(--ci-primary-color, currentColor)"
                                                d="M496,496H480a273.39,273.39,0,0,1-179.025-66.782l-16.827-14.584C274.814,415.542,265.376,416,256,416c-63.527,0-123.385-20.431-168.548-57.529C41.375,320.623,16,270.025,16,216S41.375,111.377,87.452,73.529C132.615,36.431,192.473,16,256,16S379.385,36.431,424.548,73.529C470.625,111.377,496,161.975,496,216a171.161,171.161,0,0,1-21.077,82.151,201.505,201.505,0,0,1-47.065,57.537,285.22,285.22,0,0,0,63.455,97L496,457.373ZM294.456,381.222l27.477,23.814a241.379,241.379,0,0,0,135,57.86,317.5,317.5,0,0,1-62.617-105.583v0l-4.395-12.463,9.209-7.068C440.963,305.678,464,262.429,464,216c0-92.636-93.309-168-208-168S48,123.364,48,216s93.309,168,208,168a259.114,259.114,0,0,0,31.4-1.913Z"
                                                class="ci-primary" />
                                        </svg>
                                    </a>

                                    <a title="اشتراک گذاری" class="  w-100 m-1 h5 iransansmedium"
                                        onclick="copyToClipboard('v',{{ $vendor->id }})">
                                        <img width="30" height="30"
                                            src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                                            alt="external-send-email-flatart-icons-outline-flatarticons" />

                                    </a>
                                </div>


                                {{-- برای لایک  --}}



                                @auth
                                    <span
                                        class="vendordissliked
                                
                                
                                addToFAvorite_{{ $vendor->id }} 
                                p-0 heart-icon-style"
                                        title="افزودن به علاقه مندی ها" onclick="addToFAvorite('v' , {{ $vendor->id }} ) ; "
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $vendor->id)->get()) >= 1) style="display:none" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </span>


                                    <span @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $vendor->id)->get()) < 1) style="display:none" @endif
                                        class="vendorliked  
                                    removeFromFavorite{{ $vendor->id }}
                                    
                                    
                                    p-0"
                                        title="حذف از علاقه مندی ها" onclick="removeFromFavorite('v',{{ $vendor->id }});  ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                                            class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </span>



                                @endauth



                                @guest


                                    <?php
                                    $counter = null;
                                    
                                    if (Session::has('favorite_v')) {
                                        $Pfavorited = Session::get('favorite_v');
                                        foreach ($Pfavorited as $itemm) {
                                            if ($itemm['id'] == $vendor->id) {
                                                $counter = true;
                                            }
                                        }
                                    }
                                    
                                    ?>





                                    <span @if (!$counter) style="display: none" @endif
                                        class="            removeFromFavorite{{ $vendor->id }}  p-0"
                                        title="حذف از علاقه مندی ها" onclick="removeFromFavorite('v',{{ $vendor->id }});  ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                                            class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </span>

                                    <span @if ($counter) style="display: none;" @endif
                                        class=" addToFAvorite_{{ $vendor->id }}  p-0" title="افزودن به علاقه مندی ها"
                                        onclick="addToFAvorite('v' , {{ $vendor->id }} )">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </span>



                                @endguest



                            </div>

                        </div>


                        <div style="display: flex;justify-content-center;">





                            {{-- count product  --}}
                            <div class="" style="margin-right: 20px;" title="تعداد محصولات">
                                <img class="img-fluid" width="30" height="30"
                                    src="{{ asset('main/tool/3114633.png') }}" alt="">
                                <p class="iransansmedium text-center h5 mt-3">{{ $vendor->product_count }} </p>
                            </div>

                            {{-- count view  --}}

                            <div class="" style="margin-right: 20px;" title="تعداد بازدیدها">
                                {{-- <span class="iransansmedium text-center h5">تعداد بازدید : </span> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                <p class="iransansmedium text-center h5 mt-3">{{ $vendor->view_count }} </p>
                            </div>



                        </div>

                        <div>
                            <div class="vendorBoxItem  d-inline-block w-auto">

                                {{-- <span class="title-store-style d-block">امتیاز شما به این فروشگاه </span> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                                    class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />

                                </svg>

                                <strong class="h6 iransanslight">
                                    {{ $vendor->rate_Ave }}
                                    از 5

                                    (تعداد :
                                    {{ $vendor->rate_count }}
                                    امتیاز
                                    )
                                </strong>


                                {{-- @auth
                                @if (Auth::user()->id != $vendor->user->id) --}}
                                <form id="RateVendorForm" action="{{ route('ratevendor') }}" class=" "
                                    method="post">
                                    @csrf

                                    @if (!Session::has('Session_rated_list'))
                                        <span class="h6 iransanslight" style="margin-top:6px;">
                                            امتیاز شما :</span>
                                    @endif

                                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                    @include('layouts.home.Rate')





                                </form>
                                {{-- @endif
                            @endauth --}}

                            </div>








                            <div class="alert alert-success alertVEndorRate m-3" style="height: 60px; display:none;">

                                <strong> امتیاز شما به فروشگاه ثبت شد . باتشکر </strong>

                            </div>

                        </div>





                </div>
                <div class="container ">
                    <div class="caption-vendor">
                        <figcaption class=" ">
                            <div class=" ">
                                <p class=" h5 iransansmedium " style="text-align:justify;line-height: 2.0rem;">شرح فعالیت
                                    :
                                    <span class="iransanslight">
                                        {{-- {{ $vendor->description }} --}}
                                        {!! $vendor->description !!}

                                    </span>
                                </p>


                                <div class="row">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-8">
                                        @include('vendors.layouts.moreDescription')
                                    </div>
                                    <div class="col-2"></div>
                                </div>

                            </div>

                        </figcaption>

                    </div>
                </div>





                </figure>


            </div>
        </div>

















        {{-- قسمت اطلاعات فروشگاه موبایل  --}}

        <div class="container d-md-none  pt-md-5 pt-1">
            <div class="row">


                <div class="col-4">

                    <div class=" text-center  @if ($vendor->cover != 'default-cover.jpg') avater-vendor-page @endif">
                        <a
                            @if ($vendor->hasActiveStory($vendor->id) == 1) href='{{ route('vendor.home', ['vendor' => $vendor->name, 'lastOne' => $vendor->id, 'urlback' => url()->full(), 'fId' => $vendor->id]) }}' @endif>
                            <img @if ($vendor->hasActiveStory($vendor->id) == 1) style="border:2px solid Red;
                                
                                
    
                                @if (seenedBeforStory($vendor->id))
                                    background:none;border:1px solid #000; @endif "
                                                                                        
                            
                            
                                                                                                     
                                     @endif
                            src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}"
                            class="vendorFigImg figure-img img-thumbnail rounded-circle "></a>
                        <div>
                            <h1 class=" VendorTitle  dastnevis text-center">

                                {{ $vendor->title }}

                            </h1>
                        </div>
                    </div>


                </div>

                <div class="col-8 row align-items-center text-center">
                    <div style="display: flex;justify-content :center;">





                        {{-- count product  --}}
                        <div class="" style="margin-right: 20px;" title="تعداد محصولات">
                            <img class="img-fluid" width="30" height="30"
                                src="{{ asset('main/tool/3114633.png') }}" alt="">
                            <p class="iransansmedium text-center h5 mt-3">{{ $vendor->product_count }} </p>
                        </div>

                        {{-- count view  --}}

                        <div class="" style="margin-right: 20px;" title="تعداد بازدیدها">
                            {{-- <span class="iransansmedium text-center h5">تعداد بازدید : </span> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                <path
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                            </svg>
                            <p class="iransansmedium text-center h5 mt-3">{{ $vendor->view_count }} </p>
                        </div>

                        <div class="" style="margin-right: 20px;" title="تعداد دیدگاه ها">

                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chat-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                            </svg>
                            <p class="iransansmedium text-center h5 mt-3">
                                {{ count($comments) }}
                            </p>
                        </div>




                    </div>

                    {{-- امتیازدهی  --}}
                    {{-- <div>
                        <div class="  d-inline-block text-center">

                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />

                            </svg>

                            <strong class="h6 iransanslight">
                                {{ $vendor->rate_Ave }}
                                از 5
                            </strong>


                            @auth
                                @if (Auth::user()->id != $vendor->user->id)

                                                          
                                <form id="RateVendorForm" action="{{ route('ratevendor') }}" class=" "
                                    method="post">
                                    @csrf

                                    <span class="h6 iransanslight" style="margin-top:6px;">
                                        امتیاز شما :</span>


                                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                    @include('layouts.home.Rate')





                                </form>


                            @endif
                            @endauth

                        </div>








                        <div class="alert alert-success alertVEndorRate m-3" style="height: 60px; display:none;">

                            <strong> امتیاز شما به فروشگاه ثبت شد . باتشکر </strong>

                        </div>

                    </div> --}}


                </div>


                <div class="col-md-10 m-auto p-3">



                    <figure class="">
                        {{-- نام فروشگاه  --}}

                        <div>








                            @auth

                                @if (Auth::user()->id == $vendor->user->id)
                                    <div class="col-md-4 my-1 my-store-button">


                                        <a class="vendordissliked btn btn-primary"
                                            href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}">


                                            ویرایش فروشگاه من

                                        </a>



                                    </div>
                                @endif


                            @endauth






                        </div>



                        <div class="d-flex justify-content-between button-flex-mob" style="margin-left:20px;">


                            @auth
                            {{-- فالو انفالو   --}}
                            <div class="" style="align-items: center;">


                                <span onclick="follow({{ $vendor->id }})"
                                    @if ($followingStatus) style="display : none" @endif
                                    id="followBt_{{ $vendor->id }}"
                                    class="btn btn-outline-primary m-1
                                    
                                    
                                    
                                    ">دنبال
                                    کردن </span>
                                <span @if (!$followingStatus) style="display : none" @endif
                                    id="unfollowBt_{{ $vendor->id }}" onclick="unfollow({{ $vendor->id }})"
                                    class="btn 
                                    
                                    
                                    
                                    btn-primary iransansmedium m-1 ">

                                    دنبال نکردن
                                </span>


                            </div>

                            @endauth
                            <div class="">




                                {{-- برای لایک  --}}



                                @auth
                                    <span
                                        class="vendordissliked
                            
                            
                            addToFAvorite_{{ $vendor->id }} 
                            p-0 heart-icon-style"
                                        title="افزودن به علاقه مندی ها"
                                        onclick="addToFAvorite('v' , {{ $vendor->id }} ) ; "
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $vendor->id)->get()) >= 1) style="display:none" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </span>


                                    <span @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $vendor->id)->get()) < 1) style="display:none" @endif
                                        class="vendorliked  
                                removeFromFavorite{{ $vendor->id }}
                                
                                
                                p-0"
                                        title="حذف از علاقه مندی ها"
                                        onclick="removeFromFavorite('v',{{ $vendor->id }});  ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                                            class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </span>



                                @endauth



                                @guest


                                    <?php
                                    $counter = null;
                                    
                                    if (Session::has('favorite_v')) {
                                        $Pfavorited = Session::get('favorite_v');
                                        foreach ($Pfavorited as $itemm) {
                                            if ($itemm['id'] == $vendor->id) {
                                                $counter = true;
                                            }
                                        }
                                    }
                                    
                                    ?>





                                    <span @if (!$counter) style="display: none" @endif
                                        class="            removeFromFavorite{{ $vendor->id }}  p-0"
                                        title="حذف از علاقه مندی ها"
                                        onclick="removeFromFavorite('v',{{ $vendor->id }});  ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                                            class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </span>

                                    <span @if ($counter) style="display: none;" @endif
                                        class=" addToFAvorite_{{ $vendor->id }}  p-0" title="افزودن به علاقه مندی ها"
                                        onclick="addToFAvorite('v' , {{ $vendor->id }} )">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </span>



                                @endguest


                                {{-- share   --}}

                                <a title="اشتراک گذاری" class="mx-2 "
                                    onclick="copyToClipboard('v',{{ $vendor->id }})">

                                    <img width="22" height="22"
                                        src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                                        alt="external-send-email-flatart-icons-outline-flatarticons" />

                                </a>
                                <a href="#comments" title="دیدگاه ها" style="color:#000;">
                                    <svg width="22" height="22" style="" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="var(--ci-primary-color, currentColor)"
                                            d="M496,496H480a273.39,273.39,0,0,1-179.025-66.782l-16.827-14.584C274.814,415.542,265.376,416,256,416c-63.527,0-123.385-20.431-168.548-57.529C41.375,320.623,16,270.025,16,216S41.375,111.377,87.452,73.529C132.615,36.431,192.473,16,256,16S379.385,36.431,424.548,73.529C470.625,111.377,496,161.975,496,216a171.161,171.161,0,0,1-21.077,82.151,201.505,201.505,0,0,1-47.065,57.537,285.22,285.22,0,0,0,63.455,97L496,457.373ZM294.456,381.222l27.477,23.814a241.379,241.379,0,0,0,135,57.86,317.5,317.5,0,0,1-62.617-105.583v0l-4.395-12.463,9.209-7.068C440.963,305.678,464,262.429,464,216c0-92.636-93.309-168-208-168S48,123.364,48,216s93.309,168,208,168a259.114,259.114,0,0,0,31.4-1.913Z"
                                            class="ci-primary" />
                                    </svg>
                                </a>

                            </div>






                        </div>










                </div>
                <div class="container ">
                    <div class="caption-vendor">
                        <figcaption class=" ">
                            <div class=" ">
                                <p class=" h5 iransansmedium " style="text-align:justify;line-height: 2.0rem;">شرح فعالیت
                                    :
                                    <span class="iransanslight">
                                        {{-- {{ $vendor->description }} --}}
                                        {!! $vendor->description !!}

                                    </span>
                                </p>
                                <div class="row">
                                    <div class="col-1">

                                    </div>
                                    <div class="col-10">
                                        @include('vendors.layouts.moreDescription')
                                    </div>
                                    <div class="col-1"></div>
                                </div>


                            </div>

                        </figcaption>

                    </div>
                </div>
                <hr>




                </figure>


            </div>
        </div>


        <hr>

        <div class="container">

            <div class="row p-3 ">

                <div class="col-md-3">
                    <h3 class="mb-5 h5 "><span
                            class="iransansmedium text-center border-bottom border-dark border-3 ">اطلاعات
                            تماس</span></h3>
                    <div class="">



                        <div class="mb-3">
                            @if ($vendor->phone_number)
                                <label class="iransanslight h5" for="">

                                    شماره موبایل :

                                    <a class="h5 iransansmedium"
                                        href="tel:{{ $vendor->phone_number }}">{{ $vendor->phone_number }}</a>

                                </label>
                            @endif
                        </div>
                        <div>
                            <label class="iransanslight h5" for="">

                                تلفن ‍۱ :
                                <a class="h5 iransansmedium" href="tel:{{ $vendor->number }}">{{ $vendor->number }}</a>

                            </label>
                        </div>
                        <div class="mb-3">
                            @if ($vendor->phone_number2)
                                <label class="iransanslight h5" for="">

                                    تلفن ۲:

                                    <a class="h5 iransansmedium"
                                        href="tel:{{ $vendor->phone_number2 }}">{{ $vendor->phone_number2 }}</a>

                                </label>
                            @endif
                            {{-- <div class="mb-3">
                                <p class="iransanslight h5"> تعداد محصولات فعال
                                    :

                                    {{ count($vendor->ActivProducts) }}

                                </p>
                            </div> --}}










                            {{-- 
                            <h5 class="card-title">محصولات این فروشگاه :</h5>
                            <div class="text-start">
                                <a href="{{ route('vendor.products.list', ['vendor' => $vendor->name]) }}" role="button"
                                    class="card-link btn btn-outline-primary">
                                    نمایش محصولات فروشگاه
                                </a>
                            </div> --}}






                            <div class="mb-3 mt-4 h5 iransanslight">
                                <p class="iransanslight h5 ">آدرس : <span class=" mt-3 px-3 iransanslight h6">
                                        {{ $vendor->address }}</span></p>

                            </div>



                        </div>

                        {{-- mobile-socalnetworks-icons --}}
                        <div class="col-md-2  d-inline-block d-sm-none text-center w-100">

                            @if ($vendor->socialMedias)
                                <div class="detailBox text-center">





                                    <div class="mb-3 text-center d-inline-block d-md-block">
                                        @if ($vendor->socialMedias->email != null)
                                            <div class="col-12">
                                                <span onmouseover="$(this).next().css('display' , 'block')"
                                                    onmouseout="$(this).next().css('display' , 'none')">

                                                    {{-- {{ $vendor->socialMedias->email }} --}}



                                                    <small>
                                                        <img class="iconsocialhover"
                                                            src="{{ asset('main/images/socialicons/icons8-email-48.png') }}"
                                                            alt="">
                                                    </small>

                                                </span>
                                                <span
                                                    style="margin-right:190px; transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position: absolute; display:none; ">
                                                    ایمیل </span>


                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-3 text-center d-inline-block d-md-block">
                                        @if (strlen($vendor->socialMedias->aparat) > 2)
                                            <div class="">
                                                <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                                    onmouseout="$(this).next().css('display' , 'none')"
                                                    href="{{ $vendor->socialMedias->aparat }}" role="button">

                                                    <img class="iconsocialhover"
                                                        src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}"
                                                        alt="">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-3 text-center d-inline-block d-md-block">
                                        @if ($vendor->socialMedias->webdite != null && strlen($vendor->socialMedias->webdite) > 6)
                                            <div style="display: flex;" class="">
                                                <span onmouseover="$(this).next().css('display' , 'block')"
                                                    onmouseout="$(this).next().css('display' , 'none')">




                                                    <img class="iconsocialhover"
                                                        src="{{ asset('main/images/socialicons/icons8-internet-16.png') }}"
                                                        alt="">
                                                    {{ $vendor->socialMedias->website }}



                                                </span>



                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3 text-center d-inline-block d-md-block ">

                                        @if ($vendor->socialMedias->whatsapp != null && strlen($vendor->socialMedias->whatsapp) > 10)
                                            <div class="">
                                                <a target="_blank" href="{{ $vendor->socialMedias->whatsapp }}"
                                                    onmouseover="$(this).next().css('display' , 'block')"
                                                    onmouseout="$(this).next().css('display' , 'none')" role="button"
                                                    class="">
                                                    <img class="iconsocialhover"
                                                        src="{{ asset('main/images/socialicons/icons8-whatsapp.svg') }}"
                                                        alt="">
                                                </a>






                                            </div>
                                        @endif
                                    </div>


                                    <div class="mb-3 text-center d-inline-block d-md-block ">
                                        @if ($vendor->socialMedias->telegram != null && strlen($vendor->socialMedias->telegram) > 4)
                                            <div class="">
                                                <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                                    href="{{ $vendor->socialMedias->telegram }}"
                                                    onmouseout="$(this).next().css('display' , 'none')" role="button"
                                                    class="">
                                                    <img class="iconsocialhover"
                                                        src="{{ asset('main/images/socialicons/icons8-telegram-app.svg') }}"
                                                        alt="">
                                                </a>



                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3 text-center d-inline-block d-md-block">
                                        @if ($vendor->socialMedias->instagram != null && strlen($vendor->socialMedias->instagram) > 4)
                                            <div class="">
                                                <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                                    href="{{ $vendor->socialMedias->instagram }}"
                                                    onmouseout="$(this).next().css('display' , 'none')" role="button"
                                                    class="">
                                                    <img class="iconsocialhover"
                                                        src="{{ asset('main/images/socialicons/icons8-instagram.svg') }}"
                                                        alt="">
                                                </a>





                                            </div>
                                        @endif
                                    </div>




                                </div>
                            @endif
                        </div>











                        <div class="mb-3 col-12">




                        </div>
                    </div>

                </div>
                <div class="col-md-3  d-none d-sm-block">
                    <h4 class="mb-5 text-center h5"><span
                            class="iransansmedium text-center border-bottom border-dark border-3  d-none d-md-inline-block">
                            شبکه های اجتماعی</span></h4>

                    @if ($vendor->socialMedias)
                        <div class="detailBox text-center">





                            <div class="mb-3 text-center d-inline-block d-md-block">
                                @if ($vendor->socialMedias->email != null)
                                    <div class="col-12">
                                        <span onmouseover="$(this).next().css('display' , 'block')"
                                            onmouseout="$(this).next().css('display' , 'none')">

                                            {{-- {{ $vendor->socialMedias->email }} --}}



                                            <small>
                                                <img class="iconsocialhover"
                                                    src="{{ asset('main/images/socialicons/icons8-email-48.png') }}"
                                                    alt="">
                                            </small>

                                        </span>
                                        <span
                                            style="margin-right:190px; transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position: absolute; display:none; ">
                                            ایمیل </span>


                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 text-center d-inline-block d-md-block">
                                @if (strlen($vendor->socialMedias->aparat) > 2)
                                    <div class="">
                                        <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                            onmouseout="$(this).next().css('display' , 'none')"
                                            href="{{ $vendor->socialMedias->aparat }}" role="button">

                                            <img class="iconsocialhover"
                                                src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 text-center d-inline-block d-md-block">
                                @if ($vendor->socialMedias->webdite != null && strlen($vendor->socialMedias->webdite) > 6)
                                    <div style="display: flex;" class="">
                                        <span onmouseover="$(this).next().css('display' , 'block')"
                                            onmouseout="$(this).next().css('display' , 'none')">




                                            <img class="iconsocialhover"
                                                src="{{ asset('main/images/socialicons/icons8-internet-16.png') }}"
                                                alt="">
                                            {{ $vendor->socialMedias->website }}



                                        </span>



                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 text-center d-inline-block d-md-block ">

                                @if ($vendor->socialMedias->whatsapp != null && strlen($vendor->socialMedias->whatsapp) > 10)
                                    <div class="">
                                        <a target="_blank" href="{{ $vendor->socialMedias->whatsapp }}"
                                            onmouseover="$(this).next().css('display' , 'block')"
                                            onmouseout="$(this).next().css('display' , 'none')" role="button"
                                            class="">
                                            <img class="iconsocialhover"
                                                src="{{ asset('main/images/socialicons/icons8-whatsapp.svg') }}"
                                                alt="">
                                        </a>






                                    </div>
                                @endif
                            </div>


                            <div class="mb-3 text-center d-inline-block d-md-block ">
                                @if ($vendor->socialMedias->telegram != null && strlen($vendor->socialMedias->telegram) > 4)
                                    <div class="">
                                        <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                            href="{{ $vendor->socialMedias->telegram }}"
                                            onmouseout="$(this).next().css('display' , 'none')" role="button"
                                            class="">
                                            <img class="iconsocialhover"
                                                src="{{ asset('main/images/socialicons/icons8-telegram-app.svg') }}"
                                                alt="">
                                        </a>



                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 text-center d-inline-block d-md-block">
                                @if ($vendor->socialMedias->instagram != null && strlen($vendor->socialMedias->instagram) > 4)
                                    <div class="">
                                        <a onmouseover="$(this).next().css('display' , 'block')" target="_blank"
                                            href="{{ $vendor->socialMedias->instagram }}"
                                            onmouseout="$(this).next().css('display' , 'none')" role="button"
                                            class="">
                                            <img class="iconsocialhover"
                                                src="{{ asset('main/images/socialicons/icons8-instagram.svg') }}"
                                                alt="">
                                        </a>





                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 text-center d-inline-block d-md-block ">

                                @if ($vendor->socialMedias->whatsapp != null && strlen($vendor->socialMedias->whatsapp) > 10)
                                    <div class="">
                                        <a target="_blank" href="{{ $vendor->socialMedias->whatsapp }}"
                                            onmouseover="$(this).next().css('display' , 'block')"
                                            onmouseout="$(this).next().css('display' , 'none')" role="button"
                                            class="">
                                            <img class="iconsocialhover d-inline-block "
                                                style="width:30px;margin-bottom:10px;"
                                                src="{{ asset('images/main-logo.png') }}" alt="">


                                        </a>

                                    </div>
                                @endif
                            </div>




                        </div>
                    @endif
                </div>
                <div class="col-md-3 DontShow">
                    <h3 class="mb-5 text-center h5 "><span
                            class="iransansmedium text-center border-bottom border-dark border-3 ">دسته بندی فعالیت
                        </span></h3>

                    <div class="mb-3">






                        <?php
                        
                        $data = str_replace('-', ' ', strval($vendor->category_activity));
                        
                        $d = explode('-', $vendor->category_activity);
                        
                        ?>
                        @foreach ($d as $ddd)
                            <?php $category = \App\Models\Category::find($ddd); ?>

                            @if ($category)
                                <p class="text-center">

                                    <a class=" iransanslight h5 p-2 mb-3"
                                        style=" padding:3px; margin:3px; line-height:3; font-size: 15px; background-color: rgb(223, 223, 223); color:black; border-radius: 5px; "
                                        href="{{ route('categories.show', ['category' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                </p>
                            @endif
                        @endforeach




                    </div>
                </div>

                <div class="col-md-3">
                    <h3 class="mb-5 text-center h5 "><span
                            class="iransansmedium text-center border-bottom border-dark border-3 ">
                            مسیریابی</span></h3>
                    @if ($vendor->lat)
                        <div class="map-vendor ">
                            {{--  
                            <div id="map1">

                            </div>  --}}

                            @php

                                $vendorLatLng = $vendor->lat . ',' . $vendor->lng;

                            @endphp

                            <div id="map"
                                style="  
                                height:150px;  
                                background: rgb(238, 238, 238);
                                border: 2px solid rgb(170, 170, 170);
                                position: relative;">
                            </div>

                            {{-- <iframe src="{{$mapLink}}" ></iframe> --}}

                            <div style="text-align: center" class="">
                                <a class="col-4 m-2 btn btn-outline-primary"
                                    href="https://maps.google.com/?q= <?php echo $vendor->lat . ',' . $vendor->lng; ?>" role="button">
                                    مسیریابی
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="col-12">

                @if ($vendor->apatatVideoLink && App\Models\Admin\SiteSetting::first()->aparat_product)
                    {!! $vendor->apatatVideoLink !!}
                @endif
            </div>



            <div class="row px-4">
                @if ($vendor->site_url)
                    <hr class="my-5">
                    <p class="iransanslight  h5">آدرس وبسایت :</p>



                    {{-- @dd($vendor->site_url) --}}
                    <a class="iransanslight h5" href="https://{{ $vendor->site_url }}" role="button" target="_blank">
                        {{ Str::limit($vendor->site_url, 50) }}
                    </a>
                    <div class="row border border-5 border-bottom-0 p-2 text-end  m-0"
                        style="margin-bottom: -3px!important;">
                        <div class="col-3"></div>


                        <div class="col-8  d-flex justify-content-between w-75 border border-1 text-end "
                            style="background-color:#efefef; border-radius:15px;">

                            <div class="row align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                                </svg>
                            </div>


                            <div class=" p-1">
                                <a href="https://{{ $vendor->site_url }}">

                                    <input type="text" class=" text-start" disabled
                                        value="https://{{ $vendor->site_url }}">
                                </a>
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                    </svg></span>
                            </div>

                        </div>


                    </div>
                    <iframe class="iframe-size shadow-lg p-3 border border-5 my-4 mt-0 rounded" style="height: 250px;"
                        src="https://{{ $vendor->site_url }}" title="iframe Example 1"></iframe>
                @endif
            </div>


        </div>
        <hr>
        <div class="container-fluid position-relative">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class=" ">
                        <div class="row py-2">
                            <div class="col-12">
                                <h4 class="m-2 irdastnevis"> محصولات </h4>
                            </div>
                        </div>
                        <div class="row border border-2 rounded p-4 background-color-section" id="">
                            {{-- @include('layouts.products', [
                                'item' => $products,
                                'type' => 'product',
                                'linkTxt' => 'مشاهده محصول',
                            ]) --}}
                            @foreach ($products as $item)
                                <x-productsCard :product="$item" />
                            @endforeach
                        </div>
                        <div class="col-4 text-center">
                            @php
                                if (request()->has('ProductFrom')) {
                                    $currentCount = request()->ProductFrom;
                                } else {
                                    $currentCount = 8;
                                }
                            @endphp
                            @if (count($vendor->products) > $currentCount)
                                <form action="" method="get" id="ProductPart">
                                    @if (request()->has('ProductFrom'))
                                        <script>
                                            document.getElementById("ProductPart").scrollIntoView();
                                        </script>
                                        <input type="hidden" name="ProductFrom"
                                            value="{{ request()->ProductFrom + 8 }}">
                                    @else
                                        <input type="hidden" name="ProductFrom" value="8">
                                    @endif
                                    <input type="submit" class="btn btn-secondary" value="مشاهده بیشتر">
                                </form>
                            @endif
                        </div>
                        <br>
                        <hr>
                        <h3 class="m-2 irdastnevis"> فروشندگان مشابه </h3>
                        {{-- @dd($similar_vendors) --}}
                        <div class="">
                            <div class="row border border-2 br25 p-md-4 ">
                                <div class="owl-carousel loop-vendorEE  similar-vendor  ">
                                    @foreach ($similar_vendors as $item)
                                        <div class="border br25 m-md-3 m-1">
                                            <a href="{{ route('vendor.home', ['vendor' => $item->name]) }}"
                                                class="">
                                                <img src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->avatar) }}"
                                                    class="similar-vendors-image mx-auto p-2" alt="{{ $item->name }}">
                                                <div class="card-body vendors-card-body-h text-center">
                                                    <h5 class=" iransanslight py-1 pb-2 text-black h6 card-title"
                                                        style="font-weight: bold;height: 50px;">
                                                        {{ $item->title }}
                                                    </h5>
                                                    <hr class="my-1 text-black">
                                                    <p style="font-size: 11px;"
                                                        class="card-text  iransanslight normalFont m-0 px-2 line-height-description row align-items-center">
                                                        {{-- {{ $item->description }} --}}
                                                        {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 40) !!}
                                                    </p>
                                                    <p class="card-text  iransanslight normalFont "
                                                        style="font-size: 13px;font-weight:bold;">
                                                        <span>
                                                            <img class="img-fluid d-inline-block" style="width: 20px"
                                                                src="{{ asset('main/tool/3114633.png') }}"
                                                                alt="">
                                                        </span>
                                                        <span style="font-weight:bold;">
                                                            محصولات :
                                                        </span>
                                                        {{ $item->product_count }}
                                                    </p>
                                                </div>
                                            </a>
                                            {{-- <div class="card-footer">
                                                <a href="{{ route('vendor.home', ['vendor' => $item->name]) }}"
                                                    class="btn btn-primary  w-100" style="font-size: 15px;">
                                                    مشاهده فروشگاه
                                                </a>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                
                                
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pt-5  mt-2">
                    <div class="position-sticky " style="top:6px;">
                        <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />
                    </div>

                </div>
            </div>






            <div id="comments">
                @include('vendors.VendorComments')

            </div>



        </div>

    </div>




@endpush


@push('footer_scripts')
    @include('layouts.home.footer.script')
@endpush

@push('footer_scripts')
    <script>
        var map = L.map('map', {
            attributionControl: false
        }).setView([{{ $vendor->lat }}, {{ $vendor->lng }}], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© {{ env('APP_NAME') }}',


        }).addTo(map);
        var marker = L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map);
        L.control.attribution({
            position: 'topright'
        }).addTo(map);

        //  map.on('move',function(e){
        //     marker.setLatLng(L.latLng(map.getCenter()));
        // }); 
    </script>


    {{-- <script type="text/javascript">
    var myMap = new ol.Map({
        target: 'map',
        key: 'YOUR_API_KEY',
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        view: new ol.View({
            center: ol.proj.fromLonLat([{{$vendor->lat}}, {{$vendor->lng}}]),
            zoom: 5
        })
    });
</script> --}}
@endpush


@push('footer_scripts')
    {{-- <script>
        $(document).ready(function() {
            $('.products').owlCarousel({

                items: 4,
                loop: false,
                margin: 10,
                rewind: true,
                rtl: true,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                dots: false,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                        margin: 40,
                    },
                    440: {
                        items: 2,
                        margin: 5,
                    },
                    // breakpoint from 480 up
                    768: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    900: {
                        items: 4,
                    }
                }

            });

        });










        var map = L.map('map1').setView([{{ $vendor->lat }}, {{ $vendor->lng }}], 18);


        var marker = L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map);


        marker.addTo(map);


        // L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map)
        //     .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        //     .openPopup();


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);



        // marker.bindPopup({{ $vendor->title }}).openPopup();
        // var popup = L.popup()
        //     .setLatLng([{{ $vendor->lat }}, {{ $vendor->lng }}])
        //     .setContent("I am a standalone popup.")
        //     .openOn(map);
    </script> --}}
@endpush
