@extends('admin.layouts.admin')

{{-- <meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
<link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
 --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css">
<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL">
</script>
<script type="text/javascript" src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

@section('title')
    ویرایش فروشگاه
@endsection


@section('script')
    {{-- <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('Croppie-master/croppie.min.js') }}"></script> --}}



    {{-- <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script> --}}


    <script>
        function showSocialInputs() {

            $('#divSocials').css('display', 'block');
        }




        function inputCats() {



            let cat_array = [];



            $('.categoryCheckBox:checked').each(function() {


                cat_array.push(this.value);

            });

            $('#hiddenCatInput').val(cat_array);





        };


        var map = L.map('map', {
            attributionControl: false
        }).setView([{{$vendor->lat}}, {{$vendor->lng}}], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© {{ env('APP_NAME') }}',


        }).addTo(map);


        var marker = L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map);
        L.control.attribution({
            position: 'topright'
        }).addTo(map);

        map.on('move', function(e) {
            marker.setLatLng(L.latLng(map.getCenter()));

            $('#latlng').val(map.getCenter().lat + "," + map.getCenter().lng);

            // console.log(map.getCenter().lat , map.getCenter().lng);
        });




        function showImage() {


            const imageUploader = $("#inputCover");
            const imagePreview = $("#imgcover");

            let reader = new FileReader();
            reader.readAsDataURL(imageUploader.files[0]);
            reader.onload = function(e) {

                imagePreview.src = e.target.result;
            };
        }
        // console.log(lat);
    </script>
    <style>
        .editPhotoBtn {
            transition: all .1s;
        }

        .editPhotoBtn:hover {
            background-color: black;
            scale: 1.1;
        }


        #map {
            height: 400px;
            width: 500px;
        }
    </style>

    {{-- <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script> --}}
@endsection


@section('content')
    @php

        $vid = $user->vendor->id;
    @endphp

    <!-- Content Row -->
    <form action="{{ route('admin.vendors.update', ['vendor' => $user->vendor->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class=" " >


            <div class=" mb-5">
                <h5>کاور : </h5>
            </div>
            <div class="">
                <div class="cover-vendor-div">
                    <img class="" 
                        src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . getVendorLastDate($vid, 'cover')) }}"
                        alt="{{ $user->vendor->name }}">
                </div>


                <input type="file" id="inputCover" name="cover" accept='image/*' onchange="showImage()">

                {{-- <a class="btn btn-primary"
                href="{{ route('user.vendor.GoToEditCover', ['vendor' => $user->vendor]) }}">ویرایش کاور
                فروشگاه</a> --}}
            </div>

        </div>
        <div class="row">

            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">

                <div class="col-xl-12 col-md-12 mb-4 bg-white">
                    <div class="mb-4 text-center text-md-right">
                        <h5 class="font-weight-bold">ویرایش اطلاعات فروشگاه : {{ $user->vendor->name }}</h5>
                    </div>


                    @include('user.sections.errors')

                    {{-- Show Primary Image --}}
                 
                </div>

                <hr>
                <div class="row">
                    <div class="col-12 col-md-12 mb-5">
                        <h5>لوگو : </h5>
                    </div>




                    <div class="col-12 mb-5">
                        <div class="card">
                            <img class="card-img-top" style="width: 150px;border-radius: 50%;max-width: 70%;"
                                src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . getVendorLastDate($vid, 'avatar')) }}"
                                alt="{{ $user->vendor->name }}">
                            <input type="file" id="inputCover" name="avatar" accept='image/*' onchange="showImage()">

                            {{-- <label class="editPhotoBtn" 
                            style="position: absolute;  border-radius: 50%;  background-color: rgba(32, 32, 32, 0.308);  cursor:pointer;"
                            for="avatar_img">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                style="   color:white; justify-content: center; align-items:center; text-align: center;margin:50px;"
                                width="40" height="40" fill="currentColor" class="bi bi-pen" viewBox="0 0 20 20">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>

                        </label> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mb-4 text-center text-md-right">
            @if ($user->vendor->status == 'no')
                <h5 class="font-weight-bold">
                    تکمیل اطلاعات فروشگاه
                </h5>
            @endif
        </div>
        <hr>

        @include('user.sections.errors')


        <input type="hidden" id="hiddenCatInput" name="Category">

        <div class="form-row">
            <div class="form-group col-sm-12">
                <label for="title">نام فروشگاه</label>
                <input class="form-control" id="title" name="title" type="text"
                    value="{{ getVendorLastDate($vid, 'title') }}">
            </div>

            <div class="form-group col-sm-12 col-md-4">
                <label for="phone">تلفن ثابت</label>
                <input class="form-control" id="phone" name="phone" type="text"
                    value="{{ getVendorLastDate($vid, 'number') }}">
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="phone_number2"> تلفن ثابت2</label>
                <input class="form-control" id="phone_number2" name="phone_number2" type="text"
                    value="{{ getVendorLastDate($vid, 'phone_number2') }}">
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="cellphone">
                    شماره واتساپ
                </label>
                <input class="form-control" id="cellphone" name="cellphone" type="text"
                    value="{{ getVendorLastDate($vid, 'phone_number') }}">
            </div>


            <div class="form-group col-12">
                <label for="address">آدرس</label>
                <textarea rows="3" type="text" class="form-control" id="address" name="address">
                    {{ getVendorLastDate($vid, 'address') }}
                </textarea>

            </div>


            <div id="demo-basic"></div>



            <div class="form-group col-xs-12 col-md-6">
                <label for="description">
                    شرح فعالیت
                </label>
                <textarea class="form-control" id="description" style="height: 270px;" name="description">{{ getVendorLastDate($vid, 'description') }}</textarea>
            </div>
            <hr>



            {{-- <div class="form-group col-xs-12 col-md-6"> --}}

            لوکیشن

            <div id="map" style=" height: 250px; background: #eee; border: 2px solid #aaa;"></div>
            {{--  <iframe
                src="https://api.neshan.org/v2/static?key=service.349e7f85b58d4cbaac353a73c85acc35&type=dreamy&zoom=14&center=35.700538,51.337907&width=1120&height=300&marker=red"></iframe>  --}}
            {{-- </div> --}}


            <div class="">
                <div class="">
                    <div class="pt-5">
                        <div class="form-row" id="divSocials">


                            <div class="form-group col-sm-12 col-md-3 mb-3">
                                <img class="iconsocialhover input-group-prepend d-inline my-1" style="width:30px;"
                                    src="{{ asset('images/logo-website-website-logo-png-transparent-background-background-15.png') }}"
                                    alt="">
                                <label for="site_url">
                                    وبسایت:
                                </label>


                                <input type="text" dir="ltr" class="form-control" name="website"
                                    value="{{ getVendorLastSocialMediaDate($vid, 'website') }}"
                                    aria-describedby="basic-addon3">




                            </div>


                            <div class="col-12 col-md-3 mb-3 ">
                                <label class=" form-label" for="site_url">
                                    <div class="d-flex align-items-center">
                                        <span class="ps-1">
                                            <div class="input-group-prepend">
                                                <img class="iconsocialhover" width="31"
                                                    src="{{ asset('main/images/socialicons/icons8-telegram-app.svg') }}"
                                                    alt="">
                                            </div>
                                        </span>
                                        تلگرام
                                        <small>
                                            (بدون @)
                                        </small>

                                    </div>
                                </label>
                                <div class=" d-flex">
                                    <?php $telegram = $user->vendor->socialMedias ? substr($user->vendor->socialMedias->telegram, 20) : ' '; ?>
                                    <input type="text" dir="ltr" class="form-control" name="telegram"
                                        value="{{ getVendorLastSocialMediaDate($vid, 'telegram') }}"
                                        aria-describedby="basic-addon3">




                                </div>


                            </div>
                            <div class="form-group col-sm-12 col-md-3 mb-3">
                                <img class="iconsocialhover input-group-prepend d-inline my-1" style="width:30px;"
                                    src="{{ asset('images/Rubika_logo888.png') }}" alt="">
                                <label for="site_url" style="margin-right: 2px;">
                                    روبیکا:


                                </label>

                                <?php $robika = $user->vendor->socialMedias ? $user->vendor->socialMedias->robika : ' '; ?>
                                <input type="text" dir="ltr" class="form-control" name="robika"
                                    value="{{ getVendorLastSocialMediaDate($vid, 'robika') }}"
                                    aria-describedby="basic-addon3">

                            </div>



                            <div class="col-12 col-md-3 mb-3">
                                <label class="" for="site_url">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img class="iconsocialhover" width="32"
                                                src="{{ asset('main/images/socialicons/icons8-whatsapp.svg') }}"
                                                alt="">
                                        </div>
                                        واتساپ
                                        <small>
                                            ( بدون صفر اولیه)
                                        </small>
                                    </div>
                                </label>

                                <div class="">
                                    <?php
                                    
                                    if (isset($user->vendor->socialMedias->whatsapp)) {
                                        $whatsapp = substr($user->vendor->socialMedias->whatsapp, 39);
                                    } else {
                                        $whatsapp = substr($user->vendor->phone_number, 1);
                                    }
                                    ?>


                                    <input type="text" dir="ltr" class="form-control" name="whatsapp"
                                        value="{{ getVendorLastSocialMediaDate($vid, 'whatsapp') }}"
                                        aria-describedby="basic-addon3">


                                </div>

                            </div>

                            <div class="col-12 col-md-3 mb-3">

                                <label for="" class="d-flex align-items-center">
                                    <div class="input-group-prepend">
                                        <img class="iconsocialhover" width="31"
                                            src="{{ asset('main/images/socialicons/icons8-instagram.svg') }}"
                                            alt="">
                                    </div>
                                    اینستاگرام

                                </label>
                                <?php
                                
                                if (isset($user->vendor->socialMedias->instagram)) {
                                    $instagram = substr($user->vendor->socialMedias->instagram, 26);
                                } else {
                                    $instagram = '';
                                }
                                
                                ?>

                                <input type="text" dir="ltr" class="form-control" name="instagram"
                                    value="{{ getVendorLastSocialMediaDate($vid, 'instagram') }}"
                                    aria-describedby="basic-addon3">




                            </div>


                            <div class="col-md-3 col-12 mb-3">


                                <label for="" class="d-flex align-items-center">
                                    <div class="input-group-prepend">
                                        <img class="iconsocialhover" width="31"
                                            src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}"
                                            alt="">

                                    </div>
                                    آپارات
                                </label>

                                <?php
                                
                                if (isset($user->vendor->socialMedias->aparat)) {
                                    $aparat = substr($user->vendor->socialMedias->aparat, 23);
                                } else {
                                    $aparat = '';
                                }
                                
                                ?>
                                <input type="text" dir="ltr" class="form-control" name="aparat"
                                    value="{{ getVendorLastSocialMediaDate($vid, 'aparat') }}"
                                    aria-describedby="basic-addon3">





                            </div>

                            <div class="col-md-3 col-12 mb-3 ">


                                <label class="d-flex align-items-center" for="site_url">
                                    <small>
                                        <img class="iconsocialhover" width="31"
                                            src="{{ asset('main/images/socialicons/icons8-email-48.png') }}"
                                            alt="">
                                    </small>

                                    ایمیل
                                </label>


                                <?php
                                
                                if (isset($user->vendor->socialMedias->email)) {
                                    $email = $user->vendor->socialMedias->email;
                                } else {
                                    $email = '';
                                }
                                
                                ?>




                                <div class=" ">
                                    <input type="email" dir="ltr" class="form-control"style="" name="email"
                                        value="{{ getVendorLastSocialMediaDate($vid, 'email') }}"
                                        aria-describedby="basic-addon3">



                                </div>



                            </div>
                            <div class="mb-3 col-sm-12 col-md-3">
                                <label for="site_url" class="d-flex align-items-center ">

                                    <img class="iconsocialhover ps-2" width="35"
                                        src="{{ asset('images/main-logo.png') }}" alt="">
                                    پیام رسان بله:


                                </label>



                                <?php
                                
                                if (isset($user->vendor->socialMedias->whatsapp)) {
                                    $whatsapp = substr($user->vendor->socialMedias->whatsapp, 39);
                                } else {
                                    $whatsapp = substr($user->vendor->phone_number, 1);
                                }
                                ?>


                                <input type="text" dir="ltr" class="form-control" style="width: 100%;"
                                    name="bale" value="{{ getVendorLastSocialMediaDate($vid, 'bale') }}"
                                    aria-describedby="basic-addon3">




                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <label for="description" class="d-flex align-items-center">
            <h3 class="ps-3">دسته فعالیت</h3>
            <svg style="width: 11px;height: 11px;color: red;" xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-asterisk " viewBox="0 0 16 16">
                <path
                    d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
            </svg>
        </label>
        @foreach (\App\Models\Category::lvl_one()->orderBy('created_at')->get() as $key => $category)
            <div>

                <label class="form-check-label " for="category_{{ $key }}" style="">
                    {{ $category->name }}

                </label>
                <input <?php
                
                $data = str_replace('-', ' ', strval($user->vendor->category_activity));
                
                $d = explode('-', $user->vendor->category_activity);
                ?>
                    @foreach ($d as $ddd) 

                                @if ($ddd == $category->id)

                                    checked

                                @endif @endforeach
                    class="form-check-input m-0 p-2 categoryCheckBox" type="checkbox" onchange="inputCats()"
                    style="position: inherit; margin-left:0" value="{{ $category->id }}"
                    id="category_{{ $key }}">
            </div>
        @endforeach










        <input type="hidden" name="latlng" id="latlng">




        <div class="text-center py-4">
            <button class="btn btn-success   d-inline-block" onclick="inputCats()" type="submit">ویرایش و تایید</button>



            <a class="btn btn-warning d-inline-block"
                href="{{ route('admin.sendMessage.edit', ['sendMessage' => $vendor->id, 'vendor' => $vendor->id]) }}">
                ریپورت</a>

            <a class=" btn btn-danger d-inline-block"
                href="{{ route('admin.deleteVendor', ['vendor' => $vendor->id]) }}">
                حذف
            </a>
            <a href="{{ route('user.products.index') }}" class="btn btn-dark  mr-3 d-inline-block">بازگشت</a>

        </div>
    </form>

    </div>

    </div>
@endsection


<form class="dropdown-item" id="acceptVendorRequest" action="{{ route('admin.acceptVendorRequest') }}"
    method="post">
    @csrf

    <input type="hidden" value="{{ $vendor->id }}" name="id">
</form>



<!-- Modal logo -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> تغییر لوگوی فروشگاه</h5>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="col-md-4 text-center">
                        <div id="upload-demo-logo"></div>
                    </div>

                    <input type="file" id="logo">

                </div>
                <div class="modal-footer">

                    <button class="btn btn-success btn-upload-image-logo" style="margin-top:2%"> تغییر لوگو
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var resize = $('#upload-demo-logo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 400,
                height: 400,
                type: 'square' //square
            },
            boundary: {
                width: 500,
                height: 500
            }
        });


        $('#logo').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.btn-upload-image-logo').on('click', function(ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport',
                quality: 1
            }).then(function(img) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });


                var files = $('#logo')[0].files;
                var formData = new FormData();

                formData.append('avatar', img);

                $.ajax({
                    type: "POST",
                    // dataType: "json",
                    url: "{{ route('images.set_avatar') }}",
                    data: formData,
                    enctype: 'multipart/form-data',
                    async: false,
                    cache: false,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType

                    success: function(data) {

                        // console.log(data);
                        location.reload();

                    },
                    error: function(data) {

                        console.log(data);
                    }
                });
            });
        });
    </script>


</div>



</div>
